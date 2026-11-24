<?php

require_once __DIR__ . '/../../config/config.php';

function getAlerts() {
    global $config;

    $result = file_get_contents($config['api_link'] . $config['api_all_alerts']);

    $vars = json_decode($result, true);
    return $vars;
}

?>