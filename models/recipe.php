<?php

require_once 'models/model_base.php';


/**
*  classe pour les recettes
*/
class recipe extends Model_Base
{
	private $_nomRecette;
	private $_autoIdRecette;
	private $_descriptif;
	private $_calories;
	private $_difficulte;
	private $_note;
	private $_nbrPersonnes;
	private $_lipides;
	private $_Glucides;
	private $_Proteines;
	private $_duree;
	private $_login;
	private $_illustration;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new Recipe($data);

		$q = self::$_db->prepare('INSERT INTO recette SET login = :l, nomRecette = :np, descriptif = :d, calories = :c, difficulte = :dif, note = :n, nbrPersonnes = :nbP, 
								lipides = :lip, Glucides = :g, Proteines = :prot, duree = :d,
								   autoIdRecette = :air, illustration = :ill');
		$q->bindValue(':l', $u->login(), PDO::PARAM_STR);
		$q->bindValue(':np', $u->nomRecette(), PDO::PARAM_STR);
		$q->bindValue(':d', $u->descriptif(), PDO::PARAM_STR);
		$q->bindValue(':c', $u->calories(), PDO::PARAM_STR);
		$q->bindValue(':dif', $u->difficulte(), PDO::PARAM_STR);
		$q->bindValue(':n', $u->note(), PDO::PARAM_STR);
		$q->bindValue(':nbP', $u->nbrPersonnes(), PDO::PARAM_STR);
		$q->bindValue(':lip', $u->lipides(), PDO::PARAM_STR);
		$q->bindValue(':g' ,$u->glucides(),PDO::PARAM_STR);
		$q->bindValue(':prot', $u->Proteines(), PDO::PARAM_STR);
		$q->bindValue(':d', $u->duree(), PDO::PARAM_STR);
		$q->bindValue(':air', $u->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':ill', $u->illustration(), PDO::PARAM_STR);			
		$q->execute();
		$u->set_autoIdRecette(self::$_db->lastInsertId());
		return $u;
	}

	public static function get_by_id($id)
	{
		$id = (int) $id;
		$q = self::$_db->prepare('SELECT * FROM recette WHERE autoIdRecette = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		if($data = $q->fetch(PDO::FETCH_ASSOC)) {
			return new recipe($data);
		} else {
			return null;
		}
	}

	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM recette ORDER BY nomRecette');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Recipe($data);
		}
		return $p;
	}

	public function sumStagesTime()
	{
		$recipeTime;
		$q = self::$_db->prepare('SELECT sum(temps) FROM etape where autoIdRecette = :air');
		$q->bindValue(':air', $this->_autoIdRecette, PDO::PARAM_INT);
		if($q->execute())
		{
			$data = $q->fetch();
			return $data[0];
		}
		
		return NULL;
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}
	public function set_autoIdRecette($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_autoIdRecette = $id;
		}
	}

	public function login()
	{
		return $this->_login;
	}
	public function set_login($l)
	{
		if(is_string($l)) {
			$this->_login = $l;
		}
	}

	public function nomRecette()
	{
		return $this->_nomRecette;
	}
	public function set_nomRecette($nomR)
	{
		if(is_string($nomR)) {
			$this->_nomRecette = $nomR;
		}
	}

	public function descriptif()
	{
		return $this->_descriptif;
	}
	public function set_descriptif($l)
	{
		if(is_string($l)) {
			$this->_descriptif = $l;
		}
	}

	public function difficulte()
	{
		return $this->_difficulte;
	}
	public function set_difficulte($l)
	{
		if(is_string($l)) {
			$this->_difficulte = $l;
		}
	}

	public function illustration()
	{
		return $this->_illustration;
	}
		
	
	public function set_illustration($l)
	{
		if(empty($this->_illustration) || is_null($this->_illustration)) 
		{
			$this->_illustration = "https://images.duckduckgo.com/iu/?u=http%3A%2F%2Fvertex-uae.com%2Fimages%2Fno-image-found.jpg&f=1";
		}
		else
		{
			if (is_string($l)) 
			{
				$this->_illustration = $l;
			}
		}
	}

	public function calories()
	{
		return $this->_calories;
	}
	public function set_calories($l)
	{
		if(is_string($l)) {
			$this->_calories = $l;
		}
	}

	public function note()
	{
		return $this->_note;
	}
	public function set_note($l)
	{
		if(is_string($l)) {
			$this->_note = $l;
		}
	}

	public function nbrPersonnes()
	{
		return $this->_nbrPersonnes;
	}
	public function set_nbrPersonnes($l)
	{
		if(is_string($l)) {
			$this->_nbrPersonnes = $l;
		}
	}

	public function lipides()
	{
		return $this->_lipides;
	}
	public function set_lipides($l)
	{
		if(is_string($l)) {
			$this->_lipides = $l;
		}
	}

	public function glucides()
	{
		return $this->_Glucides;
	}
	public function set_Glucides($l)
	{
		if(is_string($l)) {
			$this->_Glucides = $l;
		}
	}

	public function proteines()
	{
		return $this->_Glucides;
	}
	public function set_Proteines($l)
	{
		if(is_string($l)) {
			$this->_Proteines = $l;
		}
	}

	public function duree()
	{
		return $this->_duree;
	}
	public function set_duree($l)
	{
		if(is_string($l)) {
			$this->_duree = $l;
		}
	}


	// tous les ingrédients de la recette
	public function allIngredients()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM ingredient i join contient c on c.nomIngredient = i.nomIngredient where autoIdRecette = :idR');
		$q->bindValue(':idR', $this->_autoIdRecette, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Ingredient($data);
		}
		return $p;
	}

	//renvoie toutes les étapes d'une recette
	public function allEtapes()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM etape where autoIdRecette = :idR');
		$q->bindValue(':idR', $this->_autoIdRecette, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Etape($data);
		}
		return $p;
	}

	//renvoie toutes les recettes contenant le mot en argument
	public static function get_Recipe_Like($m)
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM recette where nomRecette LIKE :mot');
		$q->bindValue(':mot', '%'.$m.'%', PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new recipe($data);
		}
		return $p;
	}


	//renvoie toutes les recettes contenant les ingrédients en arguments 1 et la méthode pour trier les résultats en argument 2
	public static function get_recipes_contains($ingredients, $sort)
	{
		$p = array(); // liste de recettes
		$ingredients = array_values($ingredients)[0]; // on reçoit un tableau de tableau des ingrédients, on garde juste le tableau associative des ingrédients

		$q = self::$_db->prepare('SELECT * FROM recette where autoIdRecette IN (select autoIdRecette from contient where nomIngredient IN ("'.implode('","',$ingredients).'")) ORDER BY :sort ASC');
		$q->bindValue(':sort', $sort, PDO::PARAM_STR);
		var_dump($q);
		var_dump($sort);
		$q->execute();	
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$r = new recipe($data);
			if(!in_array($r, $p)) // on regarde si la recette n'est pas déja dans la liste
			{
				array_push($p,$r);	
			}
		}			
		return $p;
	}



	public function save()
	{
		if(!is_null($this->_autoIdRecette)) {
			$q = self::$_db->prepare('UPDATE recette SET nomRecette = :nr, descriptif = :des, difficulte = :dif, calories = :cal, nbrPersonnes = :nbrP, Lipides = :l, Glucides = :g, Proteines = :prot, Duree = :d, login = :log , illustration =: ill, note = :n WHERE autoIdRecette = :id');
			$q->bindValue(':nr', $this->_nomRecette, PDO::PARAM_STR);
			$q->bindValue(':des', $this->_descriptif, PDO::PARAM_INT);
			$q->bindValue(':dif', $this->_difficulte, PDO::PARAM_STR);
			$q->bindValue(':cal', $this->_calories, PDO::PARAM_STR);
			$q->bindValue(':nbrP', $this->_nbrPersonnes, PDO::PARAM_INT);
			$q->bindValue(':l', $this->_lipides, PDO::PARAM_STR);
			$q->bindValue(':g', $this->_Glucides, PDO::PARAM_STR);
			$q->bindValue(':prot', $this->_Proteines, PDO::PARAM_INT);
			$q->bindValue(':d', $this->_duree, PDO::PARAM_STR);
			$q->bindValue(':log', $this->_login, PDO::PARAM_INT);
			$q->bindValue(':ill', $this->_illustration, PDO::PARAM_INT);
			$q->bindValue(':n', $this->_note, PDO::PARAM_INT);
			$q->bindValue(':id', $this->_autoIdRecette, PDO::PARAM_STR);
					
			$q->execute();
		}
	}




	public function delete()
	{
		if(!is_null($this->_autoIdRecette)) {
			$q = self::$_db->prepare('DELETE FROM recette WHERE autoIdRecette = :id');
			$q->bindValue(':id', $this->_autoIdRecette);
			$q->execute();
			$this->_autoIdRecette = null;
		}
	}
}
