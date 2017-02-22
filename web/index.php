<?php 

	require_once __DIR__.'/../vendor/autoload.php';

	$app = new Silex\Application();

	$app->register(new Silex\Provider\SessionServiceProvider());

	$app->get('/hello/{name}', function($name) use($app) {
	    return 'Hello '.$app->escape($name);
	});

	$app->run();