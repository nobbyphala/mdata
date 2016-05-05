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

class penduduk extends admin_controller {

    public $data = array('title' => 'Data PBI Berdasarkan Lokasi');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model'));
    }

    public function index() {
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ")->result_array();
        $this->load->view('home/view_penduduk_lokasi', $this->data);
    }

    function get_chart_column(){
        $id_provinsi=(int)$this->input->get('id_provinsi');
        $id_kabupaten=(int)$this->input->get('id_kabupaten');
        $id_kecamatan=(int)$this->input->get('id_kecamatan');
        
        $title='Jumlah PBI di Provinsi Jawa Timur';
        $seriesName='Kabupaten';
        if($id_kabupaten>0){
            $q=$this->db->query("select * from master_kabupaten where KABUPATEN_ID=?",array($id_kabupaten))->result_array();
            $title='Jumlah PBI di Kabupaten ';
            if(count($q)>0){
                $kb=$q[0];
                $title.=$kb['KABUPATEN_NAMA'];
            }
            $seriesName='Kecamatan';
            if($id_kecamatan>0){
                $title='Jumlah PBI di Kecamatan ';
                $q=$this->db->query("select * from master_kecamatan where KECAMATAN_ID=?",array($id_kecamatan))->result_array();
                if(count($q)>0){
                    $kc=$q[0];
                    $title.=$kc['KECAMATAN_NAMA'];
                }
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
