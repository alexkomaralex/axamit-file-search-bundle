
AlexkomaralexFileSearchBundle
=============

The AlexkomaralexFileSearchBundle allows serch files by content in Symfony2.
It provides a flexible interface to handle different search adapters.

Features include:

- Console command
- Symfony finder adapter
- PHP Directory Iterator adapter
- Unit/Functional tested


#Installation
------------

- Install bundle via composer
 
composer require alexkomaralex/file-search-bundle dev-master

- Enable the bundle in AppKernel.php:

new Alexkomaralex\FileSearchBundle\AlexkomaralexFileSearchBundle()



#Configuration
------------

Use original services.yml as example.

Define any new search adapter as service and inject it into search command service
Or use one of two predefined adapters.



#Usage
------------

php app/console fsearch:find [--path=PATH] \<query\> 

- path - where to find
- query - what to find
