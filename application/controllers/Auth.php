<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends MX_Controller
{
    public function index()
    {
        $this->load->view('login');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cekuser = $this->db->get_where('user', ['username' => $username])->row_array();
        // var_dump($cekuser);
        // die();
        if ($cekuser) {
            if (password_verify($password, $cekuser['password'])) {
                if ($cekuser['idrole'] == 1) {
                    $data = array(
                        'username'  => $cekuser['username'],
                        'nama'  => $cekuser['nama'],
                        'idrole'  => $cekuser['idrole']
                        // 'idrole'  => $cekuser['idrole']
                    );
                    // var_dump($data);
                    // die;
                    $this->session->set_userdata($data);
                    redirect('admin');
                } elseif ($cekuser['idrole'] == 2) {
                    $data = [
                        'username'  => $cekuser['username'],
                        'nama'  => $cekuser['nama'],
                        'idrole'    => $cekuser['idrole']
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Password Anda Salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Username Anda Salah!');
            redirect('auth');
        }
    }

    public function registrasi()
    {
        $data = array(
            'role' => $this->db->get('role')->result()
        );
        // var_dump($data['role']);
        // die();
        $this->load->view('registrasi', $data);
    }
    public function simpanuser()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash(htmlspecialchars($this->input->post('password')), PASSWORD_DEFAULT),
            'nama'     => $this->input->post('nama'),
            'idrole'   => $this->input->post('idrole'),
            'aktif'     => $this->input->post('aktif')
        );
        $ins = $this->db->insert('user', $data);
    }

    public function keluar()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('idstatus');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success font-viga" role="alert">Anda Sudah Keluar</div>');
        redirect('auth');
    }
}
