php-cs-fixer:
	docker-compose exec -T app bash -c "vendor/bin/php-cs-fixer fix --allow-risky=yes"

php-cs-fixer-dry-run:
	docker-compose exec -T app bash -c "vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run --verbose --show-progress=dots"

phpstan:
	docker-compose exec -T app bash -c "vendor/bin/phpstan analyse src"

up:
	docker-compose up

stop:
	docker-compose stop

enter:
	docker-compose exec app bash

cache-clear:
	docker-compose exec app bin/console cache:clear

test:
	docker-compose exec -T app bash -c "bin/phpunit"

database-diff:
	docker-compose exec app bash -c "bin/console doctrine:migrations:diff"

database-migrate:
	docker-compose exec app bash -c "bin/console doctrine:migrations:migrate"
