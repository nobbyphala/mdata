<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';
class kecamatan extends admin_controller
{
    public $data = array('title' => 'Kecamatan');
    public function index()
    {
        $this->load->model('masterdata');
        $this->data["kabupaten"]=$this->masterdata->getKabupaten();
        $this->data["kecamatan"]=$this->getKecamatan();
        $this->load->view('kabupaten/view_kecamatan',$this->data);
    }

    public function getKecamatan()
    {
        $this->load->model('masterdata');
        return $this->masterdata->getKecamatan();
    }

    public function tambahKecamatan()
    {
        $id_kabupaten=$this->input->post("id_kabupaten");
        $kode_kecamatan=$this->input->post("kode_kecamatan");
        $nama_kecamatan=$this->input->post("nama_kecamatan");

        $this->load->model('masterdata');
        $this->masterdata->insertKecamatan($id_kabupaten,$kode_kecamatan,$nama_kecamatan);

        redirect(site_url()."/kecamatan");
    }
    
    
}