NAME=feedback
REPO=hendry/$(NAME)

.PHONY: start stop build sh

all: build

build: check
	docker build -t $(REPO) .

start:
	docker run -d --name $(NAME) --env-file env.list -p 2015:2015 $(REPO)

stop:
	docker stop $(NAME)
	docker rm $(NAME)

sh:
	docker exec -it $(NAME) /bin/sh

check:
	find -name '*.php' | while read phpsource; do php -l $$phpsource; done
