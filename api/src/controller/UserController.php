<?php

namespace App\controller;

use App\model\UserModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class UserController extends MainController
{
    private $userModel;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->userModel = new UserModel($container);
    }

    public function getUsers(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
      
        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        
        $users = $this->userModel->getUsers();  
        
        if($users){
            
            unset($user['password']);

            $resource = [
                "data" => $users
            ];  

            return $this->response(StatusCode::HTTP_OK, $resource);
        }
            
         
        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function getUserDetail(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            $user = $this->userModel->getUserInfos($id);  
            
            if($user){
                
                unset($user['password']);

                $resource = [
                    "data" => $user
                ];  
            }
            
            return $this->response(StatusCode::HTTP_OK, $resource);
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function addUser(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $params = $request->getParsedBody();
        
        foreach($params as $key => $value){
            $params[$key] = htmlspecialchars($value);
        }

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if(!empty($params)){

            $userId = $this->userModel->addUser($params);  
            
            if($userId){

                $resource = [
                    "message" => 'The user successfully added.'
                ];

                return $this->response(StatusCode::HTTP_OK, $resource);

            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function updateUser(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            
            $params = $request->getParsedBody();
            $params['id'] = $id;

            foreach($params as $key => $value){
                $params[$key] = htmlspecialchars($value);
            }

            if(!empty($params)){

                $result = $this->userModel->updateUser($params);  
                
                if($result){

                    $resource = [
                        "message" => 'The user successfully updated.'
                    ];

                    return $this->response(StatusCode::HTTP_OK, $resource);

                }
            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function deleteUser(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            
            $result = $this->userModel->deleteUser($id);  
            
            if($result){

                $resource = [
                    "message" => 'The user successfully deleted.'
                ];

                return $this->response(StatusCode::HTTP_OK, $resource);

            }
            
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

}