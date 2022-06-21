PACKAGE := tmgm-www-laravel
TAG := $(shell git tag |grep $(PACKAGE) |sed "s/$(PACKAGE)-//g" |tail -n 1 )
# TAG := '0.0.1'

NAME = bid-docker-registry-vpc.cn-hongkong.cr.aliyuncs.com/tm/$(PACKAGE)
NAME_SYD = registry-intl.ap-southeast-2.aliyuncs.com/bid/$(PACKAGE)

VERSION := $(shell echo ${TAG})

# info:
# 	$(info $(PACKAGE))
#  	$(info $(TAG))
# 	$(info $(NAME))
# 	$(info $(VERSION))

bid:
	$(info $(PACKAGE))
	$(info $(TAG))
	$(info $(NAME))
	$(info $(VERSION))


build:
	docker build -t $(NAME):$(VERSION) .

build-arm:
	docker build -t $(NAME):$(VERSION) --build-arg ARCH=arm64	.

build-nocache:
	docker build -t $(NAME):$(VERSION) --no-cache --build-arg ARCH=arm64 .

docker-launch:
	-docker container rm $(CONTAINER) -f
	docker run --name $(CONTAINER)   registry-intl.ap-southeast-2.aliyuncs.com/bid/$(CONTAINER):$(VERSION) 
test:  docker-launch
	$(info  )
	$(info To connect to container run ::)
	$(info docker exec -ti $(CONTAINER)  /bin/bash )
	$(info  )

tag-latest:
	docker tag $(NAME):$(VERSION) $(NAME):latest

push:
	docker push $(NAME):$(VERSION)

push-latest:
	docker push $(NAME):latest

release: build tag-latest push push-latest

git-tag-version: release
	git tag -a v$(VERSION) -m "v$(VERSION)"
	git push origin v$(VERSION)
	git push --tags


syd-dc:
# registry-intl-internal.ap-southeast-2.aliyuncs.com/bid/blah
	docker build -t $(NAME_SYD):$(VERSION) .
	docker tag $(NAME_SYD):$(VERSION) $(NAME):latest
	docker push $(NAME_SYD):$(VERSION)
	docker push $(NAME_SYD):latest
