<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../Database/Repositories/alertRepository.php';



/**
 * Récupère les données de l'alerte en base de données dont l'identifiant a été fourni en paramètre.
 * @param {string} $id Identifiant de l'alerte a récupérer
 * @return {string|null} Renvoie un tableau avec les données sur l'alerte si elle est présente en base de données, null sinon.
 */
function getAlert($id) {
    return bddAlert_findById($id);
}


/**
 * Enregistre dans la base de données l'alerte dont l'ID a été fourni en paramètre ou met à jour sa date de révision si elle existe déjà.
 * @param {string} $id Identifiant de l'alerte à enregistrer dans la BDD
 * @return {boolean} Renvoie false si l'action a échouée, true si elle a réussie.
 */
function registerAlert($id) {
    $alertExistsInDb = bddAlert_findById($id);

    // Cas où une erreur est survenue lors de la récupération de l'alerte en base de données
    if ($alertExistsInDb === false) return false;

    // Cas où l'alerte n'existe pas encore en base de données, on l'enregistre
    if ($alertExistsInDb === null) {
        return bddAlert_register($id);
    } else {
        return bddAlert_updateReviewTimestamp($id);
    }
}



/**
 * Récupère toutes les alertes à partir de l'API CERTFR.
 * @return array Un tableau contenant toutes les alertes.
 */
function fetchAlerts() {
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
function fetchAlertById($id) {
    global $config;

    $link = $config['api_link'] . $config['api_alerts_by_id'];
    $link = str_replace(':id', $id, $link);

    $result = file_get_contents($link);

    $vars = json_decode($result, true);
    return $vars;
}

?>