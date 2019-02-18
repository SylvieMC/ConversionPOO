<?php 

require_once __DIR__ . '/vendor/autoload.php';

include __DIR__.'/src/Produit.php';
include __DIR__.'/src/Panier.php';

use Conversion\Produit;
use Conversion\Panier;

$produit = new Produit("produit test",2,50,'EUR');
$produit1 = new Produit("produit test",3,50,'USD');
$produit2 = new Produit("Symili",4,40,'BSD');
$produit3 = new Produit("Boulute",1,40,'BBD');
$panier = new Panier('BMD');
$panier->addProduit($produit);
$panier->addProduit($produit1);
$panier->addProduit($produit2);
$panier->addProduit($produit3);

$produit->calculerTotal();
$produit1->calculerTotal();
$produit2->calculerTotal();
$produit3->calculerTotal();

echo '<pre>';
print_r($panier);
echo '</pre>';
//$panier->removeProduit($produit);
$panier->removeProduit($produit3);

$total = $panier->totalConverti();
echo '------------------------<br/>';
echo $total;
echo '<br/>------------------------';

/*$response = file_get_contents('https://api.exchangeratesapi.io/latest?base=' . $this->base . ''); 
$return = json_decode($response);*/

?>