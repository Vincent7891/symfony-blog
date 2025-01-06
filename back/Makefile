#DB_CONTAINER = blog_mysql

PHP_CS_FIXER=./vendor/bin/php-cs-fixer
CONFIG_FILE=.php-cs-fixer.dist.php

.PHONY: up down migrate logs

lint-fix:
	@echo 'Running php-cs-linter...'
	$(PHP_CS_FIXER) fix --config=$(CONFIG_FILE)

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

