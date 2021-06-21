## Requisitos
PHP >= 7.2.5<br>
Composer<br>
MySQL<br>

## Instalação
Copie e configure o .env com as senhas e tokens `cp .env.example .env`<br>
Instale as dependências `composer install`<br>
Execute as migrations `php artisan migrate`<br>
Execute o PHP `php artisan serve`, o sistema estará disponível na rota /datafrete<br>

Caso tenha dificuldades com as APIs externas e certificados, <a target="_blank" href="https://stackoverflow.com/questions/24611640/curl-60-ssl-certificate-problem-unable-to-get-local-issuer-certificate">clique aqui</a><br>
Outras dúvidas pode entrar em contato por e-mail