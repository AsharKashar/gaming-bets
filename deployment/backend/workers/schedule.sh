#!/bin/bash

while true
    do
        echo 'RUN: schedule:run'
        if [[ ! `ps aux | grep 'artisan schedule:run' | grep -v grep` ]]; then ( php artisan schedule:run > /dev/null 2>&1 & ) fi
    sleep 60
done
