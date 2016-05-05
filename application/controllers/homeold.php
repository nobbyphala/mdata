<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class homeold extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   * 	- or -  
   * 		http://example.com/index.php/welcome/index
   * 	- or -
   * Since this controller is set as the default controller in 
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index() {
    $this->load->model(array('wilayah_model'));
    $list_kecamatan = $this->wilayah_model->get_list_kecamatan();
    $this->load->view('page/header');
    $this->load->view('home/map', array('list_kecamatan' => $list_kecamatan));
    $this->load->view('page/footer');
  }

  public function cetak($id_kec = 0, $id_des = 0) {
    $id_kec = abs((int) $id_kec);
    $this->load->model(array('wilayah_model'));
    $list_kecamatan = $this->wilayah_model->get_list_kecamatan();
    $this->load->view('page/header');
    $this->load->view('home/map_cetak', array(
     'list_kecamatan' => $list_kecamatan,
     'id_kec' => $id_kec
    ));
    $this->load->view('page/footer');
  }

  public function get_potensi_desa($id_kec = 0, $id_des = 0) {
    $this->load->model(array('potensi_model'));
    $hasil = array();
    if ($id_des == 0) {
      $hasil = $this->potensi_model->get_potensi_kec($id_kec);
    } else {
      $hasil = $this->potensi_model->get_potensi_des($id_kec, $id_des);
    }
    if (count($hasil) > 0) {
      //print_r($hasil);
      ?>
      <table class="table table-striped" style="font-size: small">
      <!--        <tr style="vertical-align: middle; text-align: center">
          <td style="vertical-align: middle">Desa</td>
          <td style="vertical-align: middle">Kode</td>
          <td style="vertical-align: middle">Persepsi Desa</td>
          <td style="vertical-align: middle">Produk Pertanian</td>
          <td style="vertical-align: middle">Produk NonPertanian</td>
        </tr>-->
        <?php
        $last_id_kec = -1;
        $nama_kecamatan = '';
        foreach ($hasil as $ptn) {
          if ($last_id_kec != $ptn['kec_no']) {
            $last_id_kec = $ptn['kec_no'];
            ?>
            <tr>
              <td colspan="5" style="text-align: center;font-weight: bold">Kecamatan <?= ucwords(strtolower($ptn['kecamatan'])) ?></td>
            <tr>
            <tr style="vertical-align: middle; text-align: center;font-weight: bold">
              <td style="vertical-align: middle">Desa</td>
              <td style="vertical-align: middle">Kode</td>
              <td style="vertical-align: middle">Persepsi Desa</td>
              <td style="vertical-align: middle">Produk Pertanian</td>
              <td style="vertical-align: middle">Produk NonPertanian</td>
            </tr>
            <?php
          }
          ?>
          <tr  style="vertical-align: middle; text-align: center">
            <td  style=" text-align: left"><?= ucwords(strtolower($ptn['desa'])) ?></td>
            <td><?= $ptn['kode'] ?></td>
            <td><?= ucwords(strtolower($ptn['persepsi_desa'])) ?></td>
            <td><?= ucwords(strtolower($ptn['produk_pertanian'])) ?></td>
            <td><?= ucwords(strtolower($ptn['produk_nonpertanian'])) ?></td>
          </tr>
          <?php
        }
        ?>
      </table>
      <?php
    } else {
      echo "";
    }
  }

  function get_list_desa($id_kec = 0) {
    $this->load->model(array('wilayah_model'));
    $list_desa = $this->wilayah_model->get_list_desa($id_kec);
    echo json_encode($list_desa);
  }

}
