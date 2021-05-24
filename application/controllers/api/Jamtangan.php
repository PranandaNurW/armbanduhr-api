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
}