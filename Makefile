container=app

init:
	cp .env.example .env
	docker compose build
	docker compose up -d
	docker compose exec $(container) composer install
	docker compose exec $(container) php artisan key:generate

up:
	docker compose up -d

down:
	docker compose down

test:
	docker compose exec $(container) vendor/bin/phpunit tests

composer:
	docker compose exec $(container) composer $(CMD)

.PHONY: artisan
artisan:
	docker compose exec $(container) php artisan $(CMD)

tinker:
	docker-compose exec $(container) php artisan tinker