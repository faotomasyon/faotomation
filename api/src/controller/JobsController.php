<?php

namespace App\controller;

use App\model\JobsModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class JobsController extends MainController
{
    private $jobsModel;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->jobsModel = new JobsModel($container);
    }

    public function getJobs(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
      
        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        
        $jobs = $this->jobsModel->getJobs();  
        
        if($jobs){

            $resource = [
                "data" => $jobs
            ];  

            return $this->response(StatusCode::HTTP_OK, $resource);
        }
            
         
        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function getJobById(ServerRequestInterface $request, ResponseInterface $response, $args)
    {      
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        
        $jobs = $this->jobsModel->getJobById($id);  
        
        if($jobs){

            $resource = [
                "data" => $jobs
            ];  

            return $this->response(StatusCode::HTTP_OK, $resource);
        }
            
         
        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function addJob(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $params = $request->getParsedBody();
        
        foreach($params as $key => $value){
            $params[$key] = htmlspecialchars($value);
        }

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if(!empty($params)){

            $userId = $this->jobsModel->addJob($params);  
            
            if($userId){

                $resource = [
                    "message" => 'The coach successfully added.'
                ];

                return $this->response(StatusCode::HTTP_OK, $resource);

            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function updateJob(ServerRequestInterface $request, ResponseInterface $response, $args)
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

                $result = $this->jobsModel->updateJob($params);  
                
                if($result){

                    $resource = [
                        "message" => 'The job successfully updated.'
                    ];

                    return $this->response(StatusCode::HTTP_OK, $resource);

                }
            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function updateJobStatus(ServerRequestInterface $request, ResponseInterface $response, $args)
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

                $result = $this->jobsModel->updateJobStatus($params['id'], $params['status']);  
                
                if($result){

                    $resource = [
                        "message" => 'The job successfully updated.'
                    ];

                    return $this->response(StatusCode::HTTP_OK, $resource);

                }
            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function updateJobValue(ServerRequestInterface $request, ResponseInterface $response, $args)
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

                $result = $this->jobsModel->updateJobValue($params['id'], $params['value']);  
                
                if($result){

                    $resource = [
                        "message" => 'The job successfully updated.'
                    ];

                    return $this->response(StatusCode::HTTP_OK, $resource);

                }
            }
        }

        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);

    }

    public function deleteJob(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $id = isset($args['id']) && is_numeric($args['id']) ? $args['id'] : null;

        $resource = [
            "message" => "Failed! Please make sure you have entered the correct values!"
        ];

        if($id){
            
            $result = $this->jobsModel->deleteJob($id);  
            
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