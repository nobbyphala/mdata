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

class Penghasilan extends admin_controller {

    public $data = array('title' => 'Data PBI Berdasarkan Penghasilan');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model','chart_model'));
    }
    function index(){
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten ")->result_array();
        $this->load->view('pbi/view_penghasilan',$this->data);
    }
    function get_chart_column(){
        $id_kabupaten=(int)$this->input->get('id_kabupaten');
        $id_kecamatan=(int)$this->input->get('id_kecamatan');
        $id_desa=(int)$this->input->get('id_desa');
        $title="Jumlah PBI di Jawa Timur";
        $q=$this->db->query("select PENGHASILAN_NAMA AS NAMA from master_penghasilan order by PENGHASILAN_KODE")->result_array();
        $lhk=array();
        foreach ($q as $key => $row) {
            $lhk[$row['NAMA']]=0;
        }
        $lhk['KATEGORI LAIN']=0;
        $sql="select count(*) as jumlah, coalesce(cc.PENGHASILAN_NAMA,'KATEGORI LAIN') AS NAME
                from penduduk p
                left join master_penghasilan cc
                on cc.PENGHASILAN_BAWAH <= p.PENGHASILAN_PERBULAN AND p.PENGHASILAN_PERBULAN <= cc.PENGHASILAN_ATAS
                group by NAME";
        if($id_kabupaten>0){
            $q=$this->db->query("select KABUPATEN_NAMA AS NAMA from master_kabupaten where KABUPATEN_ID='$id_kabupaten'")->result_array();
            if(count($q)>0){
                $title="Jumlah PBI di Kabupaten ".$q[0]['NAMA'];
            }
            $sql="select count(*) as jumlah, coalesce(cc.PENGHASILAN_NAMA,'KATEGORI LAIN') AS NAME
                    from penduduk p
                    left join master_penghasilan cc
                    on cc.PENGHASILAN_BAWAH <= p.PENGHASILAN_PERBULAN AND p.PENGHASILAN_PERBULAN <= cc.PENGHASILAN_ATAS
                    where p.KABUPATEN_ID='$id_kabupaten'
                    group by NAME";
            if($id_kecamatan>0){
                $q=$this->db->query("select KECAMATAN_NAMA AS NAMA from master_kecamatan where KECAMATAN_ID='$id_kecamatan'")->result_array();
                if(count($q)>0){
                    $title="Jumlah PBI di Kecamatan ".$q[0]['NAMA'];
                }
                $sql="select count(*) as jumlah, coalesce(cc.PENGHASILAN_NAMA,'KATEGORI LAIN') AS NAME
                    from penduduk p
                    left join master_penghasilan cc
                    on cc.PENGHASILAN_BAWAH <= p.PENGHASILAN_PERBULAN AND p.PENGHASILAN_PERBULAN <= cc.PENGHASILAN_ATAS
                    where p.KECAMATAN_ID='$id_kecamatan'
                    group by NAME";
                if($id_desa>0){
                    $q=$this->db->query("select DESA_NAMA AS NAMA from master_desa where DESA_ID='$id_desa'")->result_array();
                    if(count($q)>0){
                        $title="Jumlah PBI di Desa ".$q[0]['NAMA'];
                    }
                    $sql="select count(*) as jumlah, coalesce(cc.PENGHASILAN_NAMA,'KATEGORI LAIN') AS NAME
                        from penduduk p
                        left join master_penghasilan cc
                        on cc.PENGHASILAN_BAWAH <= p.PENGHASILAN_PERBULAN AND p.PENGHASILAN_PERBULAN <= cc.PENGHASILAN_ATAS
                        where p.DESA_ID='$id_desa'
                        group by NAME";
                }
            }
        }
        $q=$this->db->query($sql)->result_array();
        $data=array();
        foreach ($q as $key => $row) {
            //$data[]=array('name'=>$row['NAME'],'y'=>(int)$row['jumlah']);
            $lhk[$row['NAME']]=(int)$row['jumlah'];
        }
        foreach ($lhk as $key => $d) {
            $data[]=array('name'=>$key,'y'=>$d);
        }
        $res=array(
            'title'=>$title,
            'data'=>$data,
            'sql'=>$sql
            );
        echo json_encode($res);
    }
}