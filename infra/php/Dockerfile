FROM php:7.3.3-fpm-alpine

RUN apk add --no-cache icu-dev zlib-dev libzip-dev

RUN docker-php-ext-install -j$(nproc) iconv bcmath intl zip opcache

ENV CONTAINERPILOT_VER 3.8.0
ENV CONSUL_VERSION 1.4.4

RUN set -ex \
    && curl --retry 7 --fail -Lso /tmp/containerpilot.tar.gz "https://github.com/joyent/containerpilot/releases/download/${CONTAINERPILOT_VER}/containerpilot-${CONTAINERPILOT_VER}.tar.gz" \
    && echo "84642c13683ddae6ccb63386e6160e8cb2439c26  /tmp/containerpilot.tar.gz" | sha1sum -c \
    && tar zxf /tmp/containerpilot.tar.gz -C /usr/local/bin \
    && rm /tmp/containerpilot.tar.gz

RUN set -ex \
    && curl --retry 7 --fail -vo /tmp/consul.zip "https://releases.hashicorp.com/consul/${CONSUL_VERSION}/consul_${CONSUL_VERSION}_linux_amd64.zip" \
    && echo "d3bdf9817c7de9d83426d8c421eb3f37bf82c03c97860ef78fb56e148c4a9765  /tmp/consul.zip" | sha256sum -c \
    && unzip /tmp/consul -d /usr/local/bin \
    && rm /tmp/consul.zip \
    && mkdir /config

COPY containerpilot.json5 /etc/containerpilot.json5

CMD ["/usr/local/bin/containerpilot", "-config", "/etc/containerpilot.json5"]
