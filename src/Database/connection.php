<?php

require_once __DIR__ . '/../../config/config.php';

/**
 * Établit une connexion à la base de données et renvoie l'objet PDO correspondant.
 * @return PDO
 */
function getPDO() {
  $driver = $_ENV['DB_DRIVER'];
  $host = $_ENV['DB_HOST'];
  $dbname = $_ENV['DB_NAME'];
  $username = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASS'];
  $port = $_ENV['DB_PORT'];

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