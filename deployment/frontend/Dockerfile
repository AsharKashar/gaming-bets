FROM node:12.17.0
MAINTAINER Kenan Duman <kenanduman1988@gmail.com>

ENV NODE_ENV production

WORKDIR /frontend

COPY entrypoint.sh /usr/local/bin/

EXPOSE 8080
ENTRYPOINT ["entrypoint.sh"]

