<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');

        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'karyawan') {
			redirect(base_url() . 'auth');
		}
    }

    public function index()
    {
		$data['result'] = $this->m_model->getData();
        $this->load->view('karyawan/table_karyawan', $data);
    }
}