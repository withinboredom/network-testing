#!/usr/bin/env bash
set -e

docker build -t registry.bottled.codes/withinboredom/nginx:delay --target nginx-delay --pull .
docker build -t registry.bottled.codes/withinboredom/nginx:latest --target nginx-nodelay --pull .
docker push registry.bottled.codes/withinboredom/nginx:delay
docker push registry.bottled.codes/withinboredom/nginx:latest
docker build -t registry.bottled.codes/withinboredom/random-delay:latest --target php-delay --pull .
docker push registry.bottled.codes/withinboredom/random-delay:latest
