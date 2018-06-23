## Observations for project operation

-  Make the clone for your computer.

 - Change database information in `app/config/parameters.yml`;

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
