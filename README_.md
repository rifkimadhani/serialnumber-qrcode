1. Project Structure
iwolf@MadeiraResearch serialnumber-qrcode % tree -L 2
.
├── README.md
├── app
│   ├── Http
│   ├── Imports
│   ├── Models
│   └── Providers
├── artisan
├── bootstrap
│   ├── app.php
│   ├── cache
│   └── providers.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── dompdf.php
│   ├── excel.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database
│   ├── database.sqlite
│   ├── factories
│   ├── migrations
│   └── seeders
├── package.json
├── phpunit.xml
├── public
│   ├── css
│   ├── favicon.ico
│   ├── index.php
│   ├── robots.txt
│   └── storage -> /Users/iwolf/Desktop/serialnumber-qrcode/storage/app/public
├── resources
│   ├── css
│   ├── js
│   └── views
├── routes
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   ├── framework
│   ├── logs
│   └── qrcodes
├── stubs
│   ├── export.model.stub
│   ├── export.plain.stub
│   ├── export.query-model.stub
│   ├── export.query.stub
│   ├── import.collection.stub
│   └── import.model.stub
├── tests
│   ├── Feature
│   ├── TestCase.php
│   └── Unit
├── vendor
│   ├── autoload.php
│   ├── bacon
│   ├── barryvdh
│   ├── bin
│   ├── brick
│   ├── carbonphp
│   ├── composer
│   ├── dasprid
│   ├── dflydev
│   ├── doctrine
│   ├── dompdf
│   ├── dragonmantank
│   ├── egulias
│   ├── ezyang
│   ├── fakerphp
│   ├── filp
│   ├── fruitcake
│   ├── graham-campbell
│   ├── guzzlehttp
│   ├── hamcrest
│   ├── laravel
│   ├── league
│   ├── maatwebsite
│   ├── maennchen
│   ├── markbaker
│   ├── masterminds
│   ├── mockery
│   ├── monolog
│   ├── myclabs
│   ├── nesbot
│   ├── nette
│   ├── nikic
│   ├── nunomaduro
│   ├── phar-io
│   ├── phenx
│   ├── phpoffice
│   ├── phpoption
│   ├── phpunit
│   ├── psr
│   ├── psy
│   ├── ralouphie
│   ├── ramsey
│   ├── sabberworm
│   ├── sebastian
│   ├── simplesoftwareio
│   ├── symfony
│   ├── theseer
│   ├── tijsverkoyen
│   ├── vlucas
│   ├── voku
│   └── webmozart
└── vite.config.js

81 directories, 35 files
===========================
2. Dependencies
iwolf@MadeiraResearch serialnumber-qrcode % cat composer.json | grep -A 10 "require"
    "require": {
        "php": "^8.2",
        "barryvdh/laravel-dompdf": "^2.2",
        "laravel/framework": "^11.9",
        "laravel/tinker": "^2.9",
        "maatwebsite/excel": "^3.1",
        "simplesoftwareio/simple-qrcode": "^4.2"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/pint": "^1.13",
        "laravel/sail": "^1.26",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.0",
        "phpunit/phpunit": "^11.0.1"
    },

iwolf@MadeiraResearch serialnumber-qrcode % cat package.json                            
{
    "private": true,
    "type": "module",
    "scripts": {
        "dev": "vite",
        "build": "vite build"
    },
    "devDependencies": {
        "axios": "^1.6.4",
        "laravel-vite-plugin": "^1.0",
        "vite": "^5.0"
    }
}

iwolf@MadeiraResearch serialnumber-qrcode % php artisan --version
Laravel Framework 11.15.0
iwolf@MadeiraResearch serialnumber-qrcode % php -v
PHP 8.3.9 (cli) (built: Jul  2 2024 14:10:14) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.9, Copyright (c) Zend Technologies
    with Zend OPcache v8.3.9, Copyright (c), by Zend Technologies

iwolf@MadeiraResearch serialnumber-qrcode % php -m
[PHP Modules]
bcmath
bz2
calendar
Core
ctype
curl
date
dba
dom
exif
FFI
fileinfo
filter
ftp
gd
gettext
gmp
hash
iconv
imagick
intl
json
ldap
libxml
mbstring
mysqli
mysqlnd
odbc
openssl
pcntl
pcre
PDO
pdo_dblib
pdo_mysql
PDO_ODBC
pdo_pgsql
pdo_sqlite
pgsql
Phar
posix
pspell
random
readline
Reflection
session
shmop
SimpleXML
soap
sockets
sodium
SPL
sqlite3
standard
sysvmsg
sysvsem
sysvshm
tidy
tokenizer
xml
xmlreader
xmlwriter
xsl
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache


===========================

3. Database Configuration
iwolf@MadeiraResearch serialnumber-qrcode % grep DB_ .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qrcode
DB_USERNAME=web
DB_PASSWORD=P@ssword%

===========================

4. Webserver and mariadb:
iwolf@MadeiraResearch serialnumber-qrcode % httpd -v
Server version: Apache/2.4.59 (Unix)
Server built:   Apr  3 2024 12:22:45
iwolf@MadeiraResearch serialnumber-qrcode % mariadb --version
mariadb  Ver 15.1 Distrib 10.4.34-MariaDB, for osx10.19 (arm64) using  EditLine wrapper

===========================
iwolf@MadeiraResearch serialnumber-qrcode % cat .env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:POAyS+Eu9UXNkgh8Z5jS0KK636ADqmofYlQk0ltNMdg=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qrcode
DB_USERNAME=web
DB_PASSWORD=P@ssword%

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

===========================

7. additional services
iwolf@MadeiraResearch serialnumber-qrcode % grep -r 'driver' config/
config//auth.php:            'driver' => 'session',
config//auth.php:            'driver' => 'eloquent',
config//auth.php:        //     'driver' => 'database',
config//app.php:    | These configuration options determine the driver used to determine and
config//app.php:    | manage Laravel's "maintenance mode" status. The "cache" driver will
config//app.php:    | Supported drivers: "file", "cache"
config//app.php:        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
config//mail.php:    | Laravel supports a variety of mail "transport" drivers that can be used
config//database.php:            'driver' => 'sqlite',
config//database.php:            'driver' => 'mysql',
config//database.php:            'driver' => 'mariadb',
config//database.php:            'driver' => 'pgsql',
config//database.php:            'driver' => 'sqlsrv',
config//cache.php:    | well as their drivers. You may even define multiple stores for the
config//cache.php:    | same cache driver to group types of items stored in your caches.
config//cache.php:    | Supported drivers: "array", "database", "file", "memcached",
config//cache.php:            'driver' => 'array',
config//cache.php:            'driver' => 'database',
config//cache.php:            'driver' => 'file',
config//cache.php:            'driver' => 'memcached',
config//cache.php:            'driver' => 'redis',
config//cache.php:            'driver' => 'dynamodb',
config//cache.php:            'driver' => 'octane',
config//session.php:    | This option determines the default session driver that is utilized for
config//session.php:    'driver' => env('SESSION_DRIVER', 'database'),
config//session.php:    | When utilizing the "file" session driver, the session files are placed
config//session.php:    | When using the "database" or "redis" session drivers, you may specify a
config//session.php:    | When using the "database" session driver, you may specify the table to
config//session.php:    | Some session drivers must manually sweep their storage location to get
config//queue.php:            'driver' => 'sync',
config//queue.php:            'driver' => 'database',
config//queue.php:            'driver' => 'beanstalkd',
config//queue.php:            'driver' => 'sqs',
config//queue.php:            'driver' => 'redis',
config//queue.php:    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
config//queue.php:        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
config//excel.php:        | Configure here which Pdf driver should be used by default.
config//excel.php:        | Default cell caching driver
config//excel.php:        | want to mitigate that, you can configure a cell caching driver here.
config//excel.php:        | When using the illuminate driver, it will store each value in the
config//excel.php:        'driver'      => 'memory',
config//excel.php:        | When dealing with the "batch" caching driver, it will only
config//excel.php:        | When using the "illuminate" caching driver, it will automatically use
config//logging.php:    | Available drivers: "single", "daily", "slack", "syslog",
config//logging.php:            'driver' => 'stack',
config//logging.php:            'driver' => 'single',
config//logging.php:            'driver' => 'daily',
config//logging.php:            'driver' => 'slack',
config//logging.php:            'driver' => 'monolog',
config//logging.php:            'driver' => 'monolog',
config//logging.php:            'driver' => 'syslog',
config//logging.php:            'driver' => 'errorlog',
config//logging.php:            'driver' => 'monolog',
config//filesystems.php:    | may even configure multiple disks for the same driver. Examples for
config//filesystems.php:    | most supported storage drivers are configured here for reference.
config//filesystems.php:    | Supported drivers: "local", "ftp", "sftp", "s3"
config//filesystems.php:            'driver' => 'local',
config//filesystems.php:            'driver' => 'local',
config//filesystems.php:            'driver' => 's3',
