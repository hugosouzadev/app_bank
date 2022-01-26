consumer-topic:
	- docker exec -it api.it php artisan start:consumer

consumer-topic-dlq:
	- docker exec -it api.it php artisan kafka:consume --consumer=\\App\\Console\\Commands\\ConsumerTestDLQCommand --topics=consumer-topic-dlq

test-unit-coverage: test-unit
	- open -a "Google Chrome" api/build/coverage-report/index.html

artisan:
	- docker exec -it api.keys.dev php artisan $(filter-out $@,$(MAKECMDGOALS))

composer:
	- docker exec -it api.keys.dev composer $(filter-out $@,$(MAKECMDGOALS))

unit:
	- docker exec -it api.keys.dev vendor/bin/phpunit $(filter-out $@,$(MAKECMDGOALS))

clear-cache:
	- docker exec -it api.keys.dev php artisan clear-compiled && docker exec -it api.keys.dev php artisan cache:clear && docker restart api.keys.dev