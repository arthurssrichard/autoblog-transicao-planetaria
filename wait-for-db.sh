#!/bin/sh

set -e

host="$1"
port="$2"

echo "Aguardando banco de dados em $host:$port..."

while ! nc -z "$host" "$port"; do
  sleep 2
  echo "Ainda aguardando o banco de dados..."
done

echo "Banco de dados disponível! Iniciando a aplicação..."
exec "$@"
