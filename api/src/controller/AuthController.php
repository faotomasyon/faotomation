<?php

namespace App\controller;

use App\model\AuthModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class AuthController extends MainController
{
    private $authModel;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->authModel = new AuthModel($container);
    }

    public function login(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $params = $request->getParsedBody();
        $user = $this->authModel->getUser($params['email']);

        $resource = [
            "message" => "Failed! Could not login. Please make sure you have entered the correct values!"
        ];

        if ($user) {
            
            $password = hash('sha512', $params['password']);
            
            if($password == $user['password']){

                if(isset($_SESSION['user']['token']) && !empty($_SESSION['user']['token'])){

                    $resource = [
                        'token' => $_SESSION['user']['token'],
                    ];

                } else {
    
                    $tokenGeneric = time() . 'testSecretKey' . $_SERVER["SERVER_NAME"];
                    $token = hash('sha256', $tokenGeneric. $user['email']);
                    $_SESSION['user']['token'] = $token;
    
                    $resource = [
                        'token' => $token
                    ];
                }
                
            }

            return $this->response(StatusCode::HTTP_OK, $resource);
        }
        
        return $this->response(StatusCode::HTTP_UNAUTHORIZED, $resource);
    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $params = $request->getParsedBody();

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"]);
            session_destroy();
        }

        $resource = [
            "message" => "Logout successfully,"
        ];
        
        return $this->response(StatusCode::HTTP_OK, $resource);
        
    }

}