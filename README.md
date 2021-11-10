# Weather-api

## Installation
The project is set up with docker therefore the following command will take care of most things:
```shell
docker-compose up -d
```
The necessary packages thereafter still need to be installed with composer.

After all dependencies are installed you will need to run the migrations. This can be achieved with the following 
command inside the docker container:
```shell
php artisan migrate
```
This might throw an exception, which can be resolved by creating an empty file dubbed `databse.sqlite` in the 
database directory.

## Start
The application makes use of Authorization although not required. Sending a POST request with the following parameters 
to `/users` will store the user data.
```
'name' => string with minimum length of 2
'email' => any valid email, the same email cannot be used twice
'password' => the desired password, minimum length 6
'password_confirmation' => the desired password again
```

You can authenticate the user thereafter by making a POST request to `/users/auth` with the user's email and 
password.

## Weather
The weather data can be retrieved by making a GET request to `/weather`. This endpoint requires the parameters listed 
below
```
'city' => name of the city as defined in the CityEnum
'unit' => temperature unit as defint in UnitEnum
'date' => format d/m/Y
```
