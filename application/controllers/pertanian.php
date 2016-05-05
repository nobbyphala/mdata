<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once APPPATH . '/libraries/admin_controller.php';

class pertanian extends admin_controller
{
    public $data = array('title' => 'Pertanian');
    public function index()
    {
        $this->load->view('panen/view_panen',$this->data);
    }

    public function datapanenjagung($id_kabupaten=0, $id_kecamatan=0)
    {
        $this->load->model("masterdata");
        $kabupaten=$this->masterdata->getKabupaten();
        $kecamatan=$this->masterdata->getKecamatanFromIdKabupaten($id_kabupaten);
        
        if($id_kabupaten==0 && $id_kecamatan==0)
        {
            
        }
    }

    public function getDataPanenDemo($id_tanaman="jagung")
    {
        $id_tanaman=rawurldecode($id_tanaman);
        $this->load->model("mpertanian");
        $this->load->model("masterdata");
        $this->data["kabupaten"]=$this->masterdata->getKabupaten();
        $this->data["chart_data"]=$this->db->query("SELECT kc.nama_kecamatan, sum(p.produktivitas) as total FROM panen p, kecamatan kc WHERE kc.id_kecamatan=p.id_kecamatan and p.jenis_tanaman='$id_tanaman' GROUP BY kc.id_kecamatan;");
        $this->data["jenis_tanaman"]=$id_tanaman;
        $this->load->library("grocery_CRUD");
        $crud = new grocery_CRUD();
        $crud->set_table('panen');
        $output = $crud->render();
        foreach ($output as $key=>$value)
        {
            $this->data[$key]=$value;
        }
        $this->load->view("panen/view_panen_jagung",$this->data);

    }

    public function getAjaxPanen($kabupaten,$kecamatan,$jenis_tanaman)
    {
        //$kabupaten=$this->input->post("kabupaten");
        //$kecamatan=$this->input->post("kecamatan");
        //$jenis_tanaman=$this->input->post("jenis_tanaman");
        $this->load->model("mpertanian");
        $data=$this->mpertanian->getPanenDataChart($jenis_tanaman,$kabupaten,$kecamatan);
        $row=$data->result_array();
        if($data->num_rows()>0)
        {
            print json_encode($row);
        }
        else
            print 0;

    }

    public function getDataCoba($id_tanaman, $id_kabupaten, $id_kecamatan)
    {

        $this->load->model("mpertanian");
        $query=$this->mpertanian->getPanenData($id_tanaman,$id_kabupaten,$id_kecamatan);
        $data["res"]=$query;
        $this->load->view('panen/view_ajax',$data);
    }

    public function insertDataPanenFromExcel()
    {
        $this->load->model("excelmodel");
        $this->load->model("mpertanian");
        $jenis_tanaman=$this->input->post('tanaman');
        $filepath=$this->input->post('filepath');
        $checked_value=$this->input->post('row');
        $arr_data=$this->excelmodel->getExcelData($filepath);
        $this->mpertanian->insertPanenFromExcel($arr_data["arr_data"],$checked_value,$jenis_tanaman);
    }

    public function getAjaxKecamatan($id_kabupaten)
    {
        $this->load->model("masterdata");
        $query=$this->masterdata->getKecamatanFromIdKabupaten($id_kabupaten);

        $data["kecamatan"]=$query;
        $this->load->view('view_ajax_kecamatan',$data);
    }
}