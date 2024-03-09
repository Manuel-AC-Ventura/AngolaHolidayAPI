# AngolaHolidayAPI

## Descrição

AngolaHolidayAPI é uma API baseada em Lumen que fornece informações sobre se uma data específica é um fim de semana ou feriado em Angola.

Você pode testar a API hospedada aqui.

## Instalação

### Usando PHP localmente

1. Clone o repositório: `git clone https://github.com/Manuel-AC-Ventura/AngolaHolidayAPI.git`
2. Instale as dependências: `composer install`
3. Copie o arquivo `.env.example` para `.env` e preencha as variáveis de ambiente necessárias.
4. Inicie o servidor: `php -S localhost:8000 -t public`

### Usando Docker Compose

1. Clone o repositório: `git clone https://github.com/Manuel-AC-Ventura/AngolaHolidayAPI.git`
2. Copie o arquivo `.env.example` para `.env` e preencha as variáveis de ambiente necessárias.
3. Construa e inicie os contêineres Docker: `docker-compose up -d`

Acesse a aplicação: Depois de executar os contêineres, você deve ser capaz de acessar a aplicação em `http://localhost:8080`.

## Uso

A API tem três rotas:

- `/api/isWeekend`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um fim de semana.
- `/api/isHoliday`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um feriado.
- `/api/isHolidayOrWeekend`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um feriado ou fim de semana.

## Testes

Para executar os testes, use o comando: `./vendor/bin/phpunit`

## Contribuição

Contribuições são bem-vindas! Por favor, leia as diretrizes de contribuição antes de enviar um pull request.

## Licença

Este projeto está licenciado sob a licença MIT
