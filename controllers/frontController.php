<?php 

namespace Controllers;

use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;
use \Models\Parameters as Parameters;
use \Models\Labyrinthe;
use \Models\Constraints as Constraints;

class FrontController {

	public function __construct( App $app ){
		$this->app = $app;

		$this->parameter = new Parameters($this->app);
	}

	public function index(){

		return $this->app['twig']->render('front/home.twig');
	}

	public function delete($id){
		$this->parameter->delete($id);

		return $this->app->redirect('/');
	}

	public function create( Request $request){

		// parameters de configuration 
		$data =[
			'width' => $request->get('width'),
			'height' => $request->get('height'),
			'color' => $request->get('color')
		];
		
		$constraints = new Constraints;

		$errors = $this->app['validator']->validate($data,$constraints->get_constraint());	

		if (count($errors) > 0) {
			$this->app['session']->getFlashBag()->add('errors', $errors);
			return $this->app->redirect('/')
		;}

		// enregistre en base de données ou en session 
		
		$data = (object) $data;

		$this->parameter->create($data);

		// redirection vers la page d'accueil et on affiche le labyrinthe

		$labyrinthe = new Labyrinthe;

		$map = $labyrinthe->create($data->width,$data->height,$data->color);


		return $this->app['twig']->render('front/home.twig',['map'=>$map,'data'=>$data]);
	}
}

