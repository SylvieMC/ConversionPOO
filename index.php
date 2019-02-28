<?php 

require_once __DIR__ . '/vendor/autoload.php';

include __DIR__.'/src/Produit.php';
include __DIR__.'/src/Panier.php';

use Conversion\Produit;
use Conversion\Panier;

$produit1 = new Produit("Ducky Channel One 2 TKL Skyline",1,99.99,'EUR');
$produit2 = new Produit("Echo (2nd Generation)",2,69.99,'USD');
$panier = new Panier('JPY');
$panier->addProduit($produit1);
$panier->addProduit($produit2);
$produit1->calculerTotal();
$produit2->calculerTotal();
echo '<pre>';
print_r($panier);
echo '</pre>';

$total = $panier->totalConverti();
$devise = $panier->getDevisePanier();
echo 'Total : '.$total.' '.$devise;

?>