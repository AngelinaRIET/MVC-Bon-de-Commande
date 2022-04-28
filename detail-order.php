<?php
// Chargement des modèles
require_once './lib/debug.php';
require_once './models/database.php';
require_once './models/orders.php';

// Code de la moulinette

// ON RÉCUPÈRE LE NUMÉRO DE COMMANDE DEMANDÉE
$orderNumber = $_GET['orderNumber'];

// ON DEMANDE AU MODÈLE DE TROUVER CETTE COMMANDE
$order = getOrderByOrderNumber($orderNumber);

// ON DEMANDE AU MODÈLE LA LISTE DES LIGNES DE LA COMMANDE
$orderDetails = getOrderDetailsByOrderNumber($orderNumber);

// ON DEMANDE AU MODÈLE LE TOTAL HT DE LA COMMANDE
$totalHTBrut = getOrderTotalByOrderNumber($orderNumber);

// CONVERTION DES TARIFS AU FORMAT FRANÇAIS
for ($i=0; $i < count($orderDetails); $i++){
    $orderDetails[$i]['priceEach'] = number_format($orderDetails[$i]['priceEach'], 2, ',', ' ');
    $orderDetails[$i]['total'] = number_format($orderDetails[$i]['total'], 2, ',', ' ');
}

// CALCUL TVA ET TTC ET FORMATAGE DU PRIX
$totalHT    = number_format($totalHTBrut,       2, ',', ' ');
$montantTVA = number_format($totalHTBrut * .2,  2, ',', ' ');
$totalTTC   = number_format($totalHTBrut * 1.2, 2, ',', ' ');

// Charge le template à la fin
include 'templates/detail-order.phtml';
