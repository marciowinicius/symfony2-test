## Observations for project operation

##### If you wanna just run the project without docker
-  Make the clone for your computer.
 - `cd application`
 - Copy `app/config/parameters.yml.dist` into `app/config/parameters.yml`
 - Create a database and change database information in `app/config/parameters.yml`;

    parameters:
	    database_host: 127.0.0.1
	    database_port: 3306
	    database_name: 'database_name'
		database_user: 'database_user'
	    database_password: 'database_password'


### Run commands

- composer update
- php app/console doctrine:database:create
- php app/console doctrine:schema:update --force
- php app/console server:run
    
Now you can type in your browser `localhost:8000/` and to access API DOC `localhost:8000/api/doc`.


##### If you wanna run with docker

- Make the clone for your computer.
- Modify your `hosts` file on he host machine by adding the virtual host:
 
 ```
 127.0.0.1 symfony.localhost
 ```
 
 - If you are using windows with docker toolbox you need to pick the docker-machine IP to use
 
 > Run docker-compose up
 
 > The docker installation exposes ports **80** and **3306** so this 2 ports must be free on the host machine
 
 > You don't need to run composer install or update, docker take care of it
 
 Now you can type in your browser and to access API DOC `/api/doc`.

 
 ###### Docker packages
 
 - Ubuntu Server 16.04(official docker image **php:7.0-apache**)
 - Apache2(official docker image **php:7.0-apache**)
 - PHP7(official docker image **php:7.0-apache**)
 - MySQL(official docker image, latest stable version)
 - CURL
 - Composer