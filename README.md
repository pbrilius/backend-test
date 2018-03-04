# Installation
```
composer install
cp config/services.yml.dist config/services.yml
vendor/bin/doctrine orm:schema-tool:create
vendor/bin/doctrine orm:validate-schema
```
Or import latest database snapshot in backup dir:
```
zcat backup/{YYY-MM-DD}-backend-test.sql.gz | mysql -nEv -ubackend_test -pbackend_test backend_test
```

# Usage

> The commands available for usage:
* `php command.php app:load-data "data/testdata.json"`
* `php command.php app:aggregate`
* `php command.php app:search --unit=<unitId> --metric=<(download|upload|packet_loss|latency)> --hour=<[0..24]>`

# Elaboration

> Upon more time dedicated for elaborating the setup, the following points
would be implemented:
* Colored CLI output
* ID by UUID replacement in ORM entities
* Monolog logger introduction and usage of commands execution
* Paragonie libsodium implementation together with UUID ORM entities generation
enabling and empowering more randomized UUID assignation to the data entries
and therefore concealing the statistical view of the database data (as by
default INT(11) AUTOINCREMENT UNSIGNED NOT   NULL triggers the summing view of
the stored data and could be easily exploited by the hacker gained access to 
the database, or at least to a single column of several database tables)
* The entities extension, so that additional entities like Unit, maybe some
aggregation measurements entities are added to the database and XML
mappings, more following the ORM methodology and approach
* Fixtures installation, adding generated fake data to the application setup
* Refinement of commands description, help and explanation, so that the end user
could see the commands usage examples and available input arguments options

# Note

> The following parts are more of an interest in the applicatino:
* Fixed scale and precision FLOAT MySQL data type, which for median indicators
and aggregation allows and empowers more thorough and faster storing,
reading and displaying to the UI
* The display of the aggregated rows is formatted to the defined float type
decimal length