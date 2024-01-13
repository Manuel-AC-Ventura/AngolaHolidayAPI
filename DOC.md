Claro, aqui está um exemplo de documentação para a sua API:

# Documentação da API AngolaHolidayAPI

## Visão Geral

A AngolaHolidayAPI é uma API RESTful que permite verificar se uma data específica é um feriado ou fim de semana em Angola. A API utiliza a API do Google Calendar para obter informações sobre feriados.

## Endpoints

### GET `/`

Retorna uma mensagem de boas-vindas.

**Resposta:**

```json
"Bem-vindo à API AngolaHoliday!"
```

### POST `/isWeekend`

Verifica se uma data é um fim de semana.

**Parâmetros:**

- `date`: A data a ser verificada no formato `YYYY-MM-DD`.

**Resposta:**

Retorna um objeto JSON com a chave `isWeekend` que é `true` se a data for um fim de semana e `false` caso contrário.

```json
{
    "isWeekend": true
}
```

### POST `/isHoliday`

Verifica se uma data é um feriado.

**Parâmetros:**

- `date`: A data a ser verificada no formato `YYYY-MM-DD`.

**Resposta:**

Retorna um objeto JSON com a chave `isHoliday` que é `true` se a data for um feriado e `false` caso contrário.

```json
{
    "isHoliday": true
}
```

### POST `/isHolidayOrWeekend`

Verifica se uma data é um feriado ou fim de semana.

**Parâmetros:**

- `date`: A data a ser verificada no formato `YYYY-MM-DD`.

**Resposta:**

Retorna um objeto JSON com a chave `isHolidayOrWeekend` que é `true` se a data for um feriado ou fim de semana e `false` caso contrário.

```json
{
    "isHolidayOrWeekend": true
}
```

## Erros

Se ocorrer um erro durante o processamento da solicitação, a API retornará um objeto JSON com a chave `error` e uma mensagem de erro.

```json
{
    "error": "Mensagem de erro"
}
```

## Testes

Os testes para a API estão no arquivo `AngolaHolidayAPITest.php`. Você pode executar os testes usando o PHPUnit.

Espero que isso ajude! Se você tiver mais perguntas, sinta-se à vontade para perguntar. 😊