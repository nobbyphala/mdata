<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

require_once APPPATH . '/libraries/admin_controller.php';
class Cobaupload extends admin_controller {
    public $data = array('title' => 'initial upload');

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('initial_upload/view_coba', $this->data);
    }
    
    public function proses()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        set_time_limit(0);
        $this->load->library(array('myuploadlib', 'excel'));
        $this->load->model(array('InitialUploadModel'));
        $myUpload = new MyUploadLib();
        $myUpload->prosesUpload('fileExcel', 'initial');
        $uploadedFile = $myUpload->getUploadedFiles();
        
        /*$this->load->library('excel');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($uploadedFile[0]['filePath']);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            //$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $column=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getCell($cell)->getColumn());
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
        //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
                } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
    */
        $this->load->model('excelmodel');
        $arr_data=$this->excelmodel->getExcelData($uploadedFile[0]['filePath']);
        $this->data["filepath"]=$uploadedFile[0]['filePath'];
        return $arr_data;
        //$this->load->view('initial_upload/view_coba_hasil',$data);
    }
    
    public function hasilupload()
    {
        $hasil=$this->proses();
        $this->data["title"]="Hasil Upload";
        $this->data["header"]=$hasil["header"];
        $this->data["data_val"]=$hasil["arr_data"];
        $page=$this->input->post('jenisdata');

        switch($page)
        {
            case "1":
                $this->load->view('initial_upload/view_coba_luas_lahan',$this->data);
                break;
            case "2":
                $this->data['tanaman']='Padi Sawah';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
            case "3":
                $this->data['tanaman']='Padi Ladang';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
            case "4":
                $this->data['tanaman']='Jagung';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
            case "5":
                $this->data['tanaman']='Ubi Kayu';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
            case "6":
                $this->data['tanaman']='Ubi Jalar';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
            case "7":
                $this->data['tanaman']='Kacang Tanah';
                $this->load->view('initial_upload/view_coba_panen',$this->data);
                break;
        }

    }
}