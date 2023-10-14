<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }
    public function registerKaryawan()
    {

        $this->load->view('auth/register_karyawan');
    }
    public function registerAdmin()
    {

        $this->load->view('auth/register_admin');
    }


    public function aksi_login()
    {

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $data = ['email' => $email,];
        $query = $this->m_model->getwhere('user', $data);
        $result = $query->row_array();


        if (!empty($result) && md5($password) === $result['password']) {
            $data = [
                'logged_in' => TRUE,
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'],
                'id' => $result['id'],
            ];
            $this->session->set_userdata($data);
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url() . "admin/");
            } elseif ($this->session->userdata('role') == 'karyawan') {
                redirect(base_url() . "karyawan/");
            } else {
                redirect(base_url() . "admin/");
            }
        } else {
            redirect(base_url() . "auth");
        }
    }


    public function register_admin()
    {
        // Validasi form
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama_depan', 'Nama depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke halaman registrasi
            $this->load->view('auth/register_admin');
        } else {
            // Jika validasi berhasil, simpan data ke database
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $role = $this->input->post('role');
            $password = md5($this->input->post('password'));

            // Panggil model untuk menyimpan data ke database
            $this->m_model->register_admin($email, $username, $nama_depan, $nama_belakang, $role, $password);

            // Redirect ke halaman sukses atau login
            redirect('auth'); // Gantilah 'login' dengan halaman yang sesuai
        }
    }

    public function register_karyawan()
    {
        // Validasi form
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama_depan', 'Nama depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke halaman registrasi
            $this->load->view('auth/register_karyawan');
        } else {
            // Jika validasi berhasil, simpan data ke database
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $role = $this->input->post('role');
            $password = md5($this->input->post('password'));

            // Panggil model untuk menyimpan data ke database
            $this->m_model->register_karyawan($email, $username, $nama_depan, $nama_belakang, $role, $password);

            // Redirect ke halaman sukses atau login
            redirect('auth'); // Gantilah 'login' dengan halaman yang sesuai
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('/'));
    }
}