FROM nginx:1.15.10-alpine

RUN apk add --no-cache curl unzip

ENV CONTAINERPILOT_VER 3.8.0
ENV CONSUL_VERSION 1.4.4
ENV CONSUL_TEMPLATE_VERSION 0.20.0

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

RUN set -ex \
    && export CONSUL_TEMPLATE_CHECKSUM=caf6018d7489d97d6cc2a1ac5f1cbd574c6db4cd61ed04b22b8db7b4bde64542 \
    && curl --retry 7 --fail -Lso /tmp/consul-template.zip "https://releases.hashicorp.com/consul-template/${CONSUL_TEMPLATE_VERSION}/consul-template_${CONSUL_TEMPLATE_VERSION}_linux_amd64.zip" \
    && echo "500fe023c89517f959175eb79e21c33df0acf7733d3f3681ec8c5238863caf86  /tmp/consul-template.zip" | sha256sum -c \
    && unzip /tmp/consul-template.zip -d /usr/local/bin \
    && rm /tmp/consul-template.zip

COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/api.conf /etc/nginx/conf.d/default.conf

COPY containerpilot.json5 /etc/containerpilot.json5

CMD ["/usr/local/bin/containerpilot", "-config", "/etc/containerpilot.json5"]
