# front/Dockerfile

FROM node:20

# Define o diretório de trabalho
WORKDIR /app

# Copia o package.json e instala as dependências
COPY package*.json ./
RUN npm install

# Copia o código do React
COPY . .

# Builda o projeto
RUN npm run build

# Exponha a porta que o React vai rodar
EXPOSE 3000

# Comando para iniciar o servidor
CMD ["npm", "start"]
