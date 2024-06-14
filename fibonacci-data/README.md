# Fibonacci Data App API

Esta API, desenvolvida em Laravel, permite calcular e armazenar números de Fibonacci junto com uma string. O projeto foi desenvolvido para ser executado dentro de um container Docker, facilitando a configuração e portabilidade.

## Primeiros Passos:

### Pré-requisitos

- Docker instalado em seu sistema: https://www.docker.com/get-started

### Instalação

1.  **Clone o Repositório:**

    ```bash
    git clone [git@github.com:kaiorosa1/backend-challenge-kaio-rosa.git]
    ```

2.  **Configurar as Variáveis de Ambiente:**

    -   Crie uma cópia do arquivo `.env.example` e renomeie para `.env`.

    -  Preencha as variáveis de ambiente necessárias:

        -   `DB_DATABASE`:  O nome do seu banco de dados MySQL.
        -   `DB_USERNAME`:  Seu nome de usuário do MySQL.
        -   `DB_PASSWORD`: Seu senha do MySQL.
        -   `DB_HOST`: O host do MySQL.

3.  **Fazer o Build e Rodar com Docker Compose:**

    ```bash
    docker-compose up -d --build
    ```

    Este comando irá construir as imagens Docker necessárias e iniciar os containeres para seu aplicativo Laravel e o banco de dados MySQL.

## Executando as Migrações (Migrations)

Para executar as migrações da API, execute o seguinte comando no diretório raiz do seu projeto:

```bash
docker-compose exec fibonaccidataapp php artisan migrate
```

## Executando os Testes

Para executar os testes automatizados da API, execute o seguinte comando no diretório raiz do seu projeto:

```bash
docker-compose exec fibonaccidataapp php artisan test
```

## Endpoints da API

### Calcular Fibonacci - (1,2)

-   **URL:** `/api/fibonacci`
-   **Método:** `POST`
-   **Corpo da Requisição (JSON):**

    ```json
    {
        "name": "John Doe",
        "value": 10
    }
    ```

-   **Resposta (JSON):**

    ```json
    {
        "id": 1,
        "name": "John Doe",
        "value": 10,
        "result": 55
    }
    ```

### Listar todas as Consultas Fibonacci: - (3)

-   **URL:** `/api/fibonacci`
-   **Método:** `GET`
-   **Resposta (JSON):**

    ```json
    [
        {"id": 1, "name": "Alice", "value": 12, "result": 144},
        {"id": 2, "name": "Bob", "value": 8, "result": 21}
    ]
    ```


### Obter uma Consulta  fibonacci especifica - (4)

-   **URL:** `/api/fibonacci/{id}` (Substitua `{id}` pelo ID da consulta)
-   **Método:** `GET`
-   **Resposta (JSON):**

    ```json
    {
        "id": 1,
        "name": "John Doe",
        "value": 10,
        "result": 55
    }
    ```

### Filtrando Consultas Fibonacci: - (5)

### Filtro Consultas Fibonacci por nome

-   **URL:** `/api/fibonacci?name=Alice`
-   **Método:** `GET`
-   **Resposta (JSON):**

    ```json
    [
        {"id": 1, "name": "Alice", "value": 12, "result": 144}
    ]
    ```
    
### Filtro Consultas Fibonacci por valor

-   **URL:** `/api/fibonacci?value=8`
-   **Método:** `GET`
-   **Resposta (JSON):**

    ```json
    [
        {"id": 2, "name": "Bob", "value": 8, "result": 21}
    ]
    ```

###  Filtro Consultas Fibonacci por nome e valor

-   **URL:** `/api/fibonacci?name=Bob&value=8`
-   **Método:** `GET`
-   **Resposta (JSON):**

    ```json
    [
        {"id": 2, "name": "Bob", "value": 8, "result": 21}
    ]
    ```


### Atualizar Consulta Fibonacci (Atualização Parcial) - (6)

-   **URL:** `/api/fibonacci/{id}`
-   **Método:** `PATCH`
-   **Corpo da Requisição (JSON):** (Apenas os campos que você deseja atualizar)

    ```json
    {
        "name": "Alice"
    }
    ```

-   **Resposta (JSON):**

    ```json
    {
        "id": 1,
        "name": "Alice",
        "value": 12, // Não alterado
        "result": 144  // Não alterado
    }
    ```

### Atualizar Consulta Fibonacci (Atualização Completa) - (7)

-   **URL:** `/api/fibonacci/{id}`
-   **Método:** `PUT`
-   **Corpo da Requisição (JSON):** (Todos os campos são obrigatórios)

    ```json
    {
        "name": "Jane Doe",
        "value": 12
    }
    ```

-   **Resposta (JSON):**

    ```json
    {
        "id": 1,
        "name": "Jane Doe",
        "value": 12,
        "result": 144
    }
    ```



### Deletar Consulta Fibonacci - (8)

-   **URL:** `/api/fibonacci/{id}`
-   **Método:** `DELETE`
-   **Resposta (JSON):**

    ```json
    {
        "message": "Fibonacci query deleted successfully"
    }
    ```

