<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tiket extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Tiket_model', 'tiket');
		$this->load->model('all_model', 'all');
	}

	public function index()
	{

		$data = array(
			'judul' => 'Tiket',
			'data' => $this->tiket->get()
		);
		// var_dump($data['data']);
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
			'tiket' => htmlspecialchars($this->input->post('tiket')),
			'tarif' => htmlspecialchars($this->input->post('harga')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('tiket', ['tiket' => htmlspecialchars($this->input->post('tiket'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->tiket->insert($data);
			$this->session->set_flashdata('berhasil', 'Tiket Berhasil Ditambah!');
			redirect('tiket');
		} else {
			$this->session->set_flashdata('gagal', 'Tiket Gagal Ditambah!');
			redirect('tiket');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->tiket->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idtiket' => htmlspecialchars($this->input->post('id')),
			'tiket' => htmlspecialchars($this->input->post('tiket')),
			'tarif' => htmlspecialchars($this->input->post('harga')),
		);

		$this->tiket->update(htmlspecialchars($this->input->post('id')), $data);
		$this->session->set_flashdata('berhasil', 'Tiket Berhasil Diubah!');
		redirect('tiket');
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->tiket->delete($id);
		$this->session->set_flashdata('berhasil', 'Tiket Berhasil Dihapus!');
		redirect('tiket');
	}
	public function rekap()
	{
		$data = array(
			'judul' => 'Rekap Tiket',
			'data' => $this->all->transaksi()
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('rekap', $data);
		$this->load->view('template/footer');
	}
}
