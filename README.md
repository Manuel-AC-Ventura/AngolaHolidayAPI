# AngolaHolidayAPI

## Descrição

A AngolaHolidayAPI é uma API RESTful desenvolvida em PHP que permite verificar se uma data específica é um feriado ou fim de semana em Angola. A API utiliza a API do Google Calendar para obter informações sobre feriados.

## Instalação

1. Clone o repositório para o seu ambiente local.
2. Instale as dependências do projeto com o Composer usando o comando `composer install`.
3. Crie um arquivo `.env` na raiz do projeto e adicione a sua chave da API do Google Calendar como `GOOGLE_API_KEY`.

## Uso

Inicie o servidor PHP na raiz do projeto com o comando `php -S localhost:8000 -t public`. Agora você pode acessar a API em `http://localhost:8000`.

A API possui os seguintes endpoints:

- `GET /`: Retorna uma mensagem de boas-vindas.
- `POST /isWeekend`: Verifica se uma data é um fim de semana. A data deve ser enviada no corpo da solicitação no formato `{"date": "YYYY-MM-DD"}`.
- `POST /isHoliday`: Verifica se uma data é um feriado. A data deve ser enviada no corpo da solicitação no formato `{"date": "YYYY-MM-DD"}`.
- `POST /isHolidayOrWeekend`: Verifica se uma data é um feriado ou fim de semana. A data deve ser enviada no corpo da solicitação no formato `{"date": "YYYY-MM-DD"}`.

## Testes

Os testes para a API estão no arquivo `AngolaHolidayAPITest.php`. Você pode executar os testes usando o PHPUnit com o comando `./vendor/bin/phpunit AngolaHolidayAPITest.php`.

## Contribuição

Contribuições são bem-vindas! Por favor, leia as diretrizes de contribuição antes de enviar uma pull request.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.
