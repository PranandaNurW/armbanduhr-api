<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    // private $init, $exp, $usr, $pwd;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('User_model');
    }

    public function registration_post()
    {
        $u = $this->post('username');
        $p = $this->post('password');

        $data = [
            'username' => $u,
            'password' => sha1($p),
            'level' => '3'
        ];

        if ($u == null && $p == null) {
            $this->response([
                'status' => FALSE,
                'message' => 'fill the username & password!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->User_model->createUser($data) > 0){
                $this->response([
                    'status' => TRUE,
                    'message' => 'registration success'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'registration failed'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function login_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = sha1($this->post('password')); //Pasword Posted
        $q = array('username' => $u); //For where query condition
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid

        $val = $this->User_model->get_user($q)->row(); //Model to get single data row from database base on username

        if($this->User_model->get_user($q)->num_rows() == 0){$this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);}

		$match = $val->password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
        	$token['user_id'] = $val->user_id;  //From here
            $token['username'] = $u;
            $token['level'] = $val->level;

            $date = new DateTime();
            $token['token_initial_time'] = $date->getTimestamp();
            $token['token_expired_time'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            
            $output['token'] = JWT::encode($token,$kunci ); //This is the output token
            // $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success

            $exp = gmdate("Y-m-d H:i:s", $token['token_expired_time']+ (60*60*7));
            $this->response([
                'status' => TRUE,
                'token' => $output['token'],
                'message' => 'token will be expired in 5 hours',
                'expired' => $exp
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }

}
