# Etapa de construção
FROM node:20 AS build

# Define o diretório de trabalho
WORKDIR /app

# Copia apenas os arquivos de dependências
COPY package.json package-lock.json ./
RUN npm install

# Copia o restante da aplicação
COPY . .

# Comando para executar a aplicação em modo de desenvolvimento
CMD ["npm", "start"]

# Expondo a porta 3000
EXPOSE 3000
