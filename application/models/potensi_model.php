<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class potensi_model extends CI_model {

  function get_potensi_kec($id_kec) {
    $sql = "select desa, kecamatan, kode, persepsi_desa, produk_pertanian,"
      . "produk_nonpertanian,kec_no "
      . "from desa order by kec_no, desa_no";
    if ($id_kec > 0) {
      $sql = "select desa, kecamatan, kode, persepsi_desa, produk_pertanian,"
        . "produk_nonpertanian,kec_no "
        . "from desa where kec_no='$id_kec' order by kec_no, desa_no" ;
    }
    $q = $this->db->query($sql);
    return $q->result_array();
  }

  function get_potensi_des($id_kec, $id_des) {
    $sql = "select desa, kecamatan, kode, persepsi_desa, produk_pertanian,"
      . "produk_nonpertanian,kec_no "
      . "from desa order by kec_no, desa_no";
    if ($id_kec > 0 && $id_des > 0) {
      $sql = "select desa, kecamatan, kode, persepsi_desa,produk_pertanian,"
        . "produk_nonpertanian,kec_no "
        . "from desa where kec_no='$id_kec' and desa_no='$id_des' order by kec_no, desa_no";
    }
    $q = $this->db->query($sql);
    return $q->result_array();
  }

}
