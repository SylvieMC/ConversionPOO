<?php

namespace Conversion;

class Panier
{

	private $produits;
	private $totalConverti;
	private $devisePanier;

	public function __construct($devisePanier)
	{
		$this->devisePanier = $devisePanier;
	}

	public function getProduits()
    {
        return $this->produits;
	}
	public function getDevisePanier()
    {
        return $this->devisePanier;
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

    public function supprimerProduit(Produit $produit)
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

    public function diminuerQuantite(Produit $produit,$quantite)
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
	    				$this->supprimerProduit($produit);
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
            if ($produit->getDevise() != $this->devisePanier)
            {
                $devise =  json_decode(file_get_contents('https://api.exchangeratesapi.io/latest?base=' . $produit->getDevise() . '&symbols='. $this->devisePanier.''), true);
                $devisepanier = $devise['rates'][$this->devisePanier];
                $tarifs = $devisepanier * $produit->getPrix();
                $this->totalConverti = $this->totalConverti + ($produit->getQuantite())*($tarifs);
            }
            else {
                $this->totalConverti = $this->totalConverti + ($produit->getQuantite())*($produit->getPrix());
            }
        }
        return $this->totalConverti;
    }


}