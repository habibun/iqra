console = symfony console
compose = composer

.PHONY: init
init: # Create env.local
	@echo '\033[1;42m The .env.local was just created. Feel free to put your config in it.\033[0m';
	@cp -n ./.env ./.env.local;

.PHONY: db-diff
db-diff:
	${console} doctrine:schema:update --dump-sql

.PHONY: db-reset
db-reset: # reset database
	${console} d:d:d --force --if-exists
	${console} d:d:c --if-not-exists
	${console} d:s:c
	#${console} d:m:m -n

.PHONY: composer-install
composer-install: # install project dependencies
	symfony composer install

.PHONY: composer-update
composer-update: # update project dependencies
	symfony composer update

.PHONY: cs-check
cs-check: # execute php-cs-fixer analyzer
	symfony php ./vendor/bin/php-cs-fixer fix src --dry-run -v

.PHONY: cs-fix
cs-fix: # execute php-cs-fixer analyzer and fix
	symfony php ./vendor/bin/php-cs-fixer fix

.PHONY: ps-check
ps-check: # execute psalm analyzer
	symfony php ./vendor/bin/psalm

.PHONY: ps-fix
ps-fix: # execute psalm analyzer and fix
	symfony php ./vendor/bin/psalter --issues=all

.PHONY: es-check
es-check: # execute ESLint analyzer
	./node_modules/.bin/eslint assets

.PHONY: build-check
build-check: cs-check ps-check

.PHONY: build-fix
build-fix: cs-fix ps-fix
