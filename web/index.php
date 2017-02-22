<?php 

	require_once __DIR__.'/../vendor/autoload.php';

	use Silex\Application;

	const DB_HOST = 'localhost';
	const DB_DATABASE = 'labyrintheSilex';
	const USER = 'root';
	const PASSWORD = '';

	$app = new Application();

	$app->register(new Silex\Provider\SessionServiceProvider());

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	    'twig.path' => __DIR__.'/../views',
	));

	$app['debug'] = true;

	$app['database.config'] = [
	        'dsn'      => 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE,
	        'username' => USER,
	        'password' => PASSWORD,
	        'options'  => [
	                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // flux en utf8
	                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // mysql erreurs remontées sous forme d'exception
	                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // tous les fetch en objets
	        ]
	  
	];

	$app['pdo'] = function( $app ){
		$options = $app['database.config'];

		return new \PDO($options['dsn'],$options['username'],$options['password'],$options['options']);
	};


	$app->get('/', function() use($app) {
	    return $app['twig']->render('front/home.twig');
	});

	$app->run();