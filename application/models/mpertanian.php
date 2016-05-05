<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mpertanian extends CI_MODEL
{
    public function getPanenData($jenis_tanaman=0,$id_kabupaten=0, $id_kecamatan=0)
    {
        $query=0;
        if($id_kabupaten!=0)
        {
            if($id_kecamatan!=0)
            {
                $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb 
                                          where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten and p.jenis_tanaman='$jenis_tanaman' and p.id_kabupaten=$id_kabupaten and p.id_kecamatan=$id_kecamatan;");
            }
            else
                $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb 
                                          where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten and p.jenis_tanaman='$jenis_tanaman' and p.id_kabupaten=$id_kabupaten;");
        }
        else
            if($id_kecamatan!=0)
            {
                $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb where p.jenis_tanaman='$jenis_tanaman' and p.id_kecamatan=$id_kecamatan and kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten;");
            }
        else
            $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb where p.jenis_tanaman='$jenis_tanaman' and kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten;");


        /*if($jenis_tanaman==0)
        {
            $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten;");
        }
        $query=$this->db->query("SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten and p.jenis_tanaman='$jenis_tanaman';");
    */
        if($query->num_rows() > 0)
        {
            return $query;
        }
        return NULL;
    }

    public function getPanenDataChart($jenis_tanaman=0,$id_kabupaten=0, $id_kecamatan=0)
    {
        $query=0;
        if($id_kabupaten!=0)
        {
            if($id_kecamatan!=0)
            {
                $query=$this->db->query("SELECT hasil.nama_kecamatan, sum(hasil.produktivitas) as total FROM (SELECT kb.nama_kabupaten, kc.nama_kecamatan,p.* FROM panen p, kecamatan kc, kabupaten kb 
                                          where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten and p.jenis_tanaman='$jenis_tanaman' and p.id_kabupaten=$id_kabupaten and p.id_kecamatan=$id_kecamatan) hasil;");
            }
            else
                $query=$this->db->query("SELECT kc.nama_kecamatan, sum(p.produktivitas) as total FROM panen p, kecamatan kc, kabupaten kb 
                                          where kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten and p.jenis_tanaman='$jenis_tanaman' and p.id_kabupaten=$id_kabupaten GROUP BY kc.id_kecamatan;");
        }
        else
            if($id_kecamatan!=0)
            {
                $query=$this->db->query("SELECT kc.nama_kecamatan, sum(p.produktivitas) as total FROM panen p, kecamatan kc, kabupaten kb where p.jenis_tanaman='$jenis_tanaman' and p.id_kecamatan=$id_kecamatan and kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten GROUP BY kc.id_kecamatan;");
            }
            else
            $query=$this->db->query("SELECT kc.nama_kecamatan, sum(p.produktivitas) as total FROM panen p, kecamatan kc, kabupaten kb where p.jenis_tanaman='$jenis_tanaman' and kc.id_kecamatan=p.id_kecamatan and kb.id_kabupaten=kc.id_kabupaten GROUP BY kc.id_kecamatan;");

        if($query->num_rows() > 0)
        {
            return $query;
        }
        return $query;
    }

    //Jangan lupa isikan pemeriksaan
    public function insertPanenFromExcel($arr_data, $arr_check,$jenis_tanaman)
    {
        //var_dump($arr_data[2]);
        foreach ($arr_check as $index)
        {
            $index+=1;
            $val= $arr_data[$index];
            $query=$this->db->query("INSERT INTO panen VALUES(null,$val[2],$val[3],$val[5],$val[6],$val[7],'$jenis_tanaman',$val[8]);");
        }
    }
}