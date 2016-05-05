<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';

class penduduk extends admin_controller {

    public $data = array('title' => 'Penduduk');

    public function __construct() {
        parent::__construct();
        $this->load->model(array('penduduk_model'));
    }
    function index(){
        $this->data['list_kabupaten']=$this->db->query("select * from kabupaten ")->result_array();
        $this->load->view('master/view_penduduk', $this->data);
    }
    function kk(){
        $this->data['no_kk']=$this->input->get('id');
        $this->load->view('master/view_penduduk_kk', $this->data);
    }
    function halaman_tambah(){

        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten order by KABUPATEN_KODE, KABUPATEN_NAMA")->result_array();
        $this->data['list_kelamin']=$this->db->query("select * from master_jenis_kelamin")->result_array();
        $this->data['list_hubungan_keluarga']=$this->db->query("select * from master_hubungan_keluarga")->result_array();
        $this->data['list_sekolah']=$this->db->query("select * from master_sekolah")->result_array();
        $this->data['list_cacat']=$this->db->query("select * from master_cacat")->result_array();
        $this->data['list_hamil']=$this->db->query("select * from master_hamil")->result_array();
        $this->data['list_kawin']=$this->db->query("select * from master_kawin")->result_array();
        $this->load->view('master/view_penduduk_tambah',$this->data);
    }
    function edit_page(){
        $id=(int)$this->input->get('id_penduduk');
        $this->data['penduduk']=$this->penduduk_model->get_penduduk($id);
        $this->data['list_kabupaten']=$this->db->query("select * from master_kabupaten order by KABUPATEN_KODE, KABUPATEN_NAMA")->result_array();
        $this->data['list_kecamatan']=$this->db->query("select * from master_kecamatan where KABUPATEN_ID=? order by KECAMATAN_KODE,KECAMATAN_NAMA",array($this->data['penduduk']['KABUPATEN_ID']))->result_array();
        $this->data['list_desa']=$this->db->query("select * from master_desa where KECAMATAN_ID=? ORDER BY DESA_KODE, DESA_NAMA",array($this->data['penduduk']['KECAMATAN_ID']))->result_array();
        $this->data['list_kelamin']=$this->db->query("select * from master_jenis_kelamin")->result_array();
        $this->data['list_hubungan_keluarga']=$this->db->query("select * from master_hubungan_keluarga")->result_array();
        $this->data['list_sekolah']=$this->db->query("select * from master_sekolah")->result_array();
        $this->data['list_cacat']=$this->db->query("select * from master_cacat")->result_array();
        $this->data['list_hamil']=$this->db->query("select * from master_hamil")->result_array();
        $this->data['list_kawin']=$this->db->query("select * from master_kawin")->result_array();
        $this->load->view('home/view_penduduk_edit',$this->data);
    }
    public function detail(){
        $id=(int)$this->input->get('id_penduduk');
        $this->data['penduduk']=$this->penduduk_model->get_penduduk($id);
        $this->data['list_kabupaten']=$this->db->query("select * from kabupaten order by KABUPATEN_KODE, KABUPATEN_NAMA")->result_array();
        $this->data['list_kecamatan']=$this->db->query("select * from kecamatan where KABUPATEN=? order by KECAMATAN_KODE,KECAMATAN_NAMA",array($this->data['penduduk']['KABUPATEN_ID']))->result_array();
        $this->data['list_desa']=$this->db->query("select * from master_desa where KECAMATAN_ID=? ORDER BY DESA_KODE, DESA_NAMA",array($this->data['penduduk']['KECAMATAN_ID']))->result_array();
        $this->data['list_kelamin']=$this->db->query("select * from master_jenis_kelamin")->result_array();
        $this->data['list_hubungan_keluarga']=$this->db->query("select * from master_hubungan_keluarga")->result_array();
        $this->data['list_sekolah']=$this->db->query("select * from master_sekolah")->result_array();
        $this->data['list_cacat']=$this->db->query("select * from master_cacat")->result_array();
        $this->data['list_hamil']=$this->db->query("select * from master_hamil")->result_array();
        $this->data['list_kawin']=$this->db->query("select * from master_kawin")->result_array();
        $this->load->view('home/view_penduduk_detail',$this->data);
    }

    function hapus(){
        $id=(int)$this->input->post('id');
        if($this->db->query("delete from penduduk where PENDUDUK_ID=?",array($id))==1){
            echo 'ok';
        }else{
            echo 'Gagal menghapus data penduduk';
        }
    }
    function hapus2(){
        $id=(int)$this->input->post('id');
        if($this->db->query("delete from penduduk where PENDUDUK_ID=?",array($id))==1){
            redirect(site_url().'/master/penduduk');
        }else{
            echo 'Gagal menghapus data penduduk';
        }
    }
    function edit(){
		if(in_array("edit_penduduk", $this->my_roles) == false){
			$this->load->view("page/error",array("pesan"=>"Anda tidak berhak mengakses fungsionalitas ini"));
			return;
		}
        $field="";
        $nik=$this->input->post('nik');
        $kk=$this->input->post('kk');
        $nama=$this->input->post('nama');
        $alamat=$this->input->post('alamat');
        $id_kabupaten=(int)$this->input->post('select_kabupaten');
        $id_kecamatan=(int)$this->input->post('select_kecamatan');
        $id_desa=(int)$this->input->post('select_desa');
        $tempat_lahir=$this->input->post('tempat_lahir');
        $tanggal_lahir=$this->input->post('tanggal_lahir');
        $kode_kelamin=$this->input->post('select_kelamin');
        $hubungan_keluarga=$this->input->post('select_hubungan_keluarga');
        $kode_sekolah=$this->input->post('select_sekolah');
        $cacat=$this->input->post('select_cacat');
        $hamil=$this->input->post('select_hamil');
        $penghasilan=$this->input->post('penghasilan');
        $kode_kawin=$this->input->post('select_kawin');
        $id=(int)$this->input->post('id_penduduk');
        $res=$this->db->query("update penduduk set KABUPATEN_ID=?, KECAMATAN_ID=?, DESA_ID=?,
            ALAMAT=?, KK=?, NIK=?, NAMA=?, TEMPAT_LAHIR=?, TANGGAL_LAHIR=?, JENIS_KELAMIN=?,
            HUBUNGAN_KELUARGA=?, SEKOLAH=?, CACAT=?, HAMIL=?, PENGHASILAN_PERBULAN=?,
            STATUS_KAWIN=? WHERE PENDUDUK_ID=?",array($id_kabupaten,$id_kecamatan,$id_desa,
                $alamat,$kk,$nik,$nama,$tempat_lahir,$tanggal_lahir,$kode_kelamin,
                $hubungan_keluarga,$kode_sekolah,$cacat,$hamil,$penghasilan,$kode_kawin,
                $id));
        redirect(site_url().'/master/penduduk/detail?id_penduduk='.$id);
    }
    function tambah(){
		if(in_array("add_penduduk", $this->my_roles) == false){
			$this->load->view("page/error",array("pesan"=>"Anda tidak berhak mengakses fungsionalitas ini"));
			return;
		}
        $nik=$this->input->post('nik');
        $kk=$this->input->post('kk');
        $nama=$this->input->post('nama');
        $alamat=$this->input->post('alamat');
        $id_kabupaten=(int)$this->input->post('select_kabupaten');
        $id_kecamatan=(int)$this->input->post('select_kecamatan');
        $id_desa=(int)$this->input->post('select_desa');
        $tempat_lahir=$this->input->post('tempat_lahir');
        $tanggal_lahir=$this->input->post('tanggal_lahir');
        $kode_kelamin=$this->input->post('select_kelamin');
        $hubungan_keluarga=$this->input->post('select_hubungan_keluarga');
        $kode_sekolah=$this->input->post('select_sekolah');
        $cacat=$this->input->post('select_cacat');
        $hamil=$this->input->post('select_hamil');
        $penghasilan=$this->input->post('penghasilan');
        $kode_kawin=$this->input->post('select_kawin');
        $this->db->query("insert into penduduk (KABUPATEN_ID,KECAMATAN_ID,DESA_ID,ALAMAT,KK,NIK,NAMA,TEMPAT_LAHIR,TANGGAL_LAHIR,JENIS_KELAMIN,
            HUBUNGAN_KELUARGA,SEKOLAH,CACAT,HAMIL,PENGHASILAN_PERBULAN,STATUS_KAWIN) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        array($id_kabupaten,$id_kecamatan,$id_desa,$alamat,$kk,$nik,$nama,$tempat_lahir,$tanggal_lahir,$kode_kelamin,$hubungan_keluarga,$kode_sekolah,$cacat,$hamil,$penghasilan,$kode_kawin));
        $id=$this->db->insert_id();
        redirect(site_url().'/master/penduduk/detail?id_penduduk='.$id);
    }

    function get_list_penduduk_datatable() {
        echo json_encode($this->penduduk_model->get_list_penduduk_datatable($_POST));
    }
    function get_list_penduduk_hamil_datatable() {
        echo json_encode($this->penduduk_model->get_list_penduduk_hamil_datatable($_POST));
    }
    function get_list_penduduk_kk_datatable(){
        $kk=$this->input->post('kk');
        echo json_encode($this->penduduk_model->get_list_penduduk_kk_datatable($_POST));
    }
}