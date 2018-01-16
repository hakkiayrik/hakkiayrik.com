<?php

define('ROOT_DIR', __DIR__); // Kök dizin
define('APP_DIR', ROOT_DIR.'/app'); // Uygulama dizini
define('CORE_DIR', APP_DIR.'/core'); // Çekirdek dizini
define('MDIR', APP_DIR.'/models'); // Model dizini
define('VDIR', APP_DIR.'/views'); // View dizini
define('AVDIR', APP_DIR.'/views/admin'); // View dizini
define('CDIR', APP_DIR.'/controllers'); // Controller dizini
define('URL', 'http://localhost'); // Sistemin çalışacağı URL

// Veritabanı ayarlamalarını yapıyoruz
define('DB_DSN', 'mysql:host=localhost;dbname=hakkiayrik;charset=utf8');
define('DB_USR', 'root');
define('DB_PWD', '');

// Çekirdek sınıflarımızı dahil ediyoruz
// Bu uygulamanın çalışması için mecburi
require CORE_DIR.'/app.php';
require CORE_DIR.'/model.php';
require CORE_DIR.'/view.php';
require CORE_DIR.'/controller.php';
require APP_DIR.'/lib/tools.php';

// Uygulamamızı oluşturuyoruz
$app = new app;

// Oluşturduğumuz uygulamayı çalıştırıyoruz
$app->run();