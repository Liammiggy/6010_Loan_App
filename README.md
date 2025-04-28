### Loan Application System
A system that manages loan applicatioins
----------------------------------------
### .env DB setup
### DB_CONNECTION=mysql
### DB_HOST=127.0.0.1 #localhost
### DB_PORT=3306 #default port
### DB_DATABASE=db_name # change db_name with the name created in database
### DB_USERNAME=db_user # use database user for access
### DB_PASSWORD= #if with password include
----------------------------------------------
CLI Commands
----------------------------------------------
### cp .env.example .env
Create a copy file of env.example

### composer install
Installs the required PHP Library

### php artisan migrate / php artisan migrate:fresh 
Command that will migrate database migrations to populte in table

### php artisan db:seed
Command will create predefined data in to table

### php artisan key:generate
Command to generate app key

### npm install
This will install the required js modules to be used by the system

### php artisan serve
Command will enable the application to run in php development server. Navigate to browser and type [http://localhost:8080] or [http://127.0.0.1:8080]

### npm run dev
Compiles the js files and it's necessary files to enable the full use of the system
-----------------------------------------------------------------
Navigate to the web root directory and run the following commands

### composer install
### cp .env.example .env
### php artisan migrate / php artisan migrate:fresh 
### php artisan db:seed
### php artisan key:generate
### npm install
### npm run dev
### php artisan serve