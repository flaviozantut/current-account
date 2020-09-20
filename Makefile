.PHONY: up
up:
	docker-compose up -d

.PHONY: build
build:
	docker-compose build

.PHONY: install
install: up
	docker-compose exec app composer install

############# Tests ################################
.PHONY: test
test: up
	docker-compose exec app vendor/bin/phpunit

.PHONY: integration-test
integration-test: up
	docker-compose exec app vendor/bin/phpunit --filter="Integration"

.PHONY: unit-test
unit-test: up
	docker-compose exec app vendor/bin/phpunit --filter="Unit"


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
	docker-compose exec app vendor/bin/phpstan analyse -l 5 --configuration .phpstan-baseline.neon  app tests


######### Heroku deploy ################
.PHONY: deploy-hk
deploy-hk:
	git push heroku master
