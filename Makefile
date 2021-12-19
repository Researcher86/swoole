build:
	docker-compose build

up:
	docker-compose up

restart:
	docker-compose restart

down:
	docker-compose down -v

swoole-go:
	docker-compose exec swoole bash

# make bench-swoole
bench-swoole:
    # https://github-wiki-see.page/m/giltene/wrk2/wiki/Installing-wrk2-on-Linux#:~:text=Installing%20wrk2%20on,wrk%20and%20build.
	wrk -t10 -c1000 -R5000 http://host.docker.internal:9501

