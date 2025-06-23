# task-matcher
# Project Setup Guide

**Pre-requirements**
- PHP v8.2
- Composer v2.8.5
- Docker

**1. copy env file**
```shell
cp .env.example .env
```
**3. build & run sail**
```shell
sail up
```
**3.1 if sail not install globally, install with composer and run per project**
```shell
composer install 
./vendor/bin/sail up
```

**4. run migration and seeders**
```shell
./vendor/bin/sail artisan migrate:fresh --seed
```
**6. click the url
- http://localhost:8000
__
__
