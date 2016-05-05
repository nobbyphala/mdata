<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class wilayah_model extends CI_model {
  function get_list_kecamatan(){
    $sql = "select kecamatan, kec_no from kecamatan order by kec_no";
    $q = $this->db->query($sql);
    return $q->result_array();
  }
  function get_list_desa($id_kecamatan){
    $id_kecamatan=(int)$id_kecamatan;
    $sql = "select kec_no,desa_no,desa,kecamatan from desa where kec_no='$id_kecamatan'";
    $q = $this->db->query($sql);
    return $q->result_array();
  }
}