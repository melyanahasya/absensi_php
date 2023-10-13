<?php

class M_model extends CI_Model
{
    function get_data($table)
    {
        return $this->db->get($table);
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function index()
    {
        $this->load->view('login');
    }

    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    public function getData()
    {
        $this->db->select('absensi.*,user.nama_depan, user.nama_belakang');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_kayawan = user.id', 'left');
        // Query database untuk mengambil data
        $query = $this->db->get();
        return $query->result();
    }


    public function register_admin($email, $username, $nama_depan, $nama_belakang, $role, $password)
    {
        $data = array(
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'role' => $role,
            'password' => $password
        );

        // Simpan data ke dalam tabel pengguna (ganti 'users' sesuai dengan nama tabel Anda)
        $this->db->insert('user', $data);
    }

    public function register_karyawan($email, $username, $nama_depan, $nama_belakang, $role, $password)
    {
        $data = array(
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'role' => $role,
            'password' => $password
        );

        // Simpan data ke dalam tabel pengguna (ganti 'users' sesuai dengan nama tabel Anda)
        $this->db->insert('user', $data);
    }


    // 1. get id untuk Ubah
    public function get_by_id($tabel, $id_column, $id)
    {
        $data = $this->db->where($id_column, $id)->get($tabel);
        return $data;
    }

    // Ubah
    public function ubah_data($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }


    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get('users')->row();
    }


    public function getAbsensiByIdKaryawan($idKaryawan) {
        $this->db->select('absensi.*, user.nama_depan, user.nama_belakang');
        $this->db->where('absensi.id_kayawan', $idKaryawan);
        $this->db->join('user', 'user.id = absensi.id_kayawan', 'left');
        $query = $this->db->get('absensi');
        return $query->result();
    }

    // menampilkan jumlah absen di dashboard
    public function get_absen($table, $id_karyawan)
    {
    return $this->db->where('id_kayawan', $id_karyawan)
                    ->where('keterangan_izin', '-')
                    ->get($table);
    }
    public function get_izin($table, $id_karyawan)
    {
    return $this->db->where('id_kayawan', $id_karyawan)
                    ->where('kegiatan', '-')
                    ->get($table);
    }

    public function get_history($table, $id_karyawan)
    {
        return $this->db->where('id_kayawan', $id_karyawan)->get($table);
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function tambah_izin($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function get_absen_by_tanggal($tanggal, $id_karyawan)
    {
    return $this->db->where('id_kayawan', $id_karyawan)
                    ->where('date', $tanggal)
                    ->where('keterangan_izin', '-')
                    ->where('status', 'not')
                    ->get('absensi');
    }
    public function get_izin_by_tanggal($tanggal, $id_karyawan)
    {
    return $this->db->where('id_kayawan', $id_karyawan)
                    ->where('date', $tanggal)
                    ->where('kegiatan', '-')
                    ->get('absensi');
    }



    public function getDailyHistory() {
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
        return $this->db->get('absensi')->result();
    }

    public function getWeeklyHistory() {
        $startOfWeek = date('Y-m-d', strtotime('last sunday'));
        $endOfWeek = date('Y-m-d', strtotime('next saturday'));
        $this->db->where('tanggal >=', $startOfWeek);
        $this->db->where('tanggal <=', $endOfWeek);
        return $this->db->get('absensi')->result();
    }

    public function getMonthlyHistory() {
        $this->db->where('MONTH(tanggal)', date('m'));
        return $this->db->get('absensi')->result();
    }
}