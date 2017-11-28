<?php

require_once 'models/model_base.php';

/**
* 
*/
class Contient extends Model_Base
{
	private $_quantite;
	private $_grammes;
	private $_autoIdRecette;
	private $_nomIngredient;
	
	function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$c = new Contient($data);
		$q = self::$_db->prepare('INSERT INTO contient SET quantite = :q, grammes = :g, autoIdRecette = :air, nomIngredient = :ni');
		$q->bindValue(':q', $c->quantite(), PDO::PARAM_STR);
		$q->bindValue(':g', $c->grammes(), PDO::PARAM_STR);
		$q->bindValue(':air', $c->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':ni', $c->nomIngredient(), PDO::PARAM_STR);
		$q->execute();
		
		return $c;
	}

	//mets à jour les informations de la recette
	public function updateRecette()
	{
		//on récupère l'ingrédient
		$ingredient = Ingredient::get_by_nomIngredient($this->_nomIngredient);

		//on récupère la recette
		$recipe = recipe::get_by_id($this->_autoIdRecette);
		

		$q = self::$_db->prepare('UPDATE recette set calories = :cal, Lipides = :lip, Glucides = :gl, Proteines = :prot WHERE autoIdRecette = :air');

		//on regarde quel unité est utilisé pour exprimer les quantité de l'ingrédient

		//ici les grammes
		if(is_null($this->_quantite) && !is_null($this->_grammes) )
		{
			$q->bindValue(':cal',$recipe->calories()+(($ingredient->calories()*$this->_grammes)/100), PDO::PARAM_STR);
			$q->bindValue(':lip', $recipe->Lipides()+(($ingredient->Lipides()*$this->_grammes)/100), PDO::PARAM_STR);
			$q->bindValue(':gl', $recipe->Glucides()+(($ingredient->Glucides()*$this->_grammes)/100), PDO::PARAM_STR);
			$q->bindValue(':prot', $recipe->Proteines()+(($ingredient->Proteines()*$this->_grammes)/100), PDO::PARAM_STR);
			$q->bindValue(':air', $this->_autoIdRecette, PDO::PARAM_STR);
			$q->execute();
		}
		else if( !is_null($this->_quantite) && is_null($this->_grammes) )
		{
			$q->bindValue(':cal', $recipe->calories()+(($ingredient->calories()*$this->_quantite)), PDO::PARAM_STR);
			$q->bindValue(':lip', $recipe->Lipides()+(($ingredient->Lipides()*$this->_quantite)), PDO::PARAM_STR);
			$q->bindValue(':gl', $recipe->Glucides()+(($ingredient->Glucides()*$this->_quantite)), PDO::PARAM_STR);
			$q->bindValue(':prot', $recipe->Proteines()+(($ingredient->Proteines()*$this->_quantite)), PDO::PARAM_STR);
			$q->bindValue(':air', $this->_autoIdRecette, PDO::PARAM_STR);
			$q->execute();
		}

	}

	public static function get_Ingredients_Recipe($idRecipe)
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM contient where autoIdRecette = :air');
		$q->bindValue(':air', $idRecipe, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] = new Contient($data);
		}
		return $p;
	}
	
	public function quantite()
	{
		return $this->_quantite;
	}

	public function set_quantite($p)
	{
		if(is_numeric($p))
		{
			$this->_quantite = $p;	
		}
		else if($p == "")
		{
			$this->_quantite = null;
		}
	}

	public function grammes()
	{
		return $this->_grammes;
	}

	public function set_grammes($p)
	{
		if(is_numeric($p))
		{
			$this->_grammes = $p;	
		}
		else if($p == "")
		{
			$this->_grammes = null;
		}
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}

	public function set_autoIdRecette($p)
	{
		if(is_numeric($p))
		{
			$this->_autoIdRecette = $p;	
		}
	}

	public function nomIngredient()
	{
		return $this->_nomIngredient;
	}

	public function set_nomIngredient($p)
	{
		if(is_string($p))
		{
			$this->_nomIngredient = $p;	
		}
	}

	public function delete()
	{
		if(!is_null($this->_autoIdRecette) && !is_null($this->nomIngredient)) 
		{
			$q = self::$_db->prepare('DELETE FROM contient WHERE autoIdRecette = :air AND nomIngredient = :ni');
			$q->bindValue(':air', $this->_autoIdRecette);
			$q->bindValue(':ni', $this->_nomIngredient);
			$q->execute();
			$this->_login = null;
		}
	}	
}