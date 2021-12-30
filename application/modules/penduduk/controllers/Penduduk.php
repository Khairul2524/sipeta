<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Penduduk_model', 'penduduk');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		// $id = $this->session->userdata('idpenduduk');
		$data = array(
			'judul' => 'penduduk',
			'data' => $this->penduduk->get(),
			// 'penduduk' => $this->all->getidpenduduk($id)
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
			'penduduk' => htmlspecialchars($this->input->post('penduduk')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('penduduk', ['penduduk' => htmlspecialchars($this->input->post('penduduk'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->penduduk->insert($data);
			$this->session->set_flashdata('berhasil', 'penduduk Berhasil Ditambah!');
			redirect('penduduk');
		} else {
			$this->session->set_flashdata('gagal', 'penduduk Gagal Ditambah!');
			redirect('penduduk');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->penduduk->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idpenduduk' => htmlspecialchars($this->input->post('id')),
			'penduduk' => htmlspecialchars($this->input->post('penduduk')),
		);
		$cek = $this->db->get_where('penduduk', ['penduduk' => htmlspecialchars($this->input->post('penduduk'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->penduduk->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'penduduk Berhasil Diubah!');
			redirect('penduduk');
		} else {
			$this->session->set_flashdata('gagal', 'penduduk Gagal Diubah!');
			redirect('penduduk');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->penduduk->delete($id);
		$this->session->set_flashdata('berhasil', 'penduduk Berhasil Dihapus!');
		redirect('penduduk');
	}
}
