#!/bin/bash
cp -r backend/.env.prod backend/.env
cp -r frontend/configs/config.js.prod frontend/configs/config.js
docker-compose -f docker-compose.prod.yml stop
docker-compose -f docker-compose.prod.yml build
docker-compose -f docker-compose.prod.yml up -d --remove-orphans
