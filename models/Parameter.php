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
		  
		    $data = $prepare->fetch();
		    
		    return $data;
		}

		public function delete($id){
			$prepare = $this->app['pdo']->prepare('DELETE FROM parameter WHERE id = (?)');

			$prepare -> bindValue(1,$id,\PDO::PARAM_INT);

			$prepare -> execute();

			return true;
		}

		public function delete_all(){
			$prepare = $this->app['pdo']->prepare('DELETE FROM parameter');

			$prepare -> execute();

			return true;
		}

		public function create($data){

			$this->delete_all();

			$prepare = $this->app['pdo']->prepare('INSERT INTO parameter (width,height,color) VALUES ( ?,?,?)');

			$prepare -> bindValue(1,$data->width,\PDO::PARAM_INT);
			$prepare -> bindValue(2,$data->height,\PDO::PARAM_INT);
			$prepare -> bindValue(3,$data->color,\PDO::PARAM_INT);

			$prepare -> execute();

			return true;
		}
	}