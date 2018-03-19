<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Di;

class UserController extends Controller {

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