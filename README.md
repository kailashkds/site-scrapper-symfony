# Site Scrapper Symfony

Symfony project 5.4
-------------------

# Installation

* Git clone
``` bash
$ git clone https://github.com/kailashkds/site-scrapper-symfony.git
```
  * **NOTE**
    Before moving further we need to have docker and docker-compose installed on your pc. Kindly Google for it.

## Once docker is install follow the below steps

* **1) Build Docker**
``` bash
$ docker-compose build
```

* **2) Start the Docker**
``` bash
$ docker-compose up -d
```

* **3) Install external packaged**
``` bash
$ docker exec -it -u www-data  sf5_php php /usr/local/bin/composer install -d /home/wwwroot/sf5
```

* **5) Generate database schema**
``` bash
$ docker exec -it -u www-data  sf5_php php  /home/wwwroot/sf5/bin/console d:s:u --dump-sql
```

* **6) Create database schema**
``` bash
$ docker exec -it -u www-data  sf5_php php  /home/wwwroot/sf5/bin/console d:s:u --force
```

* **7) Migration Script**
``` bash
$ docker exec -it -u www-data  sf5_php php  /home/wwwroot/sf5/bin/console d:m:m
```

* **8) Yarn script**
``` bash
$ docker exec -it -u www-data  sf5_php  yarn
```
``` bash
$ docker exec -it -u www-data  sf5_php  yarn encore dev
```
* **9) Execute below command to enable symfony to read Messages from rabitMQ**
``` bash
$ docker exec -it -u www-data  sf5_php  php bin/console messenger:consume &
```
* **9) ADD Below in your host file**
``` bash
$ 127.0.0.1 test.local
```
* **10) Docker Stop**
``` bash
$ docker-compose stop
```

# Login Credentails 
* For User secrion: 
``` bash
username: user@example.com
password: user
```
* For Admin secrion: 
``` bash
username: admin@example.com
password: admin
```
