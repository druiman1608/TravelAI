FROM node:22-alpine

WORKDIR /app

COPY frontend/package*.json ./

RUN npm ci

COPY frontend/ .

EXPOSE 8080

CMD ["npm", "run", "dev", "--", "--port", "8080", "--host"]
