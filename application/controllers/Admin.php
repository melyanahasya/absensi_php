<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');

        // kondisi untuk login sesuai role
        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'admin') {
            redirect(base_url() . 'auth');
        }
    }

    // tampilan awal 
    public function index()
    {
        $data['total_karyawan'] = $this->m_model->get_data('user')->num_rows();
        $data['result'] = $this->m_model->get_data('user')->result();
        $this->load->view('admin/absensi', $data);
    }

    public function rekap_data_keseluruhan()
    {
        $data['result'] = $this->m_model->getData();
        $this->load->view('admin/rekap_data', $data);
    }

    // export data karyawan
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
            ]
        ];

        // set judul
        $sheet->setCellValue('A1', "DATA KARYAWAN");
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        // set thead
        $sheet->setCellValue('A3', "ID");
        $sheet->setCellValue('B3', "USERNAME");
        $sheet->setCellValue('C3', "EMAIL");
        $sheet->setCellValue('D3', "NAMA DEPAN");
        $sheet->setCellValue('E3', "NAMA BELAKANG");
        $sheet->setCellValue('F3', "IMAGE");

        // mengaplikasikan style thead
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        // get dari database
        $data_karyawan = $this->m_model->get_data('user')->result();

        $no = 1;
        $numrow = 4;
        foreach ($data_karyawan as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->username);
            $sheet->setCellValue('C' . $numrow, $data->email);
            $sheet->setCellValue('D' . $numrow, $data->nama_depan);
            $sheet->setCellValue('E' . $numrow, $data->nama_belakang);
            $sheet->setCellValue('F' . $numrow, $data->image);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        // set panjang column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // set nama file saat di export
        $sheet->setTitle("LAPORAN DATA KARYAWAN");
        header('Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="KARYAWAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }


    // rekap harian
    public function rekap_harian()
    {
        $tanggal = date('Y-m-d');
        $data['absensi'] = $this->m_model->getDailyData($tanggal);
        $this->load->view('admin/rekap_harian', $data);
    }

    // rekap mingguan
    public function rekap_mingguan()
    {
        $data['absensi'] = $this->m_model->getAbsensiLast7Days();
        $this->load->view('admin/rekap_mingguan', $data);
    }

    // rekap bulanan
    public function rekap_bulanan()
    {
        $bulan = $this->input->post('bulan');
        $data['absensi'] = $this->m_model->getAbsensiMonth($bulan);
        $this->load->view('admin/rekap_bulanan', $data);
    }

    // export rekap keseluruhan
    public function export_keseluruhan()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
            ]
        ];

        // set judul
        $sheet->setCellValue('A1', "DATA KARYAWAN");
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        // set thead
        $sheet->setCellValue('A3', "ID");
        $sheet->setCellValue('B3', "NAMA KARYAWAN");
        $sheet->setCellValue('C3', "KEGIATAN");
        $sheet->setCellValue('D3', "DATE");
        $sheet->setCellValue('E3', "JAM MASUK");
        $sheet->setCellValue('F3', "JAM PULANG");
        $sheet->setCellValue('G3', "KETERANGAN IZIN");

        // mengaplikasikan style thead
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // get dari database
        $rekap_keseluruhan = $this->m_model->getData();

        $no = 1;
        $numrow = 4;
        foreach ($rekap_keseluruhan as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->nama_depan . ' ' . $data->nama_belakang);
            $sheet->setCellValue('C' . $numrow, $data->kegiatan);
            $sheet->setCellValue('D' . $numrow, $data->date);
            $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        // set panjang column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // set nama file saat di export
        $sheet->setTitle("REKAP DATA KESELURUHAN");
        header('Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="REKAP_KESELURUHAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }


    // export harian
    public function export_harian()
    {
        $date = date('Y-m-d');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        if (!empty($date)) {
            $style_col = [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
                ]
            ];

            $style_row = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
                ]
            ];

            // set judul
            $sheet->setCellValue('A1', "REKAP DATA HARIAN");
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true);
            // set thead
            $sheet->setCellValue('A3', "ID");
            $sheet->setCellValue('B3', "NAMA KARYAWAN");
            $sheet->setCellValue('C3', "KEGIATAN");
            $sheet->setCellValue('D3', "DATE");
            $sheet->setCellValue('E3', "JAM MASUK");
            $sheet->setCellValue('F3', "JAM PULANG");
            $sheet->setCellValue('G3', "KETERANGAN IZIN");

            // mengaplikasikan style thead
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);
            $sheet->getStyle('F3')->applyFromArray($style_col);
            $sheet->getStyle('G3')->applyFromArray($style_col);

            // get dari database
            $data_harian = $this->m_model->getDailyData($date);

            $no = 1;
            $numrow = 4;
            foreach ($data_harian as $data) {
                $sheet->setCellValue('A' . $numrow, $data->id);
                $sheet->setCellValue('B' . $numrow, $data->nama_depan . ' ' . $data->nama_belakang);
                $sheet->setCellValue('C' . $numrow, $data->kegiatan);
                $sheet->setCellValue('D' . $numrow, $data->date);
                $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
                $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
                $sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            // set panjang column
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(30);

            $sheet->getDefaultRowDimension()->setRowHeight(-1);

            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

            // set nama file saat di export
            $sheet->setTitle("LAPORAN REKAP DATA HARIAN");
            header('Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="REKAP_HARIAN.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }


    }

    // export mingguan
    public function export_mingguan()
    {
        $tanggal_akhir = date('Y-m-d');
        $tanggal_awal = date('Y-m-d', strtotime('-7 days', strtotime($tanggal_akhir)));
        $tanggal_awal = date('W', strtotime($tanggal_awal));
        $tanggal_akhir = date('W', strtotime($tanggal_akhir));
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        if (!empty($tanggal_awal && $tanggal_akhir)) {
            $style_col = [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
                ]
            ];

            $style_row = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
                ]
            ];

            // set judul
            $sheet->setCellValue('A1', "REKAP DATA MINGGUAN");
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true);
            // set thead
            $sheet->setCellValue('A3', "NO");
            $sheet->setCellValue('B3', "NAMA KARYAWAN");
            $sheet->setCellValue('C3', "KEGIATAN");
            $sheet->setCellValue('D3', "DATE");
            $sheet->setCellValue('E3', "JAM MASUK");
            $sheet->setCellValue('F3', "JAM PULANG");
            $sheet->setCellValue('G3', "KETERANGAN IZIN");

            // mengaplikasikan style thead
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);
            $sheet->getStyle('F3')->applyFromArray($style_col);
            $sheet->getStyle('G3')->applyFromArray($style_col);

            // get dari database
            $data_mingguan = $this->m_model->getAbsensiLast7Days($tanggal_awal, $tanggal_akhir);

            $no = 1;
            $numrow = 4;
            foreach ($data_mingguan as $data) {
                $sheet->setCellValue('A' . $numrow, $data['id']);
                $sheet->setCellValue('B' . $numrow, $data['nama_depan'] . ' ' . $data['nama_belakang']);
                $sheet->setCellValue('C' . $numrow, $data['kegiatan']);
                $sheet->setCellValue('D' . $numrow, $data['date']);
                $sheet->setCellValue('E' . $numrow, $data['jam_masuk']);
                $sheet->setCellValue('F' . $numrow, $data['jam_pulang']);
                $sheet->setCellValue('G' . $numrow, $data['keterangan_izin']);

                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            // set panjang column
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(30);

            $sheet->getDefaultRowDimension()->setRowHeight(-1);

            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

            // set nama file saat di export
            $sheet->setTitle("LAPORAN REKAP DATA MINGGUAN");
            header('Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="REKAP_MINGGUAN.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }


    }

    // export bulanan
    public function export_bulanan()
    {
        $bulan = $this->input->post('bulan');
        require_once FCPATH . 'vendor/autoload.php';
        // date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ]
        ];

        $sheet->setCellValue('A1', "REKAP DATA BULANAN ($date)");
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        $sheet->setCellValue('A3', "NO");
        $sheet->setCellValue('B3', "NAMA KARYAWAN");
        $sheet->setCellValue('C3', "DATE");
        $sheet->setCellValue('D3', "JAM MASUK");
        $sheet->setCellValue('E3', "JAM PULANG");
        $sheet->setCellValue('F3', "KETERANGAN IZIN");

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        // $where = ['MONTH(date)' => $date];
        $absensi = $this->m_model->getAbsensiMonth($bulan);

        $no = 1;
        $numrow = 4;

        foreach ($absensi as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->nama_depan . ' ' . $data->nama_belakang);
            $sheet->setCellValue('C' . $numrow, $data->date);
            $sheet->setCellValue('D' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $data->keterangan_izin);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);

        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $sheet->setTitle('REKAP BULANAN');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="REKAP_BULANAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // ubah profile
    public function profile()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('admin/profile', $data);
    }
    public function ubah_foto()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('admin/ubah_foto', $data);
    }

    public function ubah_profile()
    {
        $data['user'] = $this->m_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('admin/ubah_profile', $data);
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
            redirect(base_url('admin/ubah_profile'));
        } else {
            $this->session->set_flashdata('gagal_edit_profile', 'Gagal untuk mengedit profile');
            redirect(base_url('admin/ubah_profile'));
        }

    }

    public function aksi_ubah_foto()
    {
        $image = $this->upload_img('image');

        $image = $this->upload_img('image');
        if ($image[0] == false) {
            $data = [
                'image' => 'userr.png',

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
            redirect(base_url('admin/ubah_foto'));
        } else {
            redirect(base_url('admin/ubah_foto'));
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
                redirect(base_url('admin/profile'));
            } else {
                $this->session->set_flashdata('konfirmasi_pass', 'Password baru dan konfirmasi password harus sama');
                redirect(base_url('admin/profile'));
            }
        } else {
            $this->session->set_flashdata('pass_lama', 'Pastikan anda mengisi password lama anda dengan benar');
            redirect(base_url('admin/profile'));
        }
        redirect(base_url('admin/profile'));
    }

    // untuk upload image
    public function upload_img($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/admin';
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