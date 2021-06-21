## Requisitos
PHP >= 7.2.5
Composer
MySQL

## Instalação
Copie e configure o .env com as senhas e tokens `cp .env.example .env`
Instale as dependências `composer artisan install`
Execute as migrations `php artisan migrate`

Caso tenha dificuldades com as APIs externas e certificados, <a href="https://stackoverflow.com/questions/24611640/curl-60-ssl-certificate-problem-unable-to-get-local-issuer-certificate">clique aqui</a>