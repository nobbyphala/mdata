<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class poligon_model extends CI_model {

  function get_polygon_kabupaten() {
    $sql = "select geometry,propinsi,kab_kota,kecamatan,prop_no,kabkota_no,kec_no,id2007 "
      . "from kecamatan where prop_no=35 and kabkota_no=17 order by kec_no";
    $q = $this->db->query($sql);
    return $q->result_array();
  }

  function get_polygon_kecamatan($id_kec) {
    $sql = "select geometry,propinsi,kab_kota,kecamatan,desa,prop_no,desa_no,kec_no,id2007 "
      . "from desa  order by kec_no,desa_no";
    if ($id_kec > 0) {
      $sql = "select geometry,propinsi,kab_kota,kecamatan,desa,prop_no,desa_no,kec_no,id2007 "
        . "from desa where kec_no='$id_kec' order by desa_no";
    }
    $q = $this->db->query($sql);
    return $q->result_array();
  }

}
