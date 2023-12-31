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

    // function delete
    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }
    function delete_relasi($id)
    {
        $data = $this->db->where('id_kayawan', $id);
        $data = $this->db->delete('absensi');
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

    // functin register admin
    public function register_admin($email, $username, $nama_depan, $nama_belakang, $role, $image, $password)
    {
        $data = array(
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'role' => $role,
            'image' => 'userr.png',
            'password' => $password
        );

        // Simpan data ke dalam tabel pengguna (ganti 'users' sesuai dengan nama tabel Anda)
        $this->db->insert('user', $data);
    }

    // function register karyawan
    public function register_karyawan($email, $username, $nama_depan, $nama_belakang, $role, $image, $password)
    {
        $data = array(
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'role' => $role,
            'image' => 'user.png',
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

    // function Ubah
    public function ubah_data($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }

    // untuk get by id
    public function get_user_by_id($user_id)
    {
        $this->db->where('id', $user_id);
        return $this->db->get('users')->row();
    }


    public function getAbsensiByIdKaryawan($idKaryawan)
    {
        $this->db->select('absensi.*, user.nama_depan, user.nama_belakang');
        $this->db->where('absensi.id_kayawan', $idKaryawan);
        $this->db->join('user', 'user.id = absensi.id_kayawan', 'left');
        $query = $this->db->get('absensi');
        return $query->result();
    }

    // menampilkan total data absen di dashboard
    public function get_absen($table, $id_karyawan)
    {
        return $this->db->where('id_kayawan', $id_karyawan)
            ->where('keterangan_izin', '-')
            ->get($table);
    }

    // menampilkan total data izin di dashboard
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

    // function tambah
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

    // rekap harian
    public function getDailyData($date)
    {
        $this->db->select('absensi.*, user.nama_depan, user.nama_belakang');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_kayawan = user.id', 'left');
        $this->db->where('date', $date);
        $query = $this->db->get();
        return $query->result();
    }

    // rekap mingguan
    public function getAbsensiLast7Days()
    {
        $this->load->database();
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-7 days', strtotime($end_date)));
        // $query = $this->db->select('kegiatan ,date , jam_masuk, jam_pulang, keterangan_izin, status, COUNT(*) AS total_absences')
        $query = $this->db->select('absensi.*,user.nama_depan, user.nama_belakang, COUNT(*) AS total_absences')
            ->from('absensi')
            ->join('user', 'absensi.id_kayawan = user.id', 'left')
            ->where('date >=', $start_date)
            ->where('date <=', $end_date)
            ->group_by('kegiatan ,date , jam_masuk, jam_pulang, keterangan_izin, status')
            ->get();
        return $query->result_array();
    }

    // rekap bulanan
    public function getAbsensiMonth($bulan)
    {
        $this->db->select('absensi.*,user.nama_depan, user.nama_belakang');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_kayawan = user.id', 'left');
        $this->db->where("DATE_FORMAT(date, '%m') =", $bulan);
        $query = $this->db->get();
        return $query->result();
    }
}