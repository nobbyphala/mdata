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
class sekolah extends admin_controller {

    public $data = array('title' => 'Master Status Keikutsertaan Sekolah');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_sekolah',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$sql="insert into master_sekolah (SEKOLAH_KODE,SEKOLAH_NAMA) values (?,?)";
    	$res=$this->db->query($sql,array($kode,$nama));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menambah data master sekolah';
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$sql="delete from master_sekolah WHERE SEKOLAH_ID=?";
    	$res=$this->db->query($sql,array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menghapus data master sekolah';
    	}
    }
    function edit(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$id=(int)$this->input->post('id');
    	$sql="update master_sekolah set SEKOLAH_KODE=?, SEKOLAH_NAMA=? WHERE SEKOLAH_ID=?";
    	$res=$this->db->query($sql,array($kode,$nama,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal mengedit data master sekolah';
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_sekolah_datatable($_POST));
    }
}