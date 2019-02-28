<?php 

require_once __DIR__ . '/vendor/autoload.php';

include __DIR__.'/src/Produit.php';
include __DIR__.'/src/Panier.php';
include __DIR__.'/src/PanierSoldes.php';
include __DIR__.'/src/FairePanier.php';

use Conversion\Produit;
use Conversion\Panier;
use Conversion\PanierSoldes;
use Conversion\FairePanier;

$produit1 = new Produit("Ducky Channel One 2 TKL Skyline",1,99.99,'EUR');
$produit2 = new Produit("Echo (2nd Generation)",2,69.99,'USD');
$panier = new Panier('JPY');
$panierSpe = new PanierSoldes('JPY',20);
$panier->addProduit($produit1);
$panier->addProduit($produit2);
$panierSpe->addProduit($produit1);
$panierSpe->addProduit($produit2);
$produit1->calculerTotal();
$produit2->calculerTotal();
echo '<pre>';
print_r($panier);
echo '</pre>';

$total = $panier->totalConverti();
$devise = $panier->getDevisePanier();
echo 'Total : '.$total.' '.$devise;

  $i = new FairePanier($panierSpe);


  echo "<br/>";

  echo $i->totalConverti();

?>