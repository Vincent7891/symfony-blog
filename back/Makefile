#DB_CONTAINER = blog_mysql

.PHONY: up down migrate logs

up:
	docker-compose up -d

all-tests:
	php bin/phpunit

down:
	docker-compose down

migrate-dev:
	bash sql/migrate.sh

db-migrate-test:
	bash sql/migrate_test.sh

logs:
	docker-compose logs -f database

