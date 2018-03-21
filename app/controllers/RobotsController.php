<?php

namespace controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Di;

class RobotsController extends Controller {

    /**
     * Return all robots
     */
    public function getAllRobotsAction() {
        $sql = 'SELECT * FROM Droids\Mechanoids\Robots ORDER by name';
        $robots = $this->app->modelsManager->executeQuery($sql);
        $data = [];

        foreach ($robots as $robot) {
            $data[] = [
                'id' => $robot->id,
                'name' => $robot->name,
            ];
        }

        echo json_encode($data);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getUserByIdAction(int $id): Response {
            $users = [
                'id' => $id,
                'first_name' => 'Gordon',
                'last_name' => 'Test',
                'state' => 'QLD'
            ];
        
            $response = new Response();
            $response->setStatusCode(200, 'Ok');
            $response->setJsonContent($users);
            return $response;
    }

    public function addUserAction(): Response {
        $data = ($this->getDI())->get('app')->request->getJsonRawBody();
        $response = new Response();
        $response->setStatusCode(201, 'Created');
        $response->setJsonContent($data);
        return $response;
    }
}