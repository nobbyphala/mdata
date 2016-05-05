<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author mozar
 */
require_once APPPATH . '/libraries/admin_controller.php';

class lokasi extends admin_controller {

    public $data = array('title' => 'Penduduk');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model'));
    }

    public function index() {
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ")->result_array();
        $this->load->view('home/view_penduduk_lokasi', $this->data);
    }

    public function detail(){
        $id=(int)$this->input->get('id_penduduk');
        $this->data['penduduk']=$this->penduduk_model->get_penduduk($id);
        $this->load->view('home/view_penduduk_detail',$this->data);
    }

    function hapus(){
        $id=(int)$this->input->post('id');
        if($this->db->query("delete from penduduk where PENDUDUK_ID=?",array($id))==1){
            echo 'ok';
        }else{
            echo 'Gagal menghapus data penduduk';
        }
    }

    function get_list_penduduk_datatable() {
        echo json_encode($this->penduduk_model->get_list_penduduk_datatable($_POST));
    }

    function get_chart_column(){
        $id_provinsi=(int)$this->input->get('id_provinsi');
        $id_kabupaten=(int)$this->input->get('id_kabupaten');
        $id_kecamatan=(int)$this->input->get('id_kecamatan');
        
        $title='Jumlah Penduduk Berdasarkan Provinsi';
        
        $seriesName='Kabupaten';
        if($id_kabupaten>0){
            $title='Jumlah Penduduk Berdasarkan Kecamatan';
            $seriesName='Kecamatan';
            if($id_kecamatan>0){
                $title='Jumlah Penduduk Berdasarkan Desa';
                $seriesName='Desa';
            }
        }
        $chart=$this->penduduk_model->get_chart_column($id_provinsi,$id_kabupaten,$id_kecamatan);
        $res=array(
            'title'=>$title,
            'yAxis'=>'Jumlah Penduduk',
            'seriesName'=>$title,
            'data'=>$chart['data'],
            'sql'=>$chart['sql']
            );
        echo json_encode($res);
    }
}
