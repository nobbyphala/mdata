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
#require_once APPPATH . '/libraries/datatable.php';

class dataprofilmodel extends CI_MODEL {
    
    public function getKabupaten()
    {
        $query = $this->db->query('SELECT kode_kabupaten, nama_kabupaten FROM kabupaten');
        if($query->num_rows > 0)
        {
            return $query->result();   
        }
        
        return NULL;
    }
    
    public function updateProfilKabupaten()
    {
        $kode_kabupaten=$this->input->post('kabupaten');
        $profil_text=$this->input->post('profil');
        
        $query=$this->db->query("UPDATE kabupaten SET profil_kabupaten='$profil_text' WHERE kode_kabupaten='$kode_kabupaten'");
    }
    
    public function getProfilKabupaten($kode_kabupaten)
    {
           $query = $this->db->query("SELECT profil_kabupaten FROM kabupaten WHERE kode_kabupaten='$kode_kabupaten'");
        if($query->num_rows > 0)
        {
            $row=$query->row();
            return $row->profil_kabupaten;   
        }
        
        return "";
    }

    public function updateProfilGeografis()
    {
        $kode_kabupaten=$this->input->post('kabupaten');
        $profil_text=$this->input->post('profil');

        //Jika tidak ada record
        $cek_ada=$this->db->query("SELECT * FROM profil_geografis WHERE kode_kabupaten='$kode_kabupaten'");
        if($cek_ada->num_rows() == 0)
        {
            $this->db->query("INSERT INTO profil_geografis(kode_kabupaten, profil_geografis) VALUES('$kode_kabupaten','')");
        }

        $query=$this->db->query("UPDATE profil_geografis SET profil_geografis='$profil_text' WHERE kode_kabupaten='$kode_kabupaten'");
    }

    public function getProfilGeografis($kode_kabupaten)
    {
        $query = $this->db->query("SELECT profil_geografis FROM profil_geografis WHERE kode_kabupaten='$kode_kabupaten'");
        if($query->num_rows > 0)
        {
            $row=$query->row();
            return $row->profil_geografis;
        }

        return "";
    }
}