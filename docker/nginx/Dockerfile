FROM nginx:1.18.0

ENV PHP_HOST 127.0.0.1

COPY default.conf /etc/nginx/conf.d/default.conf.template
COPY nginx.conf /etc/nginx/nginx.conf

CMD /bin/sh -c 'sed "s/\${PHP_HOST}/${PHP_HOST}/" /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf && nginx -g "daemon off;"'
