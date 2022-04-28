<?php
require_once './lib/debug.php';
require_once './models/database.php';
require_once './models/orders.php';


$nbOrders = getOrdersCount();
$allOrders = getAllOrders();


/*
 * $orders est un tableau à 2 dimensions contenant les résultats de la
 * requête SQL SELECT : 
 * - la première dimension représente les lignes
 * - la deuxième dimension représente les colonnes
 * 
 * Ainsi $orders[2]['customerName'] c'est le nom du troisième client
 */

//debugTable($orders);
include 'templates/index.phtml';