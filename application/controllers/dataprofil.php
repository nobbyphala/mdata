<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';

class dataprofil extends admin_controller {
    public $data = array('title' => 'Profil Kabupaten');
    public function index()
    {
        
    }
    
    public function profilkabupaten($id='50400')
    {
            $this->load->model('dataprofilmodel');
            $data["list_kabupaten"]=$this->dataprofilmodel->getKabupaten();
            $data["profil_kabupaten"]=$this->dataprofilmodel->getProfilKabupaten($id);
            $data["id_kabupaten"]=$id;
            $data["title"]="Profil Kabupaten";
           $this->load->view('dataprofil/profil_kabupaten',$data);
    }

    public function profilgeografis($id='50400')
    {
        $this->load->model('dataprofilmodel');
        $data["list_kabupaten"]=$this->dataprofilmodel->getKabupaten();
        $data["profil_kabupaten"]=$this->dataprofilmodel->getProfilGeografis($id);
        $data["id_kabupaten"]=$id;
        $data["title"]="Profil Geografis";
        $this->load->view('dataprofil/profil_geografis',$data);
    }

    public function simpanprofil($jenis_profil)
    {
        $this->load->model('dataprofilmodel');

        if($this->input->post('submit')) {
            if ($jenis_profil == "kabupaten") {
                $this->dataprofilmodel->updateProfilKabupaten();
            } else
                if ($jenis_profil == "geografis") {
                    $this->dataprofilmodel->updateProfilGeografis();
                }
        }

        redirect('/dataprofil/profilkabupaten/'.$this->input->post('kabupaten'));
    }

    public function test()
    {
        $this->load->view('dataprofil/test');
    }
}