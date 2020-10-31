FROM umputun/nginx-le:latest

COPY ./docker/nginx/script/entrypoint.sh /entrypoint.sh
COPY ./docker/nginx/service.conf /etc/nginx/service.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/ssl/ /etc/nginx/ssl

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log && \
    chmod +x /entrypoint.sh




