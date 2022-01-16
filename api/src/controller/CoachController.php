<?php

namespace App\controller;

use App\model\CoachModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class CoachController extends MainController
{
    private $coachModel;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->coachModel = new CoachModel($container);
    }

    public function getCoach(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
      
        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        
        $users = $this->coachModel->getCoaches();  
        
        if($users){
            
            unset($user['password']);

            $resource = [
                "data" => $users
            ];  

            return $this->response(StatusCode::HTTP_OK, $resource);
        }
            
         
        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function getCoachDetail(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            $user = $this->coachModel->getCoachInfos($id);  
            
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

    public function addCoach(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $params = $request->getParsedBody();
        
        foreach($params as $key => $value){
            $params[$key] = htmlspecialchars($value);
        }

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if(!empty($params)){

            $userId = $this->coachModel->addCoach($params);  
            
            if($userId){

                $resource = [
                    "message" => 'The coach successfully added.'
                ];

                return $this->response(StatusCode::HTTP_OK, $resource);

            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function updateCoach(ServerRequestInterface $request, ResponseInterface $response, $args)
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

                $result = $this->coachModel->updateCoach($params);  
                
                if($result){

                    $resource = [
                        "message" => 'The coach successfully updated.'
                    ];

                    return $this->response(StatusCode::HTTP_OK, $resource);

                }
            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function deleteCoach(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            
            $result = $this->coachModel->deleteCoach($id);  
            
            if($result){

                $resource = [
                    "message" => 'The coach successfully deleted.'
                ];

                return $this->response(StatusCode::HTTP_OK, $resource);

            }
            
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

}