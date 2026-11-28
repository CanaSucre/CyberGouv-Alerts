<?php

require_once __DIR__ . '/../../config/config.php';

/**
 * Construit la chaîne de connexion (DSN) pour PDO en fonction du driver et des variables d'environnement.
 * @return string La chaîne de connexion DSN.
 */
function buildDsn() {
    $driver = $_ENV['DB_DRIVER'];

    // Recherche de tous les placeholders {{VAR_NAME}} dans le template de DSN
    return preg_replace_callback('/\{\{(\w+)\}\}/', function ($m) use ($driver) {
        $name = $m[1]; // Contenu du 1er groupe du regex (\w+), donc le nom de la variable
        if (!isset($_ENV[$name])) {
            throw new RuntimeException("Variable $name manquante pour construire la DSN.");
        }
        $value = $_ENV[$name];

        // SQLite : chemin relatif interprété depuis la racine du projet
        if ($driver === 'sqlite' && $name === 'DB_NAME') {
            $isAbsolute = $value === ':memory:' || preg_match('#^(/|[A-Za-z]:[\\\\/])#', $value);
            return $isAbsolute ? $value : dirname(__DIR__) . '/' . $value;
        }

        // Empêche l'injection d'un paramètre supplémentaire dans la DSN
        if (str_contains($value, ';')) {
            throw new RuntimeException("$name ne doit pas contenir de point-virgule.");
        }
        return $value;
    }, DRIVER_DSN_TEMPLATES[$driver]);
}

/**
 * Établit une connexion à la base de données et renvoie l'objet PDO correspondant.
 * @return PDO
 */
function getPDO() {
    $isSqlite = $_ENV['DB_DRIVER'] === 'sqlite';

    return new PDO(
        buildDsn(),
        $isSqlite ? null: $_ENV['DB_USER'],
        $isSqlite ? null: $_ENV['DB_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}

?>