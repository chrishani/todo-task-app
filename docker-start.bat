@echo off
echo Building and starting Docker containers...
docker-compose up -d

echo Installing Composer dependencies...
docker-compose exec app composer install

echo Generating application key...
docker-compose exec app php artisan key:generate

echo Running migrations...
docker-compose exec app php artisan migrate

echo Installing npm dependencies and building assets...
docker-compose exec node npm install
docker-compose exec node npm run dev

echo.
echo Application is up and running!
echo Access it at http://localhost:8000
