<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';
class kabupaten extends admin_controller
{
    public $data = array('title' => 'Kabupaten');

    public function index()
    {
        $this->data["kabupaten"]=$this->getKabupaten();
        $this->load->view('kabupaten/view_kabupaten',$this->data);
    }

    public function getKabupaten()
    {
        $this->load->model('masterdata');
        return $this->masterdata->getKabupaten();
    }

    public function tambahKabupaten()
    {
        $kode_kabupaten=$this->input->post("kode_kabupaten");
        $nama_kabupaten=$this->input->post("nama_kabupaten");

        $this->load->model('masterdata');
        $this->masterdata->insertKabupaten($kode_kabupaten,$nama_kabupaten);

        redirect(site_url()."/kabupaten");
    }
}