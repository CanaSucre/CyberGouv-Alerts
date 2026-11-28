<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/constants.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
	$dotenv->safeLoad();

	// --- Variables communes ---
	$dotenv->required(['APP_ENV'])->allowedValues(ALLOWED_APP_ENV);
	$dotenv->required(['API_LINK', 'API_ALL_ALERTS', 'API_ALERTS_BY_ID'])->notEmpty();

	// --- Driver ---
	$dotenv->required('DB_DRIVER')->notEmpty()->allowedValues(AUTHORIZED_DRIVERS);
	$driver = $_ENV['DB_DRIVER'];

	if (!in_array($driver, PDO::getAvailableDrivers(), true)) {
			throw new RuntimeException(
					"Le driver PDO « $driver » n'est pas installé sur le serveur (extension pdo_$driver manquante)."
			);
	}

	// --- Variables propres au driver ---
	$required = DRIVER_REQUIRED_ENV_VARS[$driver];
	$dotenv->required($required);
	$dotenv->required(array_diff($required, DRIVER_EMPTYABLE_ENV_VARS[$driver]))->notEmpty();

	if (in_array('DB_PORT', $required, true)) {
			$dotenv->required('DB_PORT')->isInteger();
			
			if ((int) $_ENV['DB_PORT'] < 1 || (int) $_ENV['DB_PORT'] > 65535) {
					throw new RuntimeException("DB_PORT doit être compris entre 1 et 65535.");
			}
	}

	if (in_array('DB_CHARSET', $required, true) && !preg_match('/^[A-Za-z0-9_]+$/', $_ENV['DB_CHARSET'])) {
			throw new RuntimeException("DB_CHARSET contient des caractères invalides.");
	}

?>