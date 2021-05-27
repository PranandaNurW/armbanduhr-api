<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('Jamtangan_model', 'jamtangan');
    }
	
	public function me_post()
	{
        // $theCredential = $this->user_data;
        // $this->response($theCredential, 200);
        $init = gmdate("Y-m-d H:i:s", $this->user_data->token_initial_time+(60*60*7));
        $exp = gmdate("Y-m-d H:i:s", $this->user_data->token_expired_time+(60*60*7));
        $this->response([
            'status' => TRUE,
            'user_id' => $this->user_data->user_id,
            'username' => $this->user_data->username,
            'level' => $this->user_data->level,
            'token_initial_time' => $init,
            'token_expired_time' => $exp
        ], REST_Controller::HTTP_OK);     
	}

    public function jamtangan_get() 
    {
        $item_id = $this->get('item_id');

        if($item_id === null) {
            $jamtangan = $this->jamtangan->getJamtangan();
        } else {
            $jamtangan = $this->jamtangan->getJamtangan($item_id);            
        }

        if($jamtangan) {
            $this->response([
                'status' => TRUE,
                'data' => $jamtangan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'item id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function jamtangan_post()
    {
        if($this->user_data->level == 1 || $this->user_data->level == 2) {
            $data = [
                'item_brand' => $this->post('item_brand'),
                'item_name' => $this->post('item_name'),
                'item_price' => $this->post('item_price'),
                'item_type' => $this->post('item_type')
            ];

            if($this->jamtangan->createJamtangan($data) > 0){
                $this->response([
                    'status' => TRUE,
                    'message' => 'item created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'failed to create an item'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'action prohibited'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
    }

    public function jamtangan_put()
    {
        if($this->user_data->level == 1 || $this->user_data->level == 2) {
            $item_id = $this->put('item_id');
            $data = [
                'item_brand' => $this->put('item_brand'),
                'item_name' => $this->put('item_name'),
                'item_price' => $this->put('item_price'),
                'item_type' => $this->put('item_type')
            ];

            if($this->jamtangan->updateJamtangan($data , $item_id) > 0){
                $message = [
                    'status' => TRUE,
                    'item_id' => $item_id,
                    'message' => 'item updated'
                ];
        
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'failed to update an item'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'action prohibited'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
    }

    public function jamtangan_delete() 
    { 
        if($this->user_data->level == 1) {
            $item_id = $this->delete('item_id');
    
            if($item_id === null) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'provide an item id'
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                if($this->jamtangan->deleteJamtangan($item_id) > 0) {
                    // item terhapus
                    $message = [
                        'status' => TRUE,
                        'item_id' => $item_id,
                        'message' => 'item deleted'
                    ];
            
                    $this->set_response($message, REST_Controller::HTTP_OK);
                } else {
                    // gagal
                    $this->response([
                        'status' => FALSE,
                        'message' => 'item id not found'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'action prohibited'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
    }


}
