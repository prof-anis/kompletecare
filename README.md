Kompletecare Code Test


Running the app

Ensure your platform is running PHP 8.1 and composer v2
Create a copy of the environmental variables by running `cp .env.example .env`
Update the .env file with the correct database credentials and mail client credentials
Install dependencies by running `composer install --ignore-platform-reqs`
Run the migration and seeder files by running `php artisan migrate:refresh --seed`
Run tests with phpunit by running `phpunit` at the base directory of the project.
The two endpoints in the project are 

/api/laboratory-tests
/api/laboratory-tests/{user_id}

A Documentation of the API can be found here https://documenter.getpostman.com/view/19195441/UyxnEkLg#7e2d7dca-b214-4dbd-9a9d-7a03609b61a6

Two users have been seeded with ID 1 and 2 respectively. Any of them can be used to replace the {user_id} in the second endpoint
Both endpoints are only accessible by authenticated users who use a bearer token with the token set as `VXNlciBBY2Nlc3MgVG9rZW4=`
