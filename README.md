# Executando o Projeto PHP

Este guia fornecerá instruções sobre como executar um projeto PHP em seu ambiente local.

## Pré-requisitos

Antes de iniciar, verifique se o seguinte software está instalado em seu sistema:

- PHP (versão utilizada: 8.0.28)
- Servidor web 
- Gerenciador de dependências do PHP (Composer)

## Passos para Execução

Siga as etapas abaixo para executar o projeto:

1. Clone o repositório do projeto em seu ambiente local:

   ```bash
   git clone https://github.com/jaquemaggot/provaAmazonia.git

2. Navegue até o diretório do projeto:

    ```bash
    cd provaAmazonia

3. Dependências:

    - Instale o Composer (gerenciador de dependências do PHP) seguindo as instruções em https://getcomposer.org.
    - Navegue até o diretório do projeto onde está localizado o arquivo composer.json.
    - Execute o seguinte comando para instalar as dependências:
        composer install

4. Crie o arquivo .env utilizando o arquivo .env.example, com os dados de conexão com o Banco de Dados, neste projeto foi utilizado o MYSQL.

5. Execute o comando:
    
    ```bash
    php artisan migrate

6. Execute o comando:

    ```bash
    php artisan serve

7. Link Postman para que possa testar o projeto com as rotas e valores de teste.

    ```bash
    https://api.postman.com/collections/3894449-2b37d499-0710-427b-8eaa-e75ba28e441f?access_key=PMAT-01H30NN6DP0RFBVD3HZ9NZR058

8. Links para acesso aos Diagramas:

    ```bash
    https://drive.google.com/file/d/1GzoeaITCy-GIV6ho_nk3VfVr2oNP4z07/view?usp=sharing

    https://drive.google.com/file/d/1wh_6ie3Isu8GdS_tLnzlw0ZgjUb_-_Vj/view?usp=sharing

