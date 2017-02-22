<?php 

namespace Controllers;

use Silex\Application as App;
use \Models\Parameters as Parameters;
use Symfony\Component\HttpFoundation\Request;


class FrontController {

	public function __construct( App $app ){
		$this->app = $app;

		$this->parameter = new Parameters($this->app);
	}

	public function index(){

		$data = $this->parameter->index();

		return $this->app['twig']->render('front/home.twig',['data'=>$data]);
	}

	public function delete(){

	}

	public function create( Request $request){

		// parameters de configuration 
		

		$data = [
			'width' => $request->get('width'),
			'height' => $request->get('height'),
			'color' => $request->get('color')
		];

		// enregistre en base de données ou en session 
		
		$this->parameter->create($data);

		// redirection vers la page d'accueil et on affiche le labyrinthe

		return $this->app->redirect('/');
	}

	public function update(){

	}
}

