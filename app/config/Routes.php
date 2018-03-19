<?php

class Routes {
    public function __construct($app) {

        $app->notFound(function () use ($app) {
            $app->response->setStatusCode(404, "Not Found")->sendHeaders();
            echo 'page was not found';
        });
        
        $app->get('/api/user/{id:[0-9]+}', function ($id) { 
            return (new UserController())->getUserByIdAction($id);
        });

        $app->post('/api/user', function () {
            return (new UserController())->addUserAction();
        });
    }
}
