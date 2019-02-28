<?php

namespace Conversion;

interface IPanier{
    public function getProduits();
    public function getDevisePanier();
    public function addProduit(Produit $produit);
    public function increaseQuantite(Produit $produit,$quantite);
    public function supprimerProduit(Produit $produit);
    public function diminuerQuantite(Produit $produit,$quantite);
    public function totalConverti();
}
