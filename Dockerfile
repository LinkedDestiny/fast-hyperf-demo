FROM hyperf/hyperf:8.0-alpine-v3.15-swoole-v4.8.4

RUN apk add --no-cache --repository http://mirrors.aliyun.com/alpine/edge/community gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

COPY . /hyperf

WORKDIR /hyperf

RUN composer install --no-dev

EXPOSE 9501

ENTRYPOINT ["php", "/hyperf/bin/hyperf.php", "start"]