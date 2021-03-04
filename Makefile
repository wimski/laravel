up:
	@docker-compose up -d app

down:
	@docker-compose down --remove-orphan

fresh:
	@make destroy
	@docker-compose build
	@docker-compose pull
	@make setup

destroy:
	@docker-compose down --remove-orphan --volumes

setup:
	@make up
	@docker-compose exec app sh -c 'test -s .env || cp .env.example .env'
	@docker-compose exec app sh -c 'test -s phpunit.xml || cp phpunit.xml.dist phpunit.xml'
	@docker-compose exec app composer install
	@docker-compose exec app php artisan key:generate
	@docker-compose exec app sh -c 'test -h ./public/storage || php artisan storage:link'
	@docker-compose exec app sh -c 'echo "Waiting for database connection..."'
	@docker-compose exec app ./docker/wait-for database:3306 -t 600 -- echo "Database connection established"
	@docker-compose exec app php artisan migrate:fresh
	@docker-compose exec app php artisan db:seed
	@docker-compose exec app php artisan ide-helper:meta
	@docker-compose exec app php artisan ide-helper:generate
	@docker-compose exec app php artisan ide-helper:eloquent
	@make ide-helper

test:
	@docker-compose -f docker-compose-test.yaml run --rm test sh -c "php artisan config:clear \
	&& php ./vendor/phpunit/phpunit/phpunit"

ide-helper:
	@docker-compose run --rm app php artisan ide-helper:model --reset --write
