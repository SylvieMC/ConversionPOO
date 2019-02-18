<?php

namespace Conversion;

class Produit
{

	private $nom;
	private $quantite;
	private $prix;
	private $total;
	private $devise;

	public function __construct($nomProduit, $quantiteProduit, $prixProduit, $deviseProduit)
	{
		$this->nom = $nomProduit;
		$this->quantite = $quantiteProduit;
		$this->prix = $prixProduit;
		$this->devise = $deviseProduit;
	}

	public function getNom() 
	{
		return $this->nom;
	}

	public function getQuantite()
	{
		return $this->quantite;
	}

	public function getPrix()
	{
		return $this->prix;
	}

	public function getDevise()
	{
		return $this->devise;
	}

	public function setNom($nouveauNom) 
	{
		$this->nom = $nouveauNom;
	}

	public function setQuantite($nouvelleQuantite)
	{
			$this->quantite = $nouvelleQuantite;
	}

	public function setPrix($nouveauPrix)
	{
			$this->prix = $nouveauPrix;
	}

	public function calculerTotal()
	{
		$this->total = ($this->getQuantite())*($this->getPrix());
		return $this->total;
	}

}