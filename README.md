# Installation
```
composer install
cp config/services.yml.dist config/services.yml
```

# Elaboration

> Upon more time dedicated for elaborating the setup, the following points
would be implemented:
* Colored CLI output
* ID by UUID replacement in ORM entities
* Monolog logger introduction and usage of commands execution
* Paragonie libsodium implementation together with UUID ORM entities generation
enabling and empowering more randomized UUID assignation to the data entries
and therefore concealing the statistical view of the database data (as by
default INT(11) AUTOINCREMENT UNSIGNED NO NULL triggers the summing view of
the stored data and could be easily exploited by the hacker gained access to 
the database, or at least to a single column of several database tables)
* The entities extension, so that additional entities like Unit, meybe some
aggregation measurements entities are added to the database and XML
mappings, more following the ORM methodology and approach.