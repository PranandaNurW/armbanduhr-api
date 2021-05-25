<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jamtangan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jamtangan_model', 'jamtangan');
    }

    public function index_get() 
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

    public function index_delete() 
    {
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
        
                $this->set_response($message, REST_Controller::HTTP_NO_CONTENT);
            } else {
                // gagal
                $this->response([
                    'status' => FALSE,
                    'message' => 'item id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'item_brand' => $this->post('item_brand'),
            'item_name' => $this->post('item_name'),
            'item_price' => $this->post('item_price'),
            'item_type' => $this->post('item_type'),
            'item_image' => $this->post('item_image')
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
    }
}