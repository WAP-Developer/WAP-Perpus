<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
  function __construct(){
	   parent::__construct();
     // cek Login
     if($this->session->userdata('status') != "login"){
       $alert=$this->session->set_flashdata('alert', 'Anda Belum Login');
       redirect(base_url());
     }
  }

  function index(){
    $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
    $data['buku'] = $this->m_perpus->get_data('buku')->result();

    $data['header'] = 'Katalog Buku';

    $this->load->view('daftarbuku', $data);
  }
}
