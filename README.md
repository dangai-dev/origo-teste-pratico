## Teste Prático - Desenvolvedor PHP - Órigo

### Instalação do projeto:

1. Clone o projeto a partir do repositório  
> `git clone git@github.com:dangai-dev/origo-teste-pratico.git`
2. Instale as dependências do projeto via Composer 
> `composer install`
3. Rode as migrations através do comando
> `php artisan migrate`
3. Suba um servidor local através do artisan | http://localhost:8000
> `php artisan serve`
4. Utilizando-se do Postman, teste os endpoints da API. (http://localhost:8000/api/link)

## Requisitos

- PHP >= 8.1.9
- Mysql (última versão)
- Composer (última versão)
- Git (última versão)

## Endpoints da API

- GET | /api/link
##### Lista todos os links encurtados habilitados

- GET | /api/link/{$id}
##### Lista um link encurtado específico

- POST | /api/link
##### Insere um link encurtado | Deve-se incluir o parâmetro 'url' via query string

- PUT | /api/link/{$id}
##### Desabilita um link encurtado
