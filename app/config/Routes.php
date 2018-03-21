<?php

namespace config;

class Routes {
    public function __construct($app) {

        $app->notFound(function () use ($app) {
            $app->response->setStatusCode(404, "Not Found")->sendHeaders();
            echo 'page was not found';
        });
        
        $app->get('/api/robots', function () {
            return (new \controllers\RobotsController())->getAllRobotsAction();
        });

        $app->get('/api/robots/{id:[0-9]+}', function ($id) { 
            return (new \controllers\RobotsController())->getUserByIdAction($id);
        });

    }
}
