<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class map extends CI_Controller {

  function get_polygon_kabupaten() {
    $this->load->model(array('poligon_model'));
    $polygon_kecamatan = $this->poligon_model->get_polygon_kabupaten();
    $hasil = array();
    foreach ($polygon_kecamatan as $r) {//data loc buat marker
      $data_way = explode(" ", $r["geometry"]);
      $point_desa_list = array();
      $l = count($data_way) - 1;
      for ($i = 0; $i < $l; $i++) {
        $latlng = explode(",", $data_way[$i]);
        $lat = $latlng[0];
        $lng = $latlng[1];

        if ($i == 0) {//echo $latlng[1];
          $temp1 = explode(">", $latlng[0]);
          $lat = $temp1[4];
        }

        if ($i == count($data_way) - 1) {//echo $latlng[1];
          $temp = explode("<", $latlng[1]);
          $lng = $temp[0];
        }

        $data_latlng = array(
         'LAT' => $lng,
         'LNG' => $lat
        );

        array_push($point_desa_list, $data_latlng);
      }

      $data_per_desa = array(
       'id_prov' => $r["prop_no"],
       'id_kab' => $r["kabkota_no"],
       'id_kec' => $r["kec_no"],
       'kecamatan'=>$r['kecamatan'],
       'geo' => $point_desa_list
      );
      $hasil[] = $data_per_desa;
    }

    echo json_encode($hasil);
  }

  function get_polygon_kecamatan($id_kec=0) {
    $this->load->model(array('poligon_model'));
    $id_kec = abs((int) $id_kec);
    $polygon_kecamatan = $this->poligon_model->get_polygon_kecamatan($id_kec);
    $hasil = array();
    foreach ($polygon_kecamatan as $r) {//data loc buat marker
      $data_way = explode(" ", $r["geometry"]);
      $point_desa_list = array();
      $l = count($data_way) - 1;
      for ($i = 0; $i < $l; $i++) {
        $latlng = explode(",", $data_way[$i]);
        $lat = $latlng[0];
        $lng = $latlng[1];

        if ($i == 0) {//echo $latlng[1];
          $temp1 = explode(">", $latlng[0]);
          $lat = $temp1[4];
        }

        if ($i == count($data_way) - 1) {//echo $latlng[1];
          $temp = explode("<", $latlng[1]);
          $lng = $temp[0];
        }

        $data_latlng = array(
         'LAT' => $lng,
         'LNG' => $lat
        );

        array_push($point_desa_list, $data_latlng);
      }

      $data_per_desa = array(
       'id_prov' => $r["prop_no"],
       'id_kec' => $r["kec_no"],
       'id_des'=>$r['desa_no'],
       'desa'=>$r['desa'],
       'geo' => $point_desa_list
      );
      $hasil[] = $data_per_desa;
    }

    echo json_encode($hasil);
  }

  function get_polygon_desa($id_kec, $id_des) {
    
  }

}
