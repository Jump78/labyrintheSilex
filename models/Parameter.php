<?php 
	namespace Models;

	use Silex\Application as App;

	/**
	* 
	*/
	class Parameters
	{

		private $app;

		public function __construct( App $app ){
			$this->app = $app;
		}

		public function index(){
			$prepare = $this->app['pdo']->prepare('SELECT * from parameter');

		  	$prepare->execute();
		  
		    $data = $prepare->fetchAll();
		    
		    return $data;
		}

		public function delete($id){

		}

		public function create($data){
			$prepare = $this->app['pdo']->prepare('INSERT INTO parameter VALUES ( ?,?,?)');

			$prepare -> bindValue(1,$data['width'],\PDO::PARAM_INT);
			$prepare -> bindValue(2,$data['height'],\PDO::PARAM_INT);
			$prepare -> bindValue(3,$data['color'],\PDO::PARAM_INT);

			$prepare -> execute();

			return true;
		}

		public function update($data,$id){

		}
	}