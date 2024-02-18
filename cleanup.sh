#!/bin/bash

# cleans up images, containers, and volumes that are dangling or exited
echo -e "\nCleaning up dangling images..."
docker rmi -f $(docker images -f "dangling=true" -q)
echo -e "\nCleaning up exited containers..."
docker rm $(docker ps -a -f status=exited -q)
echo -e "\nCleaning up dangling volumes..."
docker volume rm $(docker volume ls -f dangling=true -q)

