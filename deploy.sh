#!/bin/bash

# Deploy script for SentinelOps
# Usage: sudo ./deploy.sh

set -e  # Exit on any error

echo "🚀 Starting deployment..."

# Pull latest code
echo "📥 Pulling latest changes from git..."
git pull

# Rebuild and restart containers
echo "🐳 Building and starting Docker containers..."
sudo docker-compose up -d --build

# Show logs
echo "📋 Showing container logs..."
sudo docker-compose logs -f app

echo "✅ Deployment complete!"
