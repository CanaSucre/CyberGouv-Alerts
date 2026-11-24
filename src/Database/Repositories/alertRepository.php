<?php

require_once __DIR__ . "/../connection.php";

/**
 * Récupère les données de l'alerte dont l'identifiant a été fourni en paramètre.
 * @param {string} $id Identifiant de l'alerte a récupérer
 * @return {string|null} Renvoie un tableau avec les données sur l'alerte si elle est présente en base de données, null sinon.
 */
function bddAlert_findById($id) {
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM alert WHERE id = :id");
    $stmt->bindParam(":id", $id);

    $stmt->execute();
    $pdo = null;


    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll();
    } else {
        return null;
    }
}

?>