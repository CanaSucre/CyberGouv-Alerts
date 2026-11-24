<?php 

  require_once __DIR__ . '/../vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
  $dotenv->load();


  // Vérification des variables obligatoires
  $dotenv->required([
      'DB_HOST',
      'DB_PORT',
      'DB_NAME',
      'DB_USER',
      'DB_PASS',
      'API_LINK',
  ])->notEmpty();

  $config = [
    'db' => [
        'driver' => $_ENV['DB_DRIVER'],
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'port' => $_ENV['DB_PORT']
    ],

    'api_link' => $_ENV['API_LINK'],
    'env' => $_ENV['APP_ENV'],
  ];

?>