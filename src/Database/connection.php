<?php

require_once __DIR__ . '/../../config/config.php';

/**
 * Établit une connexion à la base de données et renvoie l'objet PDO correspondant.
 * @return PDO
 */
function getPDO() {
  global $config;
  
  $driver = $config['db']['driver'];
  $host = $config['db']['host'];
  $dbname = $config['db']['name'];
  $username = $config['db']['user'];
  $password = $config['db']['password'];
  $port = $config['db']['port'];

  $pdo = new PDO(
      "$driver:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
      $username,
      $password,
      [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
  );

  // Renvoie les données sous forme de tableau associatif par défaut
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  return $pdo;
}

?>