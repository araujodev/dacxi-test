## Technical Test for Backend Development Team

**Autor:** Leandro de Souza Araujo / **Contato:** leandro.souara.web@gmail.com

### Rodando o projeto

O projeto está configurado para rodar com `laravel sail` e base de dados `mysql`.
Para subir o projeto, deve-se rodar o seguinte comando: 

```
./vendor/bin/sail up 
```

Por padrão a porta `3001` está configurada para acessar o projeto, o que 
pode ser reajustado pela variável de ambiente `APP_PORT` do arquivo env
(copiar de .env.example).

### Documentação

O projeto está sendo documentado com o swagger (l5 project). Para acessar a 
documentação, basta rodar o projeto e acrescentar `/api/documentation` a rota base, eg:. http://localhost:3001/api/documentation#/

Para re-gerar a documentação swagger basta utilizar o seguinte comendo: 

```
php artisan l5-swagger:generate 
```

### Dados

Para rodar as migrations:

```
php artisan migrate
```
