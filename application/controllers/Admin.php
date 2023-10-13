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
        // $this->load->helper('my_helper');

        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'admin') {
			redirect(base_url() . 'auth');
		}
    }

    // public function index()
    // {
    //     $this->load->view('admin/absensi');
    // }

    public function index()
    {
		// $data['absen'] = $this->m_model->get_history('absensi', $this->session->userdata('id'))->result();
		$data['total_karyawan'] = $this->m_model->get_data('user')->num_rows();
		$data['result'] = $this->m_model->getData();
        $this->load->view('admin/absensi', $data);
    }

    // public function export_data_karyawan()
	// {

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

	// 	$style_col = [
	// 		'font' => ['bold' => true],
	// 		'alignment' => [
	// 			'horizontal' => \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
	// 			'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
	// 		],
	// 		'borders' => [
	// 			'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
	// 		]
	// 	];

	// 	$style_row = [
	// 		'alignment' => [
	// 			'vertical' => \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER
	// 		],
	// 		'borders' => [
	// 			'top' => ['borderstyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN],
	// 			'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN]
	// 		]
	// 	];

	// 	// set judul
	// 	$sheet->setCellValue('A1', "DATA KARYAWAN");
	// 	$sheet->mergeCells('A1:E1');
	// 	$sheet->getStyle('A1')->getFont()->setBold(true);

	// 	// set thead
	// 	$sheet->setCellValue('A3', "ID");
	// 	$sheet->setCellValue('B3', "NAMA KARYAWAN");
	// 	$sheet->setCellValue('C3', "EMAIL");
	// 	$sheet->setCellValue('D3', "NAMA DEPAN");
	// 	$sheet->setCellValue('E3', "NAMA BELAKANG");
	// 	// $sheet->setCellValue('F3', "IMAGE");

	// 	// mengaplikasikan style thead
	// 	$sheet->getStyle('A3')->applyFromArray($style_col);
	// 	$sheet->getStyle('B3')->applyFromArray($style_col);
	// 	$sheet->getStyle('C3')->applyFromArray($style_col);
	// 	$sheet->getStyle('D3')->applyFromArray($style_col);
	// 	$sheet->getStyle('E3')->applyFromArray($style_col);
	// 	// $sheet->getStyle('F3')->applyFromArray($style_col);

	// 	// get dari database
	// 	$data_karyawan = $this->m_model->get_data();

	// 	$no = 1;
	// 	$numrow = 4;
	// 	foreach ($data_karyawan as $data) {
	// 		$sheet->setCellValue('A' . $numrow, $data->id);
	// 		$sheet->setCellValue('B' . $numrow, $data->username);
	// 		$sheet->setCellValue('C' . $numrow, $data->email);
	// 		$sheet->setCellValue('D' . $numrow, $data->nama_depan);
	// 		$sheet->setCellValue('E' . $numrow, $data->nama_belakang);
	// 		// $sheet->setCellValue('F' . $numrow, $data->image);

	// 		$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
	// 		$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
	// 		$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
	// 		$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
	// 		$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
	// 		// $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

	// 		$no++;
	// 		$numrow++;
	// 	}


	// 	// set panjang column
	// 	$sheet->getColumnDimension('A')->setWidth(5);
	// 	$sheet->getColumnDimension('B')->setWidth(25);
	// 	$sheet->getColumnDimension('C')->setWidth(25);
	// 	$sheet->getColumnDimension('D')->setWidth(20);
	// 	$sheet->getColumnDimension('E')->setWidth(30);
	// 	// $sheet->getColumnDimension('F')->setWidth(30);

	// 	$sheet->getDefaultRowDimension()->setRowHeight(-1);

	// 	$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

	// 	// set nama file saat di export
	// 	$sheet->setTitle("LAPORAN DATA KARYAWAN");
	// 	header('Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment; filename="KARYAWAN.xlsx"');
	// 	header('Cache-Control: max-age=0');

	// 	$writer = new Xlsx($spreadsheet);
	// 	$writer->save('php://output');

	// }

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

        // mengaplikasikan style thead
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);

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

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        // set panjang column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);

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

	public function dailyHistory() {
        $data['dailyHistory'] = $this->HistoryModel->getDailyHistory();
        $this->load->view('daily_history_view', $data);
    }

    public function weeklyHistory() {
        $data['weeklyHistory'] = $this->HistoryModel->getWeeklyHistory();
        $this->load->view('weekly_history_view', $data);
    }

    public function monthlyHistory() {
        $data['monthlyHistory'] = $this->HistoryModel->getMonthlyHistory();
        $this->load->view('monthly_history_view', $data);
    }
}