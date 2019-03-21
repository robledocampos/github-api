# Github API

This application has two endpoints. One retrieves basic github user data and the other a user's repo list.

It was developed over a Docker running a Debian Stretch instance, with PHP 7.2 and Apache, using Laravel 5.7.

## Setup

 - To build the docker image, inside the project folder execute the following command:

        $ docker build . -t github-api-image
        
- To run the docker container, inside the project folder execute the following command, 
(make sure you do not have other service running on port 80, or change the first port number parameter):

        $ docker run -d -p 80:80 github-api-image
        
        
## Tests

   To run the tests, access the tests folde and execute the following:

        $ php ../vendor/bin/phpunit Unit --
        
## Endpoints

  - localhost[:port]/api/users/[username]
  - localhost[:port]/api/users/[username]/repos