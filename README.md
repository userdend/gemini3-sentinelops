# SentinelOps

A chaos engineering platform for testing system resilience and analyzing failure patterns. SentinelOps helps engineering teams proactively identify vulnerabilities by injecting controlled failures and monitoring how systems respond.

## About

SentinelOps is a comprehensive failure simulation and analysis tool designed to:

- **Simulate Chaos**: Inject controlled failures (latency, packet loss, memory limits) into system dependencies
- **Monitor Failures**: Track and log failure events with detailed error information
- **Analyze Patterns**: Use AI-powered insights to identify recurring failure patterns and root causes
- **Improve Resilience**: Help teams build more robust systems by understanding failure modes

Built with modern DevOps practices in mind, SentinelOps enables teams to practice chaos engineering in a controlled environment.

## Tech Stack

### Backend
- **Framework**: Laravel 11 (PHP 8.4)
- **Database**: SQLite (production), MySQL (development)
- **Queue System**: Laravel Queue with database driver
- **AI Integration**: Google Gemini API for failure analysis
- **HTTP Client**: Guzzle HTTP

### Frontend
- **Build Tool**: Vite
- **Styling**: Tailwind CSS
- **JavaScript**: Vue.js (or vanilla JS with Vite)

### DevOps & Deployment
- **Containerization**: Docker & Docker Compose
- **Web Server**: Nginx
- **Process Manager**: Supervisor (for queue workers)
- **Hosting**: VPS (for demo purposes)

## Project Structure

```
├── app/
│   ├── Models/          # Eloquent models (ChaosProfile, FailureLog, FailureAnalyses)
│   ├── Jobs/            # Queue jobs (ProcessPaymentJob)
│   ├── Services/        # Business logic (Chaos service)
│   └── Events/          # Event handlers
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Sample data
├── docker/              # Docker configuration
├── resources/           # Views and assets
└── routes/              # API and web routes
```

## Installation

### Local Development

```bash
# Clone the repository
git clone https://github.com/yourusername/sentinelops.git
cd sentinelops

# Install dependencies
composer install
npm install

# Copy environment configuration
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run dev
```

### Docker Deployment (Production)

```bash
# Build and start containers
docker-compose up -d --build

# Run migrations
docker-compose exec app php artisan migrate

# Seed sample data (optional)
docker-compose exec app php artisan db:seed
```

## Deployment

Currently hosted on a **Hostinger VPS** for demo purposes. 

### Deploying Updates

```bash
cd /opt/gemini3-sentinelops
git pull
sudo ./deploy.sh
```

The `deploy.sh` script handles:
- Pulling latest code from repository
- Building Docker images
- Restarting containers
- Preserving persistent data (SQLite database)

## Configuration

Required environment variables:

```env
APP_NAME=SentinelOps
APP_ENV=production
APP_KEY=base64:...           # Generate with: php artisan key:generate
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

GEMINI_API_KEY=your-gemini-api-key
QUEUE_CONNECTION=database
```

## Usage

1. Create chaos profiles to define failure scenarios
2. Dispatch jobs to inject controlled failures
3. Monitor failure logs in the dashboard
4. View AI-generated analysis of failure patterns
5. Use insights to improve system resilience

## Features

- ✅ Chaos profile creation and management
- ✅ Failure injection (latency, packet loss, memory limits)
- ✅ Comprehensive failure logging
- ✅ Failure pattern analysis with AI
- ✅ Real-time dashboard
- ✅ Scalable background job processing
- ✅ Docker-based deployment

## License

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
