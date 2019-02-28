<?php
namespace Conversion;
class FairePanier {
    private $ipanier;

    public function __construct($ipanier)
	{
		$this->ipanier = $ipanier;
    }

    public function getIndexOfProduit(Produit $produit) {
       return $this->ipanier->getIndexOfProduit($produit);
    }

    public function addProduit(Produit $produit)
    {
        $this->ipanier->addProduit($produit);
    }

    public function totalConverti() {
        return $this->ipanier->totalConverti();
    }
}