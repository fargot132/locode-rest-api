## LOCODE REST API

Dockerized Symfony REST API application. <br />

Command to download and import LOCODE database in CSV form:<br />
php bin/console update:database

File is dowloaded to src/Data directory and processed.

It's also command to manual import extracted CSV files from src/Data directory:<br />
php bin/console csv:import<br />

API GET functions:<br />
api/getbylocode/{LOCODE} - returns JSON of LOCODE<br />
api/searchbyname/{name} - returns JSON collection of found LOCODEs<br />

Docker services:<br />
nginx - web server<br />
php - script interpreter<br />
mysql - database engine<br />
phpmyadmin - database administration<br />
scheduler - Ofelia scheduler for Docker<br />

Scheduler runs command <br />
php /var/www/symfony/bin/console update:database<br />
once a day to check for new LOCODE database at<br />
http://www.unece.org/cefact/codesfortrade/codes_index.html<br />
and update if necessary.

After containers run:
docker-compose exec php bash
php bin/console doctrine:migrations:migrate
php bin/console update:database
