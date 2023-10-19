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

        // kondisi untuk login sesuai role
        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'karyawan') {
            redirect(base_url() . 'auth');
        }
    }

    // tampilan awal / dashoard
    public function index()
    {
        $data['absen'] = $this->m_model->get_history('absensi', $this->session->userdata('id'))->result();
        $data['total_absen'] = $this->m_model->get_absen('absensi', $this->session->userdata('id'))->num_rows();
        $data['total_izin'] = $this->m_model->get_izin('absensi', $this->session->userdata('id'))->num_rows();
        $data['total_karyawan'] = $this->m_model->get_data('user')->num_rows();

        // untuk get data karyawan yang login
        $idKaryawan = $this->session->userdata('id');
        $data_karyawan = $this->m_model->getAbsensiByIdKaryawan($idKaryawan);
        $data['result'] = $data_karyawan;
        $this->load->view('karyawan/dashboard_karyawan', $data);
    }

    // menu izin
    public function menu_izin()
    {
        $data['result'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/menu_izin', $data);
    }

    // mebu absen
    public function menu_absen()
    {
        $data['result'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/menu_absen', $data);
    }

    // menampilkan history absen
    public function history_absen()
    {
        $idKaryawan = $this->session->userdata('id');
        $data_karyawan = $this->m_model->getAbsensiByIdKaryawan($idKaryawan);
        $data['result'] = $data_karyawan;
        $this->load->view('karyawan/history_absen', $data);
    }

    // menampilkan page ubah history
    public function ubah_history_absen($id)
    {
        $data['result'] = $this->m_model->get_by_id('absensi', 'id', $id)->result();
        $this->load->view('karyawan/ubah_history_absen', $data);
    }
    public function aksi_update_history_absen()
    {
        $data = [
            'keterangan_izin' => $this->input->post('keterangan_izin'),
        ];
        $eksekusi = $this->m_model->ubah_data('absensi', $data, array('id' => $this->input->post('id')));
        if ($eksekusi) {
            $this->session->set_flashdata('sukses', 'berhasil');
            redirect(base_url('karyawan/history_absen'));
        } else {
            $this->session->set_flashdata('error', 'gagal...');
            redirect(base_url('karyawan/ubah_history_absen/' . $this->input->post('id')));
        }
    }

    // function hapus data
    public function hapus($id)
    {
        $this->m_model->delete('absensi', 'id', $id);
        redirect(base_url('karyawan/history_absen'));
    }

    // function pulang
    public function pulang($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currenttime = date('Y-m-d H:i:s');
        $data = [
            'jam_pulang' => $currenttime,
            'status' => 'done'
        ];
        $this->m_model->ubah_data('absensi', $data, array('id' => $id));
        redirect(base_url('karyawan/history_absen'));
    }

    public function aksi_absen()
    {
        $tanggal = date('Y-m-d');
        $query_absen = $this->m_model->get_absen_by_tanggal($tanggal, $this->session->userdata('id'));
        $validasi_absen = $query_absen->num_rows();
        $query_izin = $this->m_model->get_izin_by_tanggal($tanggal, $this->session->userdata('id'));
        $validasi_izin = $query_izin->num_rows();
        if ($validasi_absen > 0) {
            $this->session->set_flashdata('error', 'error ');
            redirect(base_url('karyawan/menu_absen'));
        } else if ($validasi_izin > 0) {
            date_default_timezone_set('Asia/Jakarta');
            $currenttime = date('H:i:s');
            $data = [
                'kegiatan' => $this->input->post('kegiatan'),
                'id_kayawan' => $this->session->userdata('id'),
                'jam_pulang' => NULL,
                'jam_masuk' => $currenttime,
                // Mengatur "jam_masuk" ke waktu saat ini
                'date' => $tanggal,
                // Mengatur "date" ke tanggal saat ini
                'keterangan_izin' => '-',
                'status' => 'not'
            ];
            $query = $this->m_model->get_izin_by_tanggal($tanggal, $this->session->userdata('id'));
            $id = $query->row_array();
            $this->m_model->ubah_data('absensi', $data, array('id' => $id['id']));
            $this->m_model->add('absensi', $data);
            redirect(base_url('karyawan/history_absen'));
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $currenttime = date('Y-m-d H:i:s');
            $data = [
                'kegiatan' => $this->input->post('kegiatan'),
                'id_kayawan' => $this->session->userdata('id'),
                'jam_pulang' => NULL,
                'jam_masuk' => $currenttime,
                // Mengatur "jam_masuk" ke waktu saat ini
                'date' => $tanggal,
                // Mengatur "date" ke tanggal saat ini
                'keterangan_izin' => '-',
                'status' => 'not'
            ];

            $this->m_model->add('absensi', $data);
            redirect(base_url('karyawan/history_absen'));
        }
    }
    public function aksi_izin()
    {
        $tanggal = date('Y-m-d');
        $query_absen = $this->m_model->get_absen_by_tanggal($tanggal, $this->session->userdata('id'));
        $validasi_absen = $query_absen->num_rows();
        $query_izin = $this->m_model->get_izin_by_tanggal($tanggal, $this->session->userdata('id'));
        $validasi_izin = $query_izin->num_rows();
        if ($validasi_izin > 0) {
            $this->session->set_flashdata('error', 'error ');
            redirect(base_url('karyawan/menu_izin'));
        } else if ($validasi_absen > 0) {
            date_default_timezone_set('Asia/Jakarta');
            $currenttime = date('Y-m-d H:i:s');
            $data = [
                'kegiatan' => '-',
                'id_kayawan' => $this->session->userdata('id'),
                'jam_pulang' => NULL,
                'jam_masuk' => NULL,
                'date' => date('Y-m-d'),
                'keterangan_izin' => $this->input->post('izin'),
                'status' => 'done'
            ];
            $query = $this->m_model->get_absen_by_tanggal($tanggal, $this->session->userdata('id'));
            $id = $query->row_array();
            $this->m_model->ubah_data('absensi', $data, array('id' => $id['id']));
            $this->m_model->add('absensi', $data);
            redirect(base_url('karyawan/history_absen'));
        } else {
            $data = [
                'kegiatan' => '-',
                'id_kayawan' => $this->session->userdata('id'),
                'jam_pulang' => NULL,
                'jam_masuk' => NULL,
                'date' => date('Y-m-d'),
                'keterangan_izin' => $this->input->post('izin'),
                'status' => 'done'
            ];

            $this->m_model->add('absensi', $data);
            redirect(base_url('karyawan/history_absen'));
        }
    }

    // ubah profile
    public function profile()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/profile', $data);
    }
    public function ubah_foto()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/ubah_foto', $data);
    }

    public function ubah_profile()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/ubah_profile', $data);
    }

    // ubah password
    public function aksi_ubah_profile()
    {

        $data = [
            "username" => $this->input->post('username'),
            "email" => $this->input->post('email'),
            "nama_depan" => $this->input->post('nama_depan'),
            "nama_belakang" => $this->input->post('nama_belakang'),
        ];

        $user_id = $this->session->userdata('id');

        $eksekusi = $this->m_model->ubah_data('user', $data, array('id' => $user_id));

        if ($eksekusi) {
            $this->session->set_flashdata('berhasil_edit_profile', 'Berhasil untuk mengedit profile');
            $this->session->set_userdata($data);
            redirect(base_url('karyawan/ubah_profile'));
        } else {
            $this->session->set_flashdata('gagal_edit_profile', 'Gagal untuk mengedit profile');
            redirect(base_url('karyawan/ubah_profile'));
        }

    }

    public function aksi_ubah_foto()
    {
        $image = $this->upload_img('image');

        $image = $this->upload_img('image');
        if ($image[0] == false) {
            $data = [
                'image' => 'user.png',

            ];
        } else {
            $data = [
                'image' => $image[1],

            ];
        }

        // lakukan pembaruan data
        $this->session->set_userdata($data);
        $update_result = $this->m_model->ubah_data('user', $data, array('id' => $this->session->userdata('id')));

        if ($update_result) {
            redirect(base_url('karyawan/ubah_foto'));
        } else {
            redirect(base_url('karyawan/ubah_foto'));
        }
    }
    public function aksi_ubah_password()
    {
        $password_lama = $this->input->post('password_lama', true);

        $user = $this->m_model->getWhere('user', ['id' => $this->session->userdata('id')])->row_array();

        if (md5($password_lama) === $user['password']) {
            $password_baru = $this->input->post('password_baru', true);
            $konfirmasi_password = $this->input->post('konfirmasi_password', true);

            // Pastikan password baru dan konfirmasi password sama
            if ($password_baru === $konfirmasi_password) {
                // Update password baru ke dalam database
                $data = ['password' => md5($password_baru)];
                $this->m_model->ubah_data('user', $data, ['id' => $this->session->userdata('id')]);

                $this->session->set_flashdata('berhasil_ganti_password', 'Password berhasil diubah');
                redirect(base_url('karyawan/profile'));
            } else {
                $this->session->set_flashdata('konfirmasi_pass', 'Password baru dan konfirmasi password harus sama');
                redirect(base_url('karyawan/profile'));
            }
        } else {
            $this->session->set_flashdata('pass_lama', 'Pastikan anda mengisi password lama anda dengan benar');
            redirect(base_url('karyawan/profile'));
        }
        redirect(base_url('karyawan/profile'));
    }

    // untuk upload image
    public function upload_img($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/karyawan';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '30000';
        $config['file_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return array(false, '');
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return array(true, $nama);
        }
    }
}