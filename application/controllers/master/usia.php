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
class usia extends admin_controller {

    public $data = array('title' => 'Master Kategori Usia');

    public function __construct() {
        parent::__construct();
        $this->load->model('master_model');
    }
    function index(){
    	$this->load->view('master/view_usia',$this->data);
    }
    function tambah(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
        $atas=$this->input->post('atas');
        $bawah=$this->input->post('bawah');
    	$sql="insert into master_kategori_usia (KATEGORI_USIA_KODE, KATEGORI_USIA_NAMA, KATEGORI_USIA_BAWAH, KATEGORI_USIA_ATAS) values (?,?,?,?)";
    	$res=$this->db->query($sql,array($kode,$nama,$bawah,$atas));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menambah data master kategori usia';
    	}
    }
    function hapus(){
    	$id=(int)$this->input->post('id');
    	$sql="delete from master_kategori_usia WHERE KATEGORI_USIA_ID=?";
    	$res=$this->db->query($sql,array($id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal menghapus data master kategori usia';
    	}
    }
    function edit(){
    	$kode=$this->input->post('kode');
    	$nama=$this->input->post('nama');
    	$id=(int)$this->input->post('id');
        $atas=$this->input->post('atas');
        $bawah=$this->input->post('bawah');
    	$sql="update master_kategori_usia set KATEGORI_USIA_KODE=?, KATEGORI_USIA_NAMA=?, KATEGORI_USIA_BAWAH=?, KATEGORI_USIA_ATAS=? WHERE KATEGORI_USIA_ID=?";
    	$res=$this->db->query($sql,array($kode,$nama,$bawah,$atas,$id));
    	if($res==1){
    		echo 'ok';
    	}else{
    		echo 'Gagal mengedit data master cacat';
    	}
    }
    function get_list_datatable(){
    	echo json_encode($this->master_model->get_list_usia_datatable($_POST));
    }
}