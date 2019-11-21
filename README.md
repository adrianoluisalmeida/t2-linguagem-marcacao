## Trabalho de Linguagens de Marcação Extensíveis

**Aluno:** Adriano Luís de Almeida

Trabalho desenvolvido em PHP e JSON

1 - A conversão do arquivo GioMovies.xtm para JSON foi realizada através de uma aplicação grátis online (https://www.freeformatter.com/xml-to-json-converter.html).

2 - A validação do arquivo JSON está no arquivo movies-schema.php. Esse código utiliza de uma biblioteca de terceiros para executar a validação das estruturas JSON em relação ao schema. Biblioteca: [justinrainbow/json-schema]([https://github.com/justinrainbow/json-schema).

Caso o arquivo esteja formato de acordo com a validação, apenas uma mensagem simples será retornada: "O documento informado é válido.". Por outro lado, se acontecer do arquivo estiver mal formatado, o resultado será semelhante ao seguinte:

```php
//O documento é inválido. Violações: 
//[topic[0].baseName] The property baseName is required
```

O resultado acima indica que a propriedade do baseName não foi econtrada no primeiro tópico da estrutura JSON.

O schema pode ser executado através do terminal, usando o seguinte comando:

```php
php movies-schema.php
```
ou ainda, através do servidor embutido do PHP e visualizado no browser. Para executar o servidor embutido, basta executar o seguinte comando no terminal:

```php
php -S localhost:8000
```
Depois de rodar o servidor embutido, basta acessar o seguinte endereço: localhost:8000/movies-schema.php

3 - Para realizar as consultas no JSON, foi implementado uma biblioteca de teceiros com o objetivo de aproximar ao máximo das consultas realizadas no xml usando XPATH. Para tal, a biblioteca [galbar/jsonpath](https://github.com/Galbar/JsonPath-PHP) foi utilizada.

Essa biblioteca possui uma codificação muito próxima ao xpath, inclusive na sua decoumentação podemos as poucas diferenças entre ambas [Documentação do jsonPath](https://goessner.net/articles/JsonPath/).

Para executar as consultas presentes no arquivo [consultas.txt](./consultas.txt) é necessário executar o arquivo consulta.php seguido pela query que será realizada. 
Exemplo:

```php
php consulta.php "$.topic[?(@.instanceOf.topicRef.* == '#Genero')].baseName.baseNameString"
```

4 - As transformações do arquivo para gerar a página html com listagem de filmes, está no arquivo index.php e index-movies.php.  Para visualizar basta executar o servidor embutido e abrir o endereço principal no navegador.

```php
php -S localhost:8000

//acesse localhost:8000
```

Link do trabalho no github:  https://github.com/adrianoluisalmeida/t2-linguagem-marcacao


## Referências e bibliotecas

* Conversor XML -> JSON - [https://www.freeformatter.com/xml-to-json-converter.html](https://www.freeformatter.com/xml-to-json-converter.html)      
* Biblioteca JsonSchema - [https://github.com/justinrainbow/json-schema](https://github.com/justinrainbow/json-schema)    
* Biblioteca JsonPath - [https://goessner.net/articles/JsonPath/](https://goessner.net/articles/JsonPath/)     
* Documentação do jsonPath - [https://goessner.net/articles/JsonPath/](https://goessner.net/articles/JsonPath/)     