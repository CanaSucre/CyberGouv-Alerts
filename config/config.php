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
      'APP_ENV',
      'API_LINK',
      'API_ALL_ALERTS',
      'API_ALERTS_BY_ID',
  ])->notEmpty();

?>