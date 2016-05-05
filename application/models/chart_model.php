<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of desa_model
 *
 * @author mozar
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '/libraries/datatable.php';

class chart_model extends datatable {

	function get_usia_chart_column($id_kabupaten=0,$id_kecamatan=0,$id_desa=0,$id_usia=0){
        $id_kabupaten=(int)$id_kabupaten;
        $id_kecamatan=(int)$id_kecamatan;
        $filter='';
        $group='';
        $sql="select count(*) as jumlah, kb.KABUPATEN_NAMA as name
              from penduduk p 
              INNER join master_kabupaten kb
              on kb.KABUPATEN_ID=p.KABUPATEN_ID ";
        $sql="select COUNT(*) as jumlah, COALESCE(us.KATEGORI_USIA_NAMA,'KATEGORI LAIN') AS name from (
				select PENDUDUK_ID,
				cast(COALESCE(YEAR(CURRENT_TIMESTAMP)-YEAR(TANGGAL_LAHIR)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(TANGGAL_LAHIR,5)),case when length(USIA)>0 then USIA else -1 end) as UNSIGNED ) AS USIA2
				from penduduk
				) as pend
				left join master_kategori_usia us
				on us.KATEGORI_USIA_BAWAH<=pend.USIA2 and pend.USIA2 <= us.KATEGORI_USIA_ATAS
				GROUP BY name";
        $sql2="select KATEGORI_USIA_NAMA AS NAME from master_kategori_usia order by KATEGORI_USIA_KODE, KATEGORI_USIA_NAMA";
        $filter_usia='';
        if($id_usia>0){
        	$filter_usia="where us.KATEGORI_USIA_ID='$id_usia'";
        	$sql2="select KATEGORI_USIA_NAMA AS NAME from master_kategori_usia where KATEGORI_USIA_ID='$id_usia'";
        }
        
        if($id_kabupaten>0){
            $sql="select COUNT(*) as jumlah, COALESCE(us.KATEGORI_USIA_NAMA,'KATEGORI LAIN') AS name from (
				select PENDUDUK_ID,
				cast(COALESCE(YEAR(CURRENT_TIMESTAMP)-YEAR(TANGGAL_LAHIR)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(TANGGAL_LAHIR,5)),case when length(USIA)>0 then USIA else -1 end) as UNSIGNED ) AS USIA2
				from penduduk
				INNER JOIN master_kabupaten kb
				on kb.KABUPATEN_ID=penduduk.KABUPATEN_ID
				where kb.KABUPATEN_ID='$id_kabupaten'
				) as pend
				left join master_kategori_usia us
				on us.KATEGORI_USIA_BAWAH<=pend.USIA2 and pend.USIA2 <= us.KATEGORI_USIA_ATAS $filter_usia
				GROUP BY name";
              if($id_kecamatan>0){
                $sql="select COUNT(*) as jumlah, COALESCE(us.KATEGORI_USIA_NAMA,'KATEGORI LAIN') AS name from (
					select PENDUDUK_ID,
					cast(COALESCE(YEAR(CURRENT_TIMESTAMP)-YEAR(TANGGAL_LAHIR)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(TANGGAL_LAHIR,5)),case when length(USIA)>0 then USIA else -1 end) as UNSIGNED ) AS USIA2
					from penduduk
					INNER JOIN master_kecamatan kc
					on kc.KECAMATAN_ID=penduduk.KECAMATAN_ID
					where kc.KECAMATAN_ID='$id_kecamatan'
					) as pend
					left join master_kategori_usia us
					on us.KATEGORI_USIA_BAWAH<=pend.USIA2 and pend.USIA2 <= us.KATEGORI_USIA_ATAS $filter_usia
					GROUP BY name";
				if($id_desa>0){
					$sql="select COUNT(*) as jumlah, COALESCE(us.KATEGORI_USIA_NAMA,'KATEGORI LAIN') AS name from (
						select PENDUDUK_ID,
						cast(COALESCE(YEAR(CURRENT_TIMESTAMP)-YEAR(TANGGAL_LAHIR)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(TANGGAL_LAHIR,5)),case when length(USIA)>0 then USIA else -1 end) as UNSIGNED ) AS USIA2
						from penduduk
						INNER JOIN master_desa ds
						on ds.DESA_ID = penduduk.DESA_ID
						where ds.DESA_ID='$id_desa'
						) as pend
						left join master_kategori_usia us
						on us.KATEGORI_USIA_BAWAH<=pend.USIA2 and pend.USIA2 <= us.KATEGORI_USIA_ATAS $filter_usia
						GROUP BY name";
				}
              }
        }
        $q=$this->db->query($sql2)->result_array();
        $column=array();
        foreach ($q as $key => $row) {
          $column[$row['NAME']]=0;
        }
        if($id_usia<=0)
        	$column['KATEGORI LAIN']=0;
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
}