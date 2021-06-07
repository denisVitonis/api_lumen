utilizado o Lumen Framework.
Lib Tymon JWT-Auth para tokenização da API (https://jwt-auth.readthedocs.io/en/develop/) via composer.

OBS:

-Foi habilitado o eloquent e o Facades
na Bootstrapp/app;

Foi configurado 
-Fiz com que o Lumen carregue o provedor de serviço em  Providers/AppServiceProvider
para pegar o lumen service providers dentro do pacote Tymon JWT-Auth 

-Informar ao Lumen quais drivers de autenticacao que ele utilizara (no caso "driver" JWT).
no vendor/lumen/laravel/config/auth.php

-Criado os Middlewares para autenticação e tratamento de erros(CORS) pois foi identificado que a hash api do lumen e sensivel ao CORS.

-Foi implementado nas classes a interface(Facades) fachada. para que os endpoints sejam sempre validados ...

-Devido ao tempo não consegui isolar as regras de negocio dos controllers criando um service/repository etc.

-Também faltou os relatórios , pois tive problemas no config do eloquent, e não deu tempo de analisar oque pode ter ocorrido ou se na documentação do Lumen tenha algo diferente.


////Ends points////

localhost:8001/usuarios/login
localhost:8001/usuarios/logout
localhost:8001/produtos/cadastrar
localhost:8001/pedidos/cadastrar
localhost:8001/produto/id


-Autorização utilizando o Beared










