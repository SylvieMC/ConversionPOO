<?php

namespace Conversion;

class Panier
{

	private $produits;
	private $totalConverti;
	private  $devise_panier;


	public function __construct($devise_panier)
	{
		$this->devisePanier = $devise_panier;
	}

	public function getProduits()
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit)
    {
			$this->produits[] = $produit;
    }

    public function increaseQuantite(Produit $produit,$quantite)
    {
    	if(count($this->produits) == 0)
		{
			echo "Votre panier est vide";
		}
		else
		{
	    	$produitExiste = $this->getIndexOfProduit($produit);
	    	if($produitExiste == -1)
	    	{
	    		echo "Ce produit n'est pas dans votre panier<br/>";
	    	}
	    	else
	    	{
	    		if(!is_int($quantite) || $quantite < 0)
	    		{
	    			echo 'Quantité non valide';
	    		}
	    		else
	    		{
	    			$this->produits[$produitExiste]->setQuantite($this->produits[$produitExiste]->getQuantite() + $quantite);
        			$this->produits[$produitExiste]->calculerTotal();
        		}
	    	}
    	}
    }

    public function removeProduit(Produit $produit)
    {

    	if(count($this->produits) == 0)
		{
			echo "Votre panier est vide";
		}
		else
		{
	    	$produitExiste = $this->getIndexOfProduit($produit);
	    	if($produitExiste == -1)
	    	{
	    		echo "Ce produit n'est pas dans votre panier<br/>";
	    	}
	    	else
	    	{
	    		echo "Produit retiré du panier<br/>";
	    		unset($this->produits[$produitExiste]);
	    	}
    	}

    }

    public function decreaseQuantite(Produit $produit,$quantite)
    {

    	if(count($this->produits) == 0)
		{
			echo "Votre panier est vide";
		}
		else
		{
	    	$produitExiste = $this->getIndexOfProduit($produit);
	    	if($produitExiste == -1)
	    	{
	    		echo "Ce produit n'est pas dans votre panier<br/>";
	    	}
	    	else
	    	{
	    		if(!is_int($quantite) || $quantite < 0)
	    		{
	    			echo 'Quantité non valide';
	    		}
	    		else
	    		{
	    			if($produits[$produitExiste]->getQuantite() <= $quantite)
	    			{
	    				$this->removeProduit($produit);
	    			}
	    			else
	    			{
	    				$this->produits[$produitExiste]->setQuantite($this->produits[$produitExiste]->getQuantite() - $quantite);
        				$this->produits[$produitExiste]->calculerTotal();
	    			}
	    		}
	    	}
    	}

    }

    public function getIndexOfProduit(Produit $produit)
    {
    	foreach ($this->produits as $index => $unProduit) 
    	{
    		if(($unProduit->getNom() === $produit->getNom()) && ($unProduit->getPrix() === $produit->getPrix()))
    		{
    			return $index;
    		}
    		else
    		{
    			return -1;
    		}
    	}

    }

    public function totalConverti()
    {
        $this->totalConverti = 0;

        foreach ($this->produits as $index => $produit) 
        {
			// $devise =  json_decode(file_get_contents('https://api.exchangeratesapi.io/latest?base=' . $produit->getDevise() . '&symbols='. $this->devisePanier.''), true);
			echo $url =  urlencode('https://api.exchangeratesapi.io/latest?base=' . $produit->getDevise() . '&symbols='. $this->devisePanier.'');
			$json = file_get_contents($url);
			$devise = json_decode($json, true);

			$devisepanier = $devise['rates'][$this->devisePanier];
            $tarifs = $devisepanier * $produit->getPrix();
            $this->totalConverti = $this->totalConverti + ($produit->getQuantite())*($tarifs);
        }
        return $this->totalConverti;
    }

}