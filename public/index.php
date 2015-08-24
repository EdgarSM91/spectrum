<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors',true);
error_reporting(E_ALL);
$di = new \Phalcon\DI\FactoryDefault();

$di->set('url', function(){
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri("http://".$_SERVER["SERVER_NAME"]."/");
    return $url;
});

$di->set('router', function(){

    $router = new \Phalcon\Mvc\Router();
    $router->setDefaultModule("frontend");

    $router->add("/", array(
        'module'=>'frontend',
        'controller' => 'index',
        'action' => 'index',
    ));

/*Secciones*/
    $router->add('/([0-9-a-zA-Z\-]+)', array(
        'module'=>'frontend',
        'controller'=>'index',
        'action'=>'1'
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
    });
    $router->add('/contact/([0-9-a-zA-Z\-]+)', array(
        'module'=>'frontend',
        'controller'=>'contact',
        'action'=>'1'
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
    });
    $router->add("/get/token", array(
        'module'=>'frontend',
        'controller' => 'contact',
        'action' => 'token',
    ));
    $router->add("/contactanos", array(
        'module'=>'frontend',
        'controller' => 'index',
        'action' => 'contact',
    ));
    $router->add("/index/sendmessagecontact", array(
        'module'=>'frontend',
        'controller' => 'index',
        'action' => 'sendmessagecontact',
    ));
    $router->add("/digital/abril", array(
        'module'=>'frontend',
        'controller' => 'index',
        'action' => 'digital',
    ));
    $router->add('/entretenimiento/memes', array(
        'module'=>'frontend',
        'category' => "entretenimiento",
        'subcategory' => "memes",
        'controller'=>'gallery',
        'action'=>'index'
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
        });
    $router->add('/entretenimiento/memes/([0-9-a-zA-Z\-]+)', array(
        'module'=>'frontend',
        'permalink'=>1,
        'controller'=>'gallery',
        'category' => "entretenimiento",
        'subcategory' => "memes",
        'action'=>'post'
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
        });
/*Secciones*/
    /*$router->notFound(array(
        'module' => 'frontend',
        'controller' => 'index',
        'action' => 'show404'
    ));
    $router->removeExtraSlashes(true);*/

 /* Dashboard */
    $router->add("/dashboard", array(
        'module'=>'dashboard',
        'controller' => 'index',
        'action' => 'index',
    ));
    $router->add("/login", array(
        'module'=>'dashboard',
        'controller' => 'login',
        'action' => 'index',
    ));
    $router->add("/logout",array(
        'module'=>'dashboard',
        'controller' => 'login',
        'action' => 'logout',
    ));
    $router->add('/dashboard/([a-zA-Z\-]+)/([a-zA-Z\-]+)', array(
        'module'=>'dashboard',
        'controller' => 1,
        'action' => 2,
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
        });
    $router->add('/dashboard/([a-zA-Z\-]+)/([a-zA-Z\-]+)/([0-9]+)', array(
        'module'=>'dashboard',
        'controller' => 1,
        'action' => 2,
        'id' => 3,
    ))->setName("controllers")->convert('action', function($action) {
            return \Phalcon\Text::lower(\Phalcon\Text::camelize($action));
    });
    $router->add("/dashboard/courses",array(
        'module'=>'dashboard',
        'controller' => 'course',
        'action' => 'index',
    ));
    $router->add("/dashboard/courses/inactive",array(
        'module'=>'dashboard',
        'controller' => 'course',
        'action' => 'inactive',
    ));
    $router->add("/dashboard/users",array(
        'module'=>'dashboard',
        'controller' => 'user',
        'action' => 'index',
    ));
    $router->add("/dashboard/user/edit/profile",array(
        'module'=>'dashboard',
        'controller' => 'user',
        'action' => 'profile',
    ));
    $router->add("/dashboard/category",array(
        'module'=>'dashboard',
        'controller' => 'category',
        'action' => 'index',
    ));
    $router->add("/dashboard/instructors",array(
        'module'=>'dashboard',
        'controller' => 'instructor',
        'action' => 'index',
    ));
    $router->add("/dashboard/instructors/inactive",array(
        'module'=>'dashboard',
        'controller' => 'instructors',
        'action' => 'inactive',
    ));
    return $router;
});
/**
 * Start the session the first time some component request the session service
 */
$di->set('dispatcher', function() use ($di){
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $eventsManager = $di->getShared('eventsManager');
    $security = new Security($di);
    $security->setWorkFactor(50);
    $eventsManager->attach('dispatch', $security);
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

$di->set('session', function () {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();

    return $session;
});
$di->set('collectionManager', function(){
    return new Phalcon\Mvc\Collection\Manager();
}, true);

$application = new \Phalcon\Mvc\Application();

//Pass the DI to the application
$application->setDI($di);

//Register the installed modules
$application->registerModules(array(
            'frontend' => array(
                'className' => 'Modules\Frontend\Module',
                'path' =>'../apps/modules/frontend/Module.php'
            ),
            'dashboard' => array(
                'className' => 'Modules\Dashboard\Module',
                'path' =>'../apps/modules/dashboard/Module.php'
            )
        ));
echo $application->handle()->getContent();