<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Transaksi_model', 'transaksi');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{

		$data = array(
			'judul' => 'Transaksi',
			'data' => $this->transaksi->get(),
			'tiket' => $this->all->gettiket(),

		);
		// var_dump($data['tiket']);
		// die();
		$this->load->view('template/header');
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$tiket = htmlspecialchars($this->input->post('tiket'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$cektiket = $this->all->getidtiket($tiket);
		$harga = $jumlah * $cektiket->tarif;

		// var_dump($cektiket);
		// echo $harga;
		// die;
		$data = array(
			'idtiket' => $tiket,
			'nama' => htmlspecialchars($this->input->post('nama')),
			'alamat' => htmlspecialchars($this->input->post('alamat')),
			'nohp' => htmlspecialchars($this->input->post('nohp')),
			'harga' => $harga,
			'jumlah' => $jumlah,
			'time' => time()
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('tiket', ['tiket' => htmlspecialchars($this->input->post('tiket'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->transaksi->insert($data);
			// $this->session->set_flashdata('berhasil', 'Transaksi Berhasil Ditambah!');
			redirect('transaksi');
		} else {
			// $this->session->set_flashdata('gagal', 'Transaksi Gagal Ditambah!');
			redirect('transaksi');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->transaksi->getid($id));
	}
	public function ubah()
	{
		$tiket = htmlspecialchars($this->input->post('tiket'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$cektiket = $this->all->getidtiket($tiket);
		$harga = $jumlah * $cektiket->tarif;
		$data = array(
			'id' => htmlspecialchars($this->input->post('id')),
			'idtiket' => $tiket,
			'nama' => htmlspecialchars($this->input->post('nama')),
			'alamat' => htmlspecialchars($this->input->post('alamat')),
			'nohp' => htmlspecialchars($this->input->post('nohp')),
			'harga' => $harga,
			'jumlah' => $jumlah,
		);
		// print_r($data);
		// die;
		$this->transaksi->update(htmlspecialchars($this->input->post('id')), $data);
		$this->session->set_flashdata('berhasil', 'Transaksi Berhasil Diubah!');
		redirect('transaksi');
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->transaksi->delete($id);
		$this->session->set_flashdata('berhasil', 'Transaksi Berhasil Dihapus!');
		redirect('transaksi');
	}
	public function cetak($id)
	{
		$data = array(
			'detail' => $this->transaksi->getid($id)
		);
		// var_dump($data);
		// die;
		$this->load->view('tiket', $data);
	}
}
