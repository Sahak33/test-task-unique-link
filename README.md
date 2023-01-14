# TEST TASK SAHAK
### Getting started 

----------
### please run the following commands to get started


----------

Install all the dependencies using composer

    composer install
Install all the dependencies using npm

    npm install
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
Generate a new application key

    php artisan key:generate
Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate 
Run the database seeder and you're done

    php artisan db:seed
Start the local development server

    npm run dev 

    php artisan serve
