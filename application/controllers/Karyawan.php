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
    public function profile()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/profile', $data);
    }
    // public function menu_absen()
    // {
    //     $data['kegiatan'] = $this->m_model->get_data('absensi')->result();
    //     $this->load->view('karyawan/menu_absen', $data);
    // }
    public function menu_izin()
    {
        $data['result'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/menu_izin', $data);
    }

    public function history_absen()
    {
        $idKaryawan = $this->session->userdata('id');
        $data_karyawan = $this->m_model->getAbsensiByIdKaryawan($idKaryawan);
        $data['result'] = $data_karyawan;
        $this->load->view('karyawan/history_absen', $data);
    }


    public function menu_absen($id)
    {
        $data['kegiatan'] = $this->m_model->get_by_id('absensi', 'id', $id)->result();
        $this->load->view('karyawan/menu_absen', $data);
    }

    public function aksi_update_history_absen()
    {
        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
        ];
        $eksekusi = $this->m_model->ubah_data('absensi', $data, array('id' => $this->input->post('id')));
        if ($eksekusi) {
            $this->session->set_flashdata('sukses', 'berhasil');
            redirect(base_url('karyawan/history_absen'));
        } else {
            $this->session->set_flashdata('error', 'gagal...');
            redirect(base_url('karyawan/menu_absen/' . $this->input->post('id')));
        }
    }


    public function hapus($id)
    {
        $this->m_model->delete('absensi', 'id', $id);
        redirect(base_url('karyawan/history_absen'));
    }


    public function pulang($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data = [
            'jam_pulang' => $waktu_sekarang,
            'status' => 'done'
        ];
        $this->m_model->update('absensi', $data, array('id' => $id));
        redirect(base_url('karyawan/history_absen'));
    }



    // public function update_kegiatan($id)
    // {
    //     $data['kegiatan'] = $this->m_model->get_by_id('absensi', 'id', $id)->result();
    //     $this->load->view('karyawan/menu_absen', $data);
    // }

    // public function aksi_ubah_kegiatan()
    // {
    //     $data = array(
    //         'kegiatan' => $this->input->post('kegiatan'),
    //     );

    //     $eksekusi = $this->m_model->ubah_data
    //     ('absensi', $data, array('id' => $this->input->post('id')));
    //     if ($eksekusi) {
    //         $this->session->set_flashdata('sukses', 'berhasil menambah kegiatan');
    //         redirect(base_url('karyawan/history_absen'));
    //     } else {
    //         $this->session->set_flashdata('error', 'gagal..');
    //         redirect(base_url('karyawan/menu_absen/update_kegiatan/' . $this->input->post('id')));
    //     }
    // }
}