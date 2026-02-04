<?php

$pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';

$stmt = $pdo->prepare('SELECT "Subscribers" FROM public.subscribers');
$stmt->execute();
$r51 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fetch_array_id = [];

$count_fetch_proptee=0;


foreach ($r51 as $fetch_array) {

    $fetch_array_id[$count_fetch_proptee]=$fetch_array['Subscribers'];
    
    $count_fetch_proptee++;
    
}


