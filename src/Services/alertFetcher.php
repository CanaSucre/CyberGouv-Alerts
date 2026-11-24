<?php

require_once __DIR__ . '/../../config/config.php';


/**
 * Récupère toutes les alertes à partir de l'API CERTFR.
 * @return array Un tableau contenant toutes les alertes.
 */
function getAlerts() {
    global $config;

    $result = file_get_contents($config['api_link'] . $config['api_all_alerts']);

    $vars = json_decode($result, true);
    return $vars;
}



/**
 * Récupère les données d'une alerte spécifique à partir de l'API CERTFR.
 * @param string $id L'identifiant de l'alerte à récupérer.
 * @return array|null Les données de l'alerte sous forme de tableau associatif, ou null si l'alerte n'a pas été trouvée.
 */
function getAlertById($id) {
    global $config;

    $link = $config['api_link'] . $config['api_alerts_by_id'];
    $link = str_replace(':id', $id, $link);

    $result = file_get_contents($link);

    $vars = json_decode($result, true);
    return $vars;
}

?>