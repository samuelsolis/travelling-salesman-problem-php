#Traveller Salesman Solution

This is a simple resolution for the travelling salesman problem using a
 backtraking algorithm only created to teach some PHP skills. 
 
To test the proyect you only have to execute the index.php, set a number of towns that the traveller has to visit
and then complete the distances between towns.

The dependencies is managed using composer altouth just one dependency is listed (twig).
It seems useless but the purpose is teach how to manage a program with composer.

In `/src` you can find some classes to manage the schema, the database and some stuff.
In `/templates` you can find some simple Twig templates used for the project.

The class `Backtracking` contain the recursive solution for the travelling salesman problem.

## How to install
Just execute `composer install` to get the dependencies.

