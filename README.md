# yii2-pie-store
Yii2 example app
## Install
Follow this instructions

1. Create and edit `docker/.env` file. Example contains in `docker/.env.dist`.
2. Build docker containers

```sh
cd docker
docker-compose build
```

3. Up docker containers

```sh
docker-compose up -d
```
4. Open http://localhost:${NGINX_EXTERNAL_PORT}