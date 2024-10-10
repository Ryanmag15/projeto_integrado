# Etapa de construção
FROM node:20 AS build

# Define o diretório de trabalho
WORKDIR /app

# Copia apenas os arquivos de dependências
COPY package.json package-lock.json ./
RUN npm install

# Copia o restante da aplicação
COPY . .

# Executa o build da aplicação
RUN npm run build

# Etapa final
FROM nginx:alpine

# Copia os arquivos gerados para o Nginx
COPY --from=build /app/build /usr/share/nginx/html

# Copia a configuração do Nginx
COPY ./.docker/server/nginx.conf /etc/nginx/conf.d/default.conf

# Expondo a porta 80
EXPOSE 80

# Comando para iniciar o Nginx
CMD ["nginx", "-g", "daemon off;"]
