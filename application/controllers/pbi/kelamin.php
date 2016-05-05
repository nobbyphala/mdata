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

class kelamin extends admin_controller {

    public $data = array('title' => 'Data PBI Berdasarkan Jenis Kelamin');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model','chart_model'));
    }
    function index(){
    	$this->data['list_kelamin']=$this->db->query("select * from master_jenis_kelamin order by JENIS_KELAMIN_KODE")->result_array();
    	$this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ")->result_array();
    	$this->load->view('pbi/view_kelamin',$this->data);
    }
    function get_chart_column(){
        $id_kabupaten=(int)$this->input->get('id_kabupaten');
        $id_kecamatan=(int)$this->input->get('id_kecamatan');
        $id_desa=(int)$this->input->get('id_desa');
        $jenis_kelamin=array();
        $q=$this->db->query("select * from master_jenis_kelamin")->result_array();
        foreach ($q as $key => $jk) {
            $jenis_kelamin[]=$jk['JENIS_KELAMIN_NAMA'];
        }
        $title="Jumlah PBI di Jawa Timur";
        $jenis_kelamin[]='KATEGORI LAIN';
        $sql="select KABUPATEN_NAMA as NAME from master_kabupaten ";
        $sql2="select count(*) as jumlah, coalesce(JENIS_KELAMIN_NAMA,'KATEGORI LAIN') as NAME, kb.KABUPATEN_NAMA as CATEGORY
            from penduduk p left join master_jenis_kelamin jk
            on jk.JENIS_KELAMIN_KODE=p.JENIS_KELAMIN
            inner join master_kabupaten kb on kb.KABUPATEN_ID=p.KABUPATEN_ID
            group by CATEGORY, NAME";
        if($id_kabupaten>0){
            $q=$this->db->query("select * from master_kabupaten where KABUPATEN_ID='$id_kabupaten'")->result_array();
            if(count($q)>0){
                $title="Jumlah PBI di Kabupaten ".$q[0]['KABUPATEN_NAMA'];
            }
            $sql="select KECAMATAN_NAMA AS NAME FROM master_kecamatan where KABUPATEN_ID='$id_kabupaten'";
            $sql2="select count(*) as jumlah, kc.KECAMATAN_NAMA as CATEGORY, coalesce(jk.JENIS_KELAMIN_NAMA,'KATEGORI LAIN') as NAME
                from penduduk p
                inner join master_kecamatan kc 
                on kc.KECAMATAN_ID=p.KECAMATAN_ID
                left join master_jenis_kelamin jk
                on jk.JENIS_KELAMIN_KODE=p.JENIS_KELAMIN
                where p.KABUPATEN_ID='$id_kabupaten'
                group by CATEGORY, NAME";
            if($id_kecamatan>0){
                $q=$this->db->query("select * from master_kecamatan where KECAMATAN_ID='$id_kecamatan'")->result_array();
                if(count($q)>0){
                    $title="Jumlah PBI di Kecamatan ".$q[0]['KECAMATAN_NAMA'];
                }
                $sql="SELECT DESA_NAMA AS NAME from master_desa where KECAMATAN_ID='$id_kecamatan'";
                $sql2="select count(*) as jumlah, ds.DESA_NAMA as CATEGORY, coalesce(jk.JENIS_KELAMIN_NAMA,'KATEGORI LAIN') as NAME
                    from penduduk p
                    inner join master_desa ds
                    on ds.DESA_ID=p.DESA_ID
                    left join master_jenis_kelamin jk
                    on jk.JENIS_KELAMIN_KODE=p.JENIS_KELAMIN
                    where p.KECAMATAN_ID='$id_kecamatan'
                    group by CATEGORY, NAME";
            }
        }
        $q=$this->db->query($sql)->result_array();
        $category=array();
        $data1=array();
        foreach ($q as $key => $row) {
            $category[]=$row['NAME'];
            //$data[$row['NAME']]=array();
        }
        foreach ($jenis_kelamin as $key => $jk) {
            $data1[$jk]=array();
            foreach ($category as $key => $value) {
                $data1[$jk][$value]=0;
            }
        }
        $q=$this->db->query($sql2)->result_array();
        foreach ($q as $key => $row) {
            $data1[$row['NAME']][$row['CATEGORY']]=$row['jumlah'];
        }
        $data2=array();
        foreach ($data1 as $key => $d) {
            $obj = array('name'=>$key);
            $d2=array();
            foreach ($d as $key => $value) {
                $d2[]=(int)$value;
            }
            $obj['data']=$d2;
            $data2[]=$obj;
        }
        $res=array(
            'category'=>$category,
            'series'=>$data2,
            'title'=>$title,
            'sql2'=>$sql2
            );
        echo json_encode($res);
    }
}