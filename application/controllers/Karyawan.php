<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');

        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'karyawan') {
            redirect(base_url() . 'auth');
        }
    }


    public function index()
    {
        $this->load->view('karyawan/dashboard_karyawan');
    }
    public function menu_absen()
    {
        $data['result'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/menu_absen', $data);
    }
    public function menu_izin()
    {
        $data['result'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/menu_izin', $data);
    }

    public function history_absen()
    {
        $data['result'] = $this->m_model->getData();
        $this->load->view('karyawan/history_absen', $data);
    }

    public function ubah_history_absen()
    {
        // $data['absensi'] = $this->m_model->get_by_id('absnsi', 'id', $id)->result();
        // $data['user'] = $this->m_model->get_data('user')->result();
        $this->load->view('karyawan/ubah_history_absen');
    }

    public function aksi_ubah_history_absen()
    {
        $data = array(
            'id_karyawan' => $this->input->post('nama'),
            'kegiatan' => $this->input->post('kegiatan'),
            'date' => $this->input->post('date'),
            'jam_masuk' => $this->input->post('masuk'),
            'jam_pulang' => $this->input->post('pulang'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => $this->input->post('status'),
        );

        $eksekusi = $this->m_model->ubah_data
        ('absensi', $data, array('id' => $this->input->post('id')));
        if ($eksekusi) {
            $this->session->set_flashdata('sukses', 'berhasil');
            redirect(base_url('karyawan/history_absen'));
        } else {
            $this->session->set_flashdata('error', 'gagal..');
            redirect(base_url('karyawan/history_absen/ubah_history_absen/' . $this->input->post('id')));
        }
    }


   
}