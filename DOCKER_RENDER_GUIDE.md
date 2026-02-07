# Docker & Render Deployment Guide

This guide covers dockerizing your Laravel app and deploying it to Render.

## Prerequisites

- Docker installed locally
- Render account (https://render.com)
- GitHub repository with your code

## Local Testing

### 1. Build the Docker Image

```bash
docker build -t sentinelops:latest .
```

### 2. Run Locally

```bash
docker run -it \
  -p 8080:8080 \
  -e APP_KEY=base64:YourAppKeyHere \
  -e APP_DEBUG=true \
  sentinelops:latest
```

Access the app at `http://localhost:8080`

### 3. Run with Volume Mounts (for development)

```bash
docker run -it \
  -p 8080:8080 \
  -v $(pwd):/app \
  -e APP_DEBUG=true \
  sentinelops:latest
```

## Deploying to Render

### 1. Push Code to GitHub

Ensure your code is pushed to a GitHub repository.

### 2. Create a New Web Service on Render

1. Log in to Render dashboard
2. Click "New +" → "Web Service"
3. Connect your GitHub repository
4. Configure the service:

   - **Name**: `sentinelops-app`
   - **Environment**: `Docker`
   - **Branch**: `main` (or your default branch)
   - **Build Command**: Leave empty (Render auto-detects Dockerfile)
   - **Start Command**: Leave empty (using CMD from Dockerfile)

### 3. Environment Variables

Add the following environment variables in Render dashboard:

```
APP_KEY=base64:YourGeneratedKeyHere
APP_DEBUG=false
APP_ENV=production
DB_CLIENT=sqlite
GEMINI_API_KEY=your-gemini-api-key
```

**To generate APP_KEY locally:**
```bash
php artisan key:generate --show
```

Copy the output (including `base64:` prefix) to Render's `APP_KEY` variable.

### 4. Set up Persistent Disk (IMPORTANT for SQLite)

Since Render's ephemeral file system is reset on each deploy, you **must** set up a persistent disk for your SQLite database:

1. In Render dashboard, go to your Web Service
2. Navigate to "Disks" tab
3. Click "Add Disk"
4. Configure:
   - **Mount Path**: `/app/database`
   - **Size**: 1 GB (or larger based on needs)

This ensures your database persists across deployments and rebuilds.

### 5. Deploy

Push your code or click "Manual Deploy" on the Render dashboard. The service will:

1. Build the Docker image
2. Run migrations automatically (via entrypoint.sh)
3. Start the application with supervisor

### 6. Monitor Logs

View real-time logs in Render dashboard or via CLI:

```bash
render logs <service-id>
```

## Architecture

### Multi-Stage Dockerfile

- **Stage 1 (assets)**: Node.js builds frontend assets using Vite
- **Stage 2 (app)**: PHP-FPM + Nginx + Supervisor

### Supervisor Processes

Running inside the container:

1. **Nginx** - Web server (port 8080)
2. **PHP-FPM** - PHP application handler
3. **Laravel Queue Worker** - Processes queued jobs (database queue)

### Key Considerations for SQLite + Render

- **Database Persistence**: Use Render's persistent disk at `/app/database`
- **Concurrent Writes**: SQLite handles this via file-level locking, suitable for low-to-medium traffic
- **Database Locks**: Monitor for queue worker deadlocks; increase queue sleep time if needed
- **Queue Connection**: Database queue driver works with SQLite

## Troubleshooting

### Database Locked Errors

If you see "database is locked" errors:

1. Increase queue worker sleep time in `docker/supervisord.conf`:
   ```ini
   command=php /app/artisan queue:work --sleep=5 --tries=3
   ```

2. Reduce concurrent queue workers if needed

### Migrations Not Running

Check that the persistent disk is properly mounted and has write permissions.

### Asset Files Not Loading

Ensure the `public/build` directory is properly created during the build process. Verify with:

```bash
docker exec <container-id> ls -la public/build/
```

### App Key Not Set

Render's `APP_KEY` variable must include the `base64:` prefix. Example:

```
APP_KEY=base64:5N/YTZgady9xurwNES830PCLLn9v+nEc/7+Kkh9bnoQ=
```

## Performance Tips

1. **Cache Configuration**: Laravel cache is configured to use database. Consider migrating to file-based cache if performance is an issue.

2. **Queue Optimization**: For better performance with SQLite, you can:
   - Increase `--sleep` parameter to reduce database polling
   - Batch process queue jobs

3. **Static Assets**: Assets are cached aggressively (1 year expiry). Ensure version hashing works properly in Vite.

## Security Considerations

- Never commit `.env` or secrets to Git
- Always use `APP_DEBUG=false` in production
- Render environment variables are encrypted at rest
- Database file is stored on the persistent disk with restricted permissions

## File Structure Reference

```
.
├── Dockerfile                 # Multi-stage build
├── docker/
│   ├── entrypoint.sh         # Runs migrations before startup
│   ├── supervisord.conf      # Supervisor process config
│   ├── nginx.conf            # Nginx main config
│   └── default.conf          # Laravel app Nginx config
├── .dockerignore             # Files to exclude from Docker build
├── .env.production           # Production environment template
└── database/
    └── database.sqlite       # SQLite database (persisted)
```

## Useful Commands

```bash
# Build image locally
docker build -t sentinelops .

# Run container
docker run -p 8080:8080 sentinelops

# Access container shell
docker exec -it <container-id> /bin/sh

# View Laravel logs
docker exec <container-id> tail -f storage/logs/laravel.log

# Run artisan commands
docker exec <container-id> php artisan <command>

# Check database
docker exec <container-id> sqlite3 database/database.sqlite ".tables"
```

## References

- [Render Docker Documentation](https://docs.render.com/docker)
- [Laravel Deployment](https://laravel.com/docs/12/deployment)
- [SQLite Best Practices](https://www.sqlite.org/bestpractice.html)
