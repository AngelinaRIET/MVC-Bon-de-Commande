<?php

/**
 * Retourne le nombre de commandes dans la Base de données²
 *
 * @return int Le nombre de commandes
 */
function getOrdersCount(){
    global $database;

    // DEMANDE À LA DATABASE DE CRÉER UNE REQUÊTE SQL
    $query = $database->prepare("SELECT count(*) FROM orders");

    // DEMANDE À LA DATABASE D'ÉXÉCUTER LA REQUÊTE
    $success = $query->execute();
    
    // DEMANDE À LA REQUÊTE DE NOUS DONNER LE RESULTAT (1 seul)
    $resultat = $query->fetch();

    return $resultat['count(*)'];
}


/**
 * Retourne toutes les commandes de la Base de donnée
 *
 * @return array Tableau associatif des commandes
 */
 function getAllOrders(){
    global $database;

    // DEMANDE À LA DATABASE DE CRÉER UNE REQUÊTE SQL
    $query = $database->prepare("SELECT * FROM orders"); 

    // DEMANDE À LA DATABASE D'ÉXÉCUTER LA REQUÊTE
    $success = $query->execute();
    
    // DEMANDE À LA REQUÊTE DE NOUS DONNER LE RESULTAT (tous)
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);    

    // RENVOIE LA LISTE DES COMMANDES
    return $resultat;
 }

 /**
  * Trouve et renvoie une commande par son numéro de commande unique
  *
  * @param int $orderNumber Le numéro de commande
  * @return array La commande trouvée
  */
 function getOrderByOrderNumber($orderNumber){
    global $database;

    
    // ÉCRITURE DE LA REQUÊTE DANS UNE VARIABLE DE TYPE "string"
    $SQL = 'SELECT * 
            FROM `orders` 
            JOIN `customers` ON `orders`.`customerNumber` = `customers`.`customerNumber`
            WHERE `orderNumber` = :orderNumber';

    // DEMANDE À LA DATABASE DE CRÉER LA REQUÊTE SQL
    $query = $database->prepare($SQL);     
    
    // DEMANDE À LA DATABASE D'ÉXÉCUTER LA REQUÊTE
    $success = $query->execute([
        ':orderNumber' => $orderNumber
    ]);    

    // DEMANDE À LA REQUÊTE DE NOUS DONNER LE RESULTAT (1 seul)
    $resultat = $query->fetch(PDO::FETCH_ASSOC);    

     // RENVOIE LA COMMANDE 
    return $resultat;
 }


 /**
  * Trouve et renvoie les lignes commande par son numéro de commande unique
  *
  * @param int $orderNumber Le numéro de commande
  * @return array La commande trouvée
  */
 function getOrderDetailsByOrderNumber($orderNumber){
    global $database;

    // ÉCRITURE DE LA REQUÊTE DANS UNE VARIABLE DE TYPE "string"
    $SQL = 'SELECT *, ROUND((`priceEach`*`quantityOrdered`), 2) AS `total`
            FROM `orderdetails` 
            JOIN `products` ON `orderdetails`.`productCode` = `products`.`productCode`
            WHERE `orderNumber` = :orderNumber';    

    // DEMANDE À LA DATABASE DE CRÉER LA REQUÊTE SQL
    $query = $database->prepare($SQL);    

    // DEMANDE À LA DATABASE D'ÉXÉCUTER LA REQUÊTE
    $success = $query->execute([
        ':orderNumber' => $orderNumber
    ]);        

    // DEMANDE À LA REQUÊTE DE NOUS DONNER LE RESULTAT (Tous)
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);        

    // RENVOIE LA COMMANDE 
    return $resultat;
 }

 /**
  * Renvoie le totalHT de la commande $orderNumber
  *
  * @param int $orderNumber Le numéro de la commande
  * @return int total HT
  */
 function getOrderTotalByOrderNumber($orderNumber){
    global $database;

    // ÉCRITURE DE LA REQUÊTE DANS UNE VARIABLE DE TYPE "string"
    $SQL = "SELECT ROUND(SUM(`priceEach`*`quantityOrdered`), 2) as `totalHT`
            FROM `orderdetails`
            WHERE `orderNumber` = :orderNumber";

    // DEMANDE À LA DATABASE DE CRÉER LA REQUÊTE SQL
    $query = $database->prepare($SQL);    

    // DEMANDE À LA DATABASE D'ÉXÉCUTER LA REQUÊTE
    $success = $query->execute([
        ':orderNumber' => $orderNumber
    ]);        

    // DEMANDE À LA REQUÊTE DE NOUS DONNER LE RESULTAT (Un seul)
    $resultat = $query->fetch(PDO::FETCH_ASSOC);        

    // RENVOIE DIRECTEMENT LA VALEUR CONTENUE DANS LE ARRAY RESULTAT
    return $resultat['totalHT'];
}



