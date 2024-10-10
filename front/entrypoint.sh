#!/bin/sh

cd /app

npm install

#if not exist .env
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

npm run dev --host=0.0.0.0