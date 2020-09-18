.PHONY: up
up:
	docker-compose up -d

.PHONY: build
build:
	docker-compose build

.PHONY: install
install: up
	docker-compose exec app composer install

.PHONY: test
test: up
	docker-compose exec app vendor/bin/phpunit


############# Code style ################################
.PHONY: style-check
style-check: up
	docker-compose exec app php -d xdebug.remote_autostart=0 -n vendor/bin/php-cs-fixer fix --dry-run --verbose --diff

.PHONY: style-fix
style-fix: up
	docker-compose exec app php -d xdebug.remote_autostart=0 -n vendor/bin/php-cs-fixer fix --verbose


############# phpstan analyse ################################
.PHONY: phpstan-analyse
phpstan-analyse: up
	docker-compose exec app vendor/bin/phpstan analyse -l 8 --configuration .phpstan-baseline.neon  app tests
