<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';

class crudtest extends admin_controller
{
    public $data = array('title' => 'Profil Kabupaten');

    public function index()
    {
        $this->load->library("grocery_CRUD");
        $crud = new grocery_CRUD();
        $crud->set_table('panen');
        $output = $crud->render();

        print_r ($output);

    }
}