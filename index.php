<?php

require_once('vendor/autoload.php');

require_once('src/DeliveryManForm.class.php');
require_once ('src/CSVFile.class.php');
require_once ('src/Backtraking.class.php');

$fileManager = new CSVFile('files/towns.csv');

$DeliveryManForm = new DeliveryManForm($fileManager);

/*
 * Submit management.
 */
if (!empty($_POST)) {
  $DeliveryManForm->submit();
}

$DeliveryManForm->render();

$backtraking = new Backtraking($fileManager);

// Mark 0th node as visited
$v = [];
$v[0] = true;
$sol = PHP_INT_MAX;

// Find the minimum weight Hamiltonian Cycle
$backtraking->tsp($v, 0, 1, 0, $sol);

print '<p>The minimal distance is: ' . $sol . '</p>';