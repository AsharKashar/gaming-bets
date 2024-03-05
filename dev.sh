#!/bin/bash
cp -r backend/.env.dev backend/.env
cp -r frontend/configs/config.js.dev frontend/configs/config.js
docker-compose -f docker-compose.dev.yml stop
docker-compose -f docker-compose.dev.yml build
docker-compose --compatibility -f docker-compose.dev.yml up -d --remove-orphans
