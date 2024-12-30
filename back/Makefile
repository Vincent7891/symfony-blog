DB_CONTAINER = blog_mysql

.PHONY: up down migrate logs

up:
	docker-compose up -d

down:
	docker-compose down

migrate:
	bash sql/migrate.sh

logs:
	docker-compose logs -f database

