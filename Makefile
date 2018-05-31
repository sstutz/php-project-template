.DEFAULT_GOAL := all

PWD=$(shell pwd)
PHP=docker run --rm -i -v ~/.composer:/root/.composer -v $(PWD):/var/www/html app/php:7.2-fpm bash -c

all: setup install

build: setup install testcoverage infection

setup:
	cd docker;\
		export APP_ENV=$(ENV) && docker-compose build

install:
	$(PHP) "composer install"

test: unittest

unittest:
	$(PHP) "APP_ENV=testing ./vendor/bin/phpunit --testsuite=unit --no-coverage"

testcoverage:
	$(PHP) "APP_ENV=testing ./vendor/bin/phpunit"

infection:
	$(PHP) "phpdbg -qrr /var/www/html/vendor/bin/infection"

lint:
	.git/hooks/pre-commit --notest

validate:
	.git/hooks/pre-commit

delete-deps:
	$(PHP) "rm -rf vendor"

