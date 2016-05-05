<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of desa
 *
 * @author mozar
 */
class jenis_kelamin extends admin_controller {

    public $data = array('title' => 'Master Jenis Kelamin');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_kelamin',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$sql="insert into master_jenis_kelamin (JENIS_KELAMIN_KODE,JENIS_KELAMIN_NAMA) values (?,?)";
    	$res=$this->db->query($sql,array($kode,$nama));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menambah data master jenis kelamin';
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$sql="delete from master_jenis_kelamin WHERE JENIS_KELAMIN_ID=?";
    	$res=$this->db->query($sql,array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menghapus data master jenis kelamin';
    	}
    }
    function edit(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$id=(int)$this->input->post('id');
    	$sql="update master_jenis_kelamin set JENIS_KELAMIN_KODE=?, JENIS_KELAMIN_NAMA=? WHERE JENIS_KELAMIN_ID=?";
    	$res=$this->db->query($sql,array($kode,$nama,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal mengedit data master jenis kelamin';
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_jenis_kelamin_datatable($_POST));
    }
}