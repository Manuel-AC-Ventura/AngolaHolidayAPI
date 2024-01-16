# AngolaHolidayAPI

## Descrição

AngolaHolidayAPI é uma API baseada em Lumen que fornece informações sobre se uma data específica é um fim de semana ou feriado em Angola.

Você pode testar a API hospedada [aqui](https://angolaholidayapi.onrender.com/).

## Instalação

### Usando PHP localmente

1. Clone o repositório: `git clone https://github.com/Manuel-AC-Ventura/AngolaHolidayAPI.git`
2. Instale as dependências: `composer install`
3. Copie o arquivo `.env.example` para `.env` e preencha as variáveis de ambiente necessárias.
4. Inicie o servidor: `php -S localhost:8000 -t public`

### Usando Docker

1. Construa a imagem Docker: No diretório do projeto, onde o Dockerfile está localizado, execute o seguinte comando para construir a imagem Docker:

```bash
docker build -t angolaholidayapi .
```

Neste comando, `angolaholidayapi` é o nome que você está dando à imagem Docker. Você pode escolher um nome diferente se preferir.

2. Execute o contêiner Docker: Depois de construir a imagem, você pode executar um contêiner a partir dessa imagem com o seguinte comando:

```bash
docker run -d -p 8080:80 --name myapp angolaholidayapi
```

Neste comando:
- `-d` faz com que o contêiner seja executado em segundo plano.
- `-p 8080:80` mapeia a porta 80 do contêiner para a porta 8080 do seu host.
- `--name myapp` dá ao contêiner o nome "myapp".
- `angolaholidayapi` é o nome da imagem que você deseja executar.

3. Acesse a aplicação: Depois de executar o contêiner, você deve ser capaz de acessar a aplicação em `http://localhost:8080`.

Lembre-se de que você precisará fornecer as variáveis de ambiente necessárias (como `APP_KEY` e `GOOGLE_API_KEY`) para o contêiner Docker. Você pode fazer isso adicionando opções `-e` ao comando `docker run`, como `-e APP_KEY=sua_chave_app -e GOOGLE_API_KEY=sua_chave_api_google`.

## Uso

A API tem três rotas:

- `/isWeekend`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um fim de semana.
- `/isHoliday`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um feriado.
- `/isHolidayOrWeekend`: Aceita uma data no formato 'YYYY-MM-DD' e retorna um valor booleano indicando se a data é um feriado ou fim de semana.

## Testes

Para executar os testes, use o comando: `./vendor/bin/phpunit`

## Contribuição

Contribuições são bem-vindas! Por favor, leia as diretrizes de contribuição antes de enviar um pull request.

## Licença

Este projeto está licenciado sob a licença MIT