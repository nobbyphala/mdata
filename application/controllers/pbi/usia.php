<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

class usia extends admin_controller {

    public $data = array('title' => 'Data PBI Berdasarkan Usia');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model','chart_model'));
    }
    function index(){
    	$this->data['list_usia']=$this->db->query("select * from master_kategori_usia order by KATEGORI_USIA_BAWAH")->result_array();
    	$this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ")->result_array();
    	$this->load->view('pbi/view_usia',$this->data);
    }
    function get_chart_column(){
        $id_desa=(int)$this->input->get('id_desa');
        $id_kabupaten=(int)$this->input->get('id_kabupaten');
        $id_kecamatan=(int)$this->input->get('id_kecamatan');
        $id_usia=(int)$this->input->get('id_usia');
        $title='Jumlah PBI pada Semua Kategori Usia';
        $seriesName='Kelompok Usia';
        if($id_usia>0){
        	$q=$this->db->query("select * from master_kategori_usia where KATEGORI_USIA_ID=?",array($id_usia))->result_array();
        	if(count($q)>0){
        		$usia=$q[0];
        		$title='Jumlah PBI pada Kategori '.$usia['KATEGORI_USIA_NAMA'];
        	}
        }
        $chart=$this->chart_model->get_usia_chart_column($id_kabupaten,$id_kecamatan,$id_desa,$id_usia);
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