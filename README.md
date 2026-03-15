# Workout Tracker

🇧🇷 Português | 🇺🇸 [Read in English](README.en.md)

Workout Tracker é um projeto focado inicialmente no backend para gerenciamento de treinos, permitindo que usuários criem planos de treino, agendem exercícios e acompanhem seu progresso ao longo do tempo.

O projeto é desenvolvido de forma incremental para simular como sistemas reais evoluem — começando com uma API mínima e evoluindo para uma aplicação full-stack escalável.

---

## Sumário

- [Objetivos do Projeto](#objetivos-do-projeto)
- [Funcionalidades Principais](#funcionalidades-principais)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Executando o Projeto](#executando-o-projeto)
- [Documentação da API](#documentacao-da-api)
- [Testes](#testes)
- [Versões do Projeto](#versoes-do-projeto)

---

## Objetivos do Projeto

Este projeto tem como objetivo praticar conceitos importantes de engenharia de software:

* Design de APIs REST
* Autenticação e segurança
* Modelagem de banco de dados relacional
* Arquitetura de software
* Escalabilidade de sistemas
* Documentação de APIs
* Testes automatizados

---

## Funcionalidades Principais

### Autenticação

Usuários podem:

* Criar conta
* Fazer login
* Acessar endpoints protegidos com JWT

As requisições devem incluir:

```
Authorization: Bearer <token>
```

---

### Banco de Exercícios

Os exercícios são pré-carregados utilizando seeders.

Cada exercício possui:

* Nome
* Descrição
* Categoria
* Grupo muscular

---

### Planos de Treino

Usuários podem criar planos de treino compostos por vários exercícios.

Cada exercício contém:

* Número de séries
* Número de repetições
* Peso utilizado

Usuários podem:

* Criar treinos
* Editar treinos
* Excluir treinos
* Listar treinos

---

### Agendamento de Treinos

Usuários podem agendar treinos para datas e horários específicos.

Os treinos agendados podem ser listados em ordem cronológica.

---

### Relatórios de Progresso

O sistema pode gerar relatórios baseados nos treinos realizados.

Os relatórios incluem:

* Histórico de treinos
* Progresso em exercícios
* Frequência de treino

---

## Tecnologias Utilizadas

### Backend

* Laravel
* PostgreSQL
* JSON Web Tokens (JWT)

### Infraestrutura

* Docker

### Frontend (versões futuras)

* React
* Tailwind CSS
* Redux
* Jest

### Infraestrutura Avançada (versões futuras)

* Redis
* RabbitMQ
* Nginx
* MinIO

---

## Executando o Projeto

Este projeto utiliza Docker para garantir consistência entre ambientes de desenvolvimento.

### Pré-requisitos

* Docker
* Docker Compose

### Clonar o repositório

```
git clone https://github.com/Caca404/workout-tracker.git
cd workout-tracker
```

### Configurar variáveis de ambiente

```
cp .env.example .env
```

### Subir containers

```
docker compose up -d --build
```

### Instalar dependências

```
docker compose exec app composer install
```

### Gerar key do Laravel

```
docker compose exec app php artisan key:generate
```

### Executar migrations

```
docker compose exec app php artisan migrate
```

### Popular banco com exercícios

```
docker compose exec app php artisan db:seed
```

### Subir Laravel

```
docker compose exec app php artisan serve --host=0.0.0.0 --port=8000
```

A API estará disponível em:

```
http://localhost:8000
```

---

## Documentação da API

A API é documentada utilizando OpenAPI.

A documentação estará disponível em:

```
/docs
```

---

## Testes

Para executar os testes:

```
docker compose exec app php artisan test
```

---

## Versões do Projeto

### Versão 1 — Backend MVP

A primeira versão foca em implementar a API necessária para atender os requisitos do projeto.

Funcionalidades:

* Cadastro de usuários
* Login com autenticação JWT
* Banco de exercícios com seeders
* CRUD de planos de treino
* Agendamento de treinos
* Relatórios de progresso
* API REST
* Documentação com OpenAPI (Swagger)
* Testes unitários com Pest

Infraestrutura:

* Docker
* PostgreSQL

---

### Versão 2 — Aplicação Frontend

Nesta versão é adicionada uma interface completa para o usuário.

Stack:

* React
* Tailwind CSS
* Redux
* Jest

Funcionalidades:

* Interface de autenticação
* Criação de treinos
* Seleção de exercícios
* Agendamento de treinos
* Dashboard de progresso
* Calendário de treinos realizados
* Perfil do usuário com métricas físicas

---

### Versão 3 — Performance e Infraestrutura

Nesta versão são adicionadas melhorias de infraestrutura e performance.

Novos componentes:

* Redis para cache
* RabbitMQ para filas de processamento
* Nginx como servidor web

Exemplos de uso:

Cache:

* Lista de exercícios
* Relatórios de treino
* Treinos agendados

Filas:

* Envio de emails
* Geração de relatórios
* Processamento de dados analíticos

---

### Versão 4 — Armazenamento de Arquivos

Nesta versão o sistema passa a suportar upload de arquivos.

Novo componente:

* MinIO

Capacidades:

* Fotos de usuários
* Mídia relacionada a exercícios