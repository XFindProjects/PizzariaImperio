# TODOS

- verificar o pacote appstract/laravel-blade-directives e aplica-lo nas views

# Passos para colocar em produção

* ```php 
    cp .env.example .env 
    ```
* ``` 
    update database credentials   
    ```
* ```php 
    php artisan key:generate        
    ```
* ```php 
    php artisan jwt:secret
    ```
* ```php 
    php artisan migrate 
    ```
* ```php 
   php artisan db:seed 
    ```
* ```php 
   php artisan storage:link 
    ```