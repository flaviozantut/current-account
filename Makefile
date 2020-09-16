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