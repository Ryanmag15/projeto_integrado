# Use a imagem oficial do Node.js
FROM node:20

# Define o diretório de trabalho dentro do contêiner
WORKDIR /app

# Copia os arquivos package.json e package-lock.json (se existir) para o diretório de trabalho
COPY package.json ./
COPY package-lock.json ./


# Instala as dependências do projeto
RUN npm install

# Copia todo o código da aplicação para o diretório de trabalho
COPY . .

# Builda o projeto React para produção
RUN npm run build

# Instala o `serve` globalmente para servir os arquivos estáticos
RUN npm install -g serve

# Exponha a porta 3000 para que o contêiner possa ser acessado externamente
EXPOSE 3000

# Comando para rodar o servidor que vai servir o build do React
CMD ["serve", "-s", "build", "-l", "3000"]
