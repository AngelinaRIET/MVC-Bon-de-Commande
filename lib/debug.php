<?php

function debugTable($table) {

    echo '<pre>';
    print_r($table);
    echo '</pre>';
}

function d($table){
    debugTable($table);
}