<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pasien extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Pasien_model', 'pasien');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		$data = array(
			'judul' => 'Pasien',
			'data' => $this->pasien->get(),
			'kasus' => $this->db->get('kasus')->result(),
			'dusun' => $this->db->get('dusun')->result()
		);
		// var_dump($data['role']);
		// die();
		$this->load->view('template/header');
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'nik'     => $this->input->post('nik'),
			'nokk'     => $this->input->post('nokk'),
			'noponsel'     => $this->input->post('noponsel'),
			'email'     => $this->input->post('email'),
			'tempatlahir'     => $this->input->post('tempatlahir'),
			'tgllahir'     => $this->input->post('tgllahir'),
			'idkasus'     => $this->input->post('kasus'),
			'iddusun'   => $this->input->post('dusun'),
			// 'aktif'     => $this->input->post('aktif')
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('pasien', ['nik' => htmlspecialchars($this->input->post('nik'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->pasien->insert($data);
			$this->session->set_flashdata('berhasil', 'pasien Berhasil Ditambah!');
			redirect('pasien');
		} else {
			$this->session->set_flashdata('gagal', 'pasien Gagal Ditambah!');
			redirect('pasien');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->pasien->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idpasien' => htmlspecialchars($this->input->post('id')),
			'nama' => $this->input->post('nama'),
			'nik'     => $this->input->post('nik'),
			'nokk'     => $this->input->post('nokk'),
			'noponsel'     => $this->input->post('noponsel'),
			'email'     => $this->input->post('email'),
			'tempatlahir'     => $this->input->post('tempatlahir'),
			'tgllahir'     => $this->input->post('tgllahir'),
			'idkasus'     => $this->input->post('kasus'),
			'iddusun'   => $this->input->post('dusun'),
		);
		// print_r($data);
		// die;

		$this->pasien->update(htmlspecialchars($this->input->post('id')), $data);
		$this->session->set_flashdata('berhasil', 'pasien Berhasil Diubah!');
		redirect('pasien');
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->pasien->delete($id);
		$this->session->set_flashdata('berhasil', 'pasien Berhasil Dihapus!');
		redirect('pasien');
	}
}
