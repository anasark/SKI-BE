# 📘 SKI Mini Project Setup

This project can be run with **Docker** or directly using **PHP + MySQL** (without Docker).  

---

## Run with Docker

### Setup
```bash
# 1. Clone repository
git clone https://github.com/anasark/SKI-BE.git
cd SKI-BE

# 2. Make sure the network exists
docker network create ski

# 3. Build & start
docker-compose up -d --build

# 4. Install dependencies
docker exec -it ski_app composer install

# 5. Copy env file
cp .env.example .env
```

Update `.env`:
```
DB_CONNECTION=mysql
DB_HOST=ski_db
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

```bash
# 6. Generate key & migrate
docker exec -it ski_app php artisan key:generate
docker exec -it ski_app php artisan migrate --seed
```

### Access
- App → [http://localhost/api](http://localhost/api)  
- DB → host: `localhost`, user: `default`, pass: `secret`

---

## Run with PHP + MySQL (without Docker)

### Requirements
- PHP 8.2+
- Composer
- MySQL 8

### Setup
```bash
git clone https://github.com/anasark/SKI-BE.git
cd SKI-BE

composer install
cp .env.example .env
```

Update `.env` to match your local DB:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Access
- App → [http://localhost:8000/api](http://localhost:8000/api)
