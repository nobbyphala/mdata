<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of penduduk_model
 *
 * @author mozar
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '/libraries/datatable.php';

class penduduk_model extends datatable {

    //put your code here
    function get_list_penduduk_datatable($request) {
        $sql = "select desa.DESA_NAMA, desa.DESA_KODE, k.KECAMATAN_NAMA,kb.KABUPATEN_NAMA,p.PROVINSI_NAMA,
                COALESCE(YEAR(CURRENT_TIMESTAMP) - YEAR(TANGGAL_LAHIR) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(TANGGAL_LAHIR, 5)),USIA) AS USIA,
                penduduk.PENDUDUK_ID, penduduk.NAMA,penduduk.ALAMAT, penduduk.NIK, penduduk.KK,
                penduduk.TEMPAT_LAHIR,penduduk.TANGGAL_LAHIR, 
                COALESCE(kelamin.JENIS_KELAMIN_NAMA,penduduk.JENIS_KELAMIN) as JENIS_KELAMIN,
                COALESCE(hk.HUBUNGAN_KELUARGA_NAMA, penduduk.HUBUNGAN_KELUARGA) AS HUBUNGAN_KELUARGA,
                coalesce(sekolah.SEKOLAH_NAMA,penduduk.SEKOLAH) AS SEKOLAH,
                COALESCE(cacat.CACAT_NAMA,penduduk.CACAT) AS CACAT,
                case when kelamin.JENIS_KELAMIN_KODE='1' THEN '-' ELSE COALESCE(hamil.HAMIL_NAMA,penduduk.HAMIL) END as HAMIL,
                penduduk.PENGHASILAN_PERBULAN,
                COALESCE(kwn.KAWIN_NAMA,penduduk.STATUS_KAWIN) AS STATUS_KAWIN,
                penduduk.FILE_UPLOAD,
                penduduk.PROVINSI_ID,
                penduduk.KABUPATEN_ID,
                penduduk.KECAMATAN_ID,
                penduduk.DESA_ID
                from penduduk 
                inner join master_desa desa 
                on desa.DESA_ID=penduduk.DESA_ID 
                inner join master_kecamatan k 
                on k.KECAMATAN_ID=desa.KECAMATAN_ID 
                inner join master_kabupaten kb 
                on kb.KABUPATEN_ID=k.KABUPATEN_ID 
                inner join master_provinsi p 
                on p.PROVINSI_ID=kb.PROVINSI_ID
                LEFT JOIN master_jenis_kelamin kelamin
                on kelamin.JENIS_KELAMIN_KODE=penduduk.JENIS_KELAMIN
                LEFT JOIN master_hubungan_keluarga hk
                on hk.HUBUNGAN_KELUARGA_KODE=penduduk.HUBUNGAN_KELUARGA
                LEFT JOIN master_sekolah sekolah
                on sekolah.SEKOLAH_KODE=penduduk.SEKOLAH
                LEFT JOIN master_cacat cacat
                on cacat.CACAT_KODE=penduduk.CACAT
                LEFT JOIN master_hamil hamil
                on hamil.HAMIL_KODE=penduduk.HAMIL
                LEFT JOIN master_kawin kwn
                on kwn.KAWIN_KODE=penduduk.STATUS_KAWIN";
        //$id_provinsi = intval($request['id_provinsi']);
        $id_kabupaten = intval($request['id_kabupaten']);
        $id_kecamatan = intval($request['id_kecamatan']);
        $id_desa = intval($request['id_desa']);
        //if($id_provinsi>0){
            //$sql.=" where p.PROVINSI_ID='$id_provinsi'";
            if($id_kabupaten>0){
                $sql.=" where kb.KABUPATEN_ID='$id_kabupaten'";
                if($id_kecamatan>0){
                    $sql.=" and k.KECAMATAN_ID='$id_kecamatan'";
                    if($id_desa>0){
                        $sql.=" and desa.DESA_ID='$id_desa'";
                    }
                }
            }
        //}
        $columns = array(
            0=>array('name' => 'DESA_KODE'),
            1=>array('name' => 'PENDUDUK_ID'),
            2=>array('name' => 'NAMA'),
            3=>array('name' => 'PROVINSI_NAMA'),
            4=>array('name' => 'KABUPATEN_NAMA'),
            5=>array('name' => 'KECAMATAN_NAMA'),
            6=>array('name' => 'DESA_NAMA'),
            7=>array('name' => 'ALAMAT'),
            8=>array('name' => 'NIK'),
            9=>array('name' => 'KK'),
            10=>array('name' => 'TEMPAT_LAHIR'),
            11=>array('name' => 'TANGGAL_LAHIR'),
            12=>array('name' => 'USIA'),
            13=>array('name' => 'JENIS_KELAMIN'),
            14=>array('name' => 'HUBUNGAN_KELUARGA'),
            15=>array('name' => 'SEKOLAH'),
            16=>array('name' => 'CACAT'),
            17=>array('name' => 'HAMIL'),
            18=>array('name' => 'PENGHASILAN_PERBULAN'),
            19=>array('name' => 'STATUS_KAWIN'),
            20=>array('name' => 'FILE_UPLOAD'),
            21=>array('name' => 'PROVINSI_ID'),
            22=>array('name' => 'KABUPATEN_ID'),
            23=>array('name' => 'KECAMATAN_ID'),
            24=>array('name' => 'DESA_ID'),
        );
        return $this->get_datatable($sql, $columns, $request);
    }

    function get_chart_column($id_provinsi=0,$id_kabupaten=0,$id_kecamatan=0){
        $id_provinsi=(int)$id_provinsi;
        $id_kabupaten=(int)$id_kabupaten;
        $id_kecamatan=(int)$id_kecamatan;
        $filter='';
        $group='';
        $sql="select count(*) as jumlah, kb.KABUPATEN_NAMA as name
              from penduduk p 
              INNER join master_kabupaten kb
              on kb.KABUPATEN_ID=p.KABUPATEN_ID ";
        $sql2="select KABUPATEN_NAMA AS NAME FROM master_kabupaten order KABUPATEN_NAMA";
        
        if($id_kabupaten>0){
            $sql="select count(*) as jumlah, kc.KECAMATAN_NAMA as name, kc.KECAMATAN_ID
              from penduduk p 
              inner join master_kecamatan kc
              on kc.KECAMATAN_ID=p.KECAMATAN_ID
              INNER JOIN master_kabupaten kb
              on kb.KABUPATEN_ID=kc.KABUPATEN_ID
              INNER join master_provinsi pr 
              on pr.PROVINSI_ID=kb.PROVINSI_ID
              where kb.KABUPATEN_ID='$id_kabupaten' 
              group by kc.KECAMATAN_ID";
              $sql2="select KECAMATAN_NAMA AS NAME FROM master_kecamatan where KABUPATEN_ID='$id_kabupaten' ORDER BY KECAMATAN_NAMA";
              if($id_kecamatan>0){
                $sql="select count(*) as jumlah, ds.DESA_NAMA AS name, ds.DESA_ID
                  from penduduk p 
                  inner join master_desa ds
                  on ds.DESA_ID=p.DESA_ID
                  inner join master_kecamatan kc
                  on kc.KECAMATAN_ID=ds.KECAMATAN_ID
                  INNER JOIN master_kabupaten kb
                  on kb.KABUPATEN_ID=kc.KABUPATEN_ID
                  INNER join master_provinsi pr 
                  on pr.PROVINSI_ID=kb.PROVINSI_ID
                  where kc.KECAMATAN_ID='$id_kecamatan' 
                  group by ds.DESA_ID";
                  $sql2="select DESA_NAMA AS NAME FROM master_desa where KECAMATAN_ID='$id_kecamatan' ORDER BY DESA_NAMA";
              }
        }
        $q=$this->db->query($sql2)->result_array();
        $column=array();
        foreach ($q as $key => $row) {
          $column[$row['NAME']]=0;
        }
        $q=$this->db->query($sql)->result_array();
        $res=array();
        foreach ($q as $key => $row) {
            //$res[]=array('name'=>$row['name'],'y'=>(int)$row['jumlah']);
          $column[$row['name']]=(int)$row['jumlah'];
        }
        foreach ($column as $key => $value) {
          $res[]=array('name'=>$key,'y'=>$value);
        }
        return array('data'=>$res,'sql'=>$sql);
    }

    function get_penduduk($id){
      $id=(int)$id;
      $sql="select * 
            from penduduk p 
            inner join master_desa ds on ds.DESA_ID=p.DESA_ID
            inner join master_kecamatan kc on kc.KECAMATAN_ID=ds.KECAMATAN_ID
            inner join master_kabupaten kb on kb.KABUPATEN_ID=kc.KABUPATEN_ID
            inner join master_provinsi pr on pr.PROVINSI_ID=kb.PROVINSI_ID
            LEFT JOIN master_jenis_kelamin kelamin
            on kelamin.JENIS_KELAMIN_KODE=p.JENIS_KELAMIN
            LEFT JOIN master_hubungan_keluarga hk
            on hk.HUBUNGAN_KELUARGA_KODE=p.HUBUNGAN_KELUARGA
            LEFT JOIN master_sekolah sekolah
            on sekolah.SEKOLAH_KODE=p.SEKOLAH
            LEFT JOIN master_cacat cacat
            on cacat.CACAT_KODE=p.CACAT
            LEFT JOIN master_hamil hamil
            on hamil.HAMIL_KODE=p.HAMIL
            LEFT JOIN master_kawin kwn
            on kwn.KAWIN_KODE=p.STATUS_KAWIN
            where p.PENDUDUK_ID=?";
      $q=$this->db->query($sql,array($id))->result_array();
      if(count($q)){
        return $q[0];
      }
      return null;
    }
    function get_list_penduduk_hamil_datatable($request){
      $sql = "select desa.DESA_NAMA, desa.DESA_KODE, k.KECAMATAN_NAMA,kb.KABUPATEN_NAMA,p.PROVINSI_NAMA,
                COALESCE(YEAR(CURRENT_TIMESTAMP) - YEAR(TANGGAL_LAHIR) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(TANGGAL_LAHIR, 5)),USIA) AS USIA,
                penduduk.PENDUDUK_ID, penduduk.NAMA,penduduk.ALAMAT, penduduk.NIK, penduduk.KK,
                penduduk.TEMPAT_LAHIR,penduduk.TANGGAL_LAHIR, 
                COALESCE(kelamin.JENIS_KELAMIN_NAMA,penduduk.JENIS_KELAMIN) as JENIS_KELAMIN,
                COALESCE(hk.HUBUNGAN_KELUARGA_NAMA, penduduk.HUBUNGAN_KELUARGA) AS HUBUNGAN_KELUARGA,
                coalesce(sekolah.SEKOLAH_NAMA,penduduk.SEKOLAH) AS SEKOLAH,
                COALESCE(cacat.CACAT_NAMA,penduduk.CACAT) AS CACAT,
                case when kelamin.JENIS_KELAMIN_KODE='1' THEN '-' ELSE COALESCE(hamil.HAMIL_NAMA,penduduk.HAMIL) END as HAMIL,
                penduduk.PENGHASILAN_PERBULAN,
                COALESCE(kwn.KAWIN_NAMA,penduduk.STATUS_KAWIN) AS STATUS_KAWIN,
                penduduk.FILE_UPLOAD,
                penduduk.PROVINSI_ID,
                penduduk.KABUPATEN_ID,
                penduduk.KECAMATAN_ID,
                penduduk.DESA_ID
                from penduduk 
                inner join master_desa desa 
                on desa.DESA_ID=penduduk.DESA_ID 
                inner join master_kecamatan k 
                on k.KECAMATAN_ID=desa.KECAMATAN_ID 
                inner join master_kabupaten kb 
                on kb.KABUPATEN_ID=k.KABUPATEN_ID 
                inner join master_provinsi p 
                on p.PROVINSI_ID=kb.PROVINSI_ID
                LEFT JOIN master_jenis_kelamin kelamin
                on kelamin.JENIS_KELAMIN_KODE=penduduk.JENIS_KELAMIN
                LEFT JOIN master_hubungan_keluarga hk
                on hk.HUBUNGAN_KELUARGA_KODE=penduduk.HUBUNGAN_KELUARGA
                LEFT JOIN master_sekolah sekolah
                on sekolah.SEKOLAH_KODE=penduduk.SEKOLAH
                LEFT JOIN master_cacat cacat
                on cacat.CACAT_KODE=penduduk.CACAT
                LEFT JOIN master_hamil hamil
                on hamil.HAMIL_KODE=penduduk.HAMIL
                LEFT JOIN master_kawin kwn
                on kwn.KAWIN_KODE=penduduk.STATUS_KAWIN
                where penduduk.JENIS_KELAMIN != '1' ";
        //$id_provinsi = intval($request['id_provinsi']);
        $id_kabupaten = intval($request['id_kabupaten']);
        $id_kecamatan = intval($request['id_kecamatan']);
        $id_desa = intval($request['id_desa']);
        //if($id_provinsi>0){
            //$sql.=" where p.PROVINSI_ID='$id_provinsi'";
            if($id_kabupaten>0){
                $sql.=" and kb.KABUPATEN_ID='$id_kabupaten'";
                if($id_kecamatan>0){
                    $sql.=" and k.KECAMATAN_ID='$id_kecamatan'";
                    if($id_desa>0){
                        $sql.=" and desa.DESA_ID='$id_desa'";
                    }
                }
            }
        //}
        $columns = array(
            0=>array('name' => 'DESA_KODE'),
            1=>array('name' => 'PENDUDUK_ID'),
            2=>array('name' => 'NAMA'),
            3=>array('name' => 'PROVINSI_NAMA'),
            4=>array('name' => 'KABUPATEN_NAMA'),
            5=>array('name' => 'KECAMATAN_NAMA'),
            6=>array('name' => 'DESA_NAMA'),
            7=>array('name' => 'ALAMAT'),
            8=>array('name' => 'NIK'),
            9=>array('name' => 'KK'),
            10=>array('name' => 'TEMPAT_LAHIR'),
            11=>array('name' => 'TANGGAL_LAHIR'),
            12=>array('name' => 'USIA'),
            13=>array('name' => 'JENIS_KELAMIN'),
            14=>array('name' => 'HUBUNGAN_KELUARGA'),
            15=>array('name' => 'SEKOLAH'),
            16=>array('name' => 'CACAT'),
            17=>array('name' => 'HAMIL'),
            18=>array('name' => 'PENGHASILAN_PERBULAN'),
            19=>array('name' => 'STATUS_KAWIN'),
            20=>array('name' => 'FILE_UPLOAD'),
            21=>array('name' => 'PROVINSI_ID'),
            22=>array('name' => 'KABUPATEN_ID'),
            23=>array('name' => 'KECAMATAN_ID'),
            24=>array('name' => 'DESA_ID'),
        );
        return $this->get_datatable($sql, $columns, $request);
    }
    function get_list_penduduk_kk_datatable($request){
      $kk=$this->input->post('kk');
      if(strlen($kk)==0){
        $kk='xxxx';
      }
      $sql = "select desa.DESA_NAMA, desa.DESA_KODE, k.KECAMATAN_NAMA,kb.KABUPATEN_NAMA,p.PROVINSI_NAMA,
                COALESCE(YEAR(CURRENT_TIMESTAMP) - YEAR(TANGGAL_LAHIR) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(TANGGAL_LAHIR, 5)),USIA) AS USIA,
                penduduk.PENDUDUK_ID, penduduk.NAMA,penduduk.ALAMAT, penduduk.NIK, penduduk.KK,
                penduduk.TEMPAT_LAHIR,penduduk.TANGGAL_LAHIR, 
                COALESCE(kelamin.JENIS_KELAMIN_NAMA,penduduk.JENIS_KELAMIN) as JENIS_KELAMIN,
                COALESCE(hk.HUBUNGAN_KELUARGA_NAMA, penduduk.HUBUNGAN_KELUARGA) AS HUBUNGAN_KELUARGA,
                coalesce(sekolah.SEKOLAH_NAMA,penduduk.SEKOLAH) AS SEKOLAH,
                COALESCE(cacat.CACAT_NAMA,penduduk.CACAT) AS CACAT,
                case when kelamin.JENIS_KELAMIN_KODE='1' THEN '-' ELSE COALESCE(hamil.HAMIL_NAMA,penduduk.HAMIL) END as HAMIL,
                penduduk.PENGHASILAN_PERBULAN,
                COALESCE(kwn.KAWIN_NAMA,penduduk.STATUS_KAWIN) AS STATUS_KAWIN,
                penduduk.FILE_UPLOAD,
                penduduk.PROVINSI_ID,
                penduduk.KABUPATEN_ID,
                penduduk.KECAMATAN_ID,
                penduduk.DESA_ID
                from penduduk 
                inner join master_desa desa 
                on desa.DESA_ID=penduduk.DESA_ID 
                inner join master_kecamatan k 
                on k.KECAMATAN_ID=desa.KECAMATAN_ID 
                inner join master_kabupaten kb 
                on kb.KABUPATEN_ID=k.KABUPATEN_ID 
                inner join master_provinsi p 
                on p.PROVINSI_ID=kb.PROVINSI_ID
                LEFT JOIN master_jenis_kelamin kelamin
                on kelamin.JENIS_KELAMIN_KODE=penduduk.JENIS_KELAMIN
                LEFT JOIN master_hubungan_keluarga hk
                on hk.HUBUNGAN_KELUARGA_KODE=penduduk.HUBUNGAN_KELUARGA
                LEFT JOIN master_sekolah sekolah
                on sekolah.SEKOLAH_KODE=penduduk.SEKOLAH
                LEFT JOIN master_cacat cacat
                on cacat.CACAT_KODE=penduduk.CACAT
                LEFT JOIN master_hamil hamil
                on hamil.HAMIL_KODE=penduduk.HAMIL
                LEFT JOIN master_kawin kwn
                on kwn.KAWIN_KODE=penduduk.STATUS_KAWIN
                where penduduk.KK='$kk'";
        //$id_provinsi = intval($request['id_provinsi']);
        
        //}
        $columns = array(
            0=>array('name' => 'DESA_KODE'),
            1=>array('name' => 'PENDUDUK_ID'),
            2=>array('name' => 'NAMA'),
            3=>array('name' => 'PROVINSI_NAMA'),
            4=>array('name' => 'KABUPATEN_NAMA'),
            5=>array('name' => 'KECAMATAN_NAMA'),
            6=>array('name' => 'DESA_NAMA'),
            7=>array('name' => 'ALAMAT'),
            8=>array('name' => 'NIK'),
            9=>array('name' => 'KK'),
            10=>array('name' => 'TEMPAT_LAHIR'),
            11=>array('name' => 'TANGGAL_LAHIR'),
            12=>array('name' => 'USIA'),
            13=>array('name' => 'JENIS_KELAMIN'),
            14=>array('name' => 'HUBUNGAN_KELUARGA'),
            15=>array('name' => 'SEKOLAH'),
            16=>array('name' => 'CACAT'),
            17=>array('name' => 'HAMIL'),
            18=>array('name' => 'PENGHASILAN_PERBULAN'),
            19=>array('name' => 'STATUS_KAWIN'),
            20=>array('name' => 'FILE_UPLOAD'),
            21=>array('name' => 'PROVINSI_ID'),
            22=>array('name' => 'KABUPATEN_ID'),
            23=>array('name' => 'KECAMATAN_ID'),
            24=>array('name' => 'DESA_ID'),
        );
        return $this->get_datatable($sql, $columns, $request);
    }
}
