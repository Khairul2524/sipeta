<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pasien_model extends CI_Model
{
    public $tabel = 'pasien';
    public $id  = 'idpasien';
    public function get()
    {
        return  $this->db->from($this->tabel)->join('kasus', 'kasus.idkasus=pasien.idkasus')->join('dusun', 'dusun.iddusun=pasien.iddusun')->get()->result();
    }
    public function insert($data)
    {
        $this->db->insert($this->tabel, $data);
        $id = $this->db->insert_id();
        $datar = array(
            'idpasien' => $id,
            'idstatus' => $this->input->post('status'),
            'time'     => time()
        );
        $this->db->insert('riwayat', $datar);
    }
    public function getid($id)
    {
        return $this->db->from($this->tabel)->join('kasus', 'kasus.idkasus=pasien.idkasus')->join('status', 'status.idstatus=pasien.idstatus')->join('dusun', 'dusun.iddusun=pasien.iddusun')->where(['idpasien' => $id])->get()->row();
    }
    public function update($id, $data)
    {
        $cek = $this->db->get_where('riwayat', ['idpasien' => $id, 'idstatus' => $this->input->post('status')])->row();
        if (!$cek) {
            $datar = array(
                'idpasien' => $id,
                'idstatus' => $this->input->post('status'),
                'time'     => time()
            );
            $this->db->insert('riwayat', $datar);
        }
        $this->db->where($this->id, $id);
        $this->db->update($this->tabel, $data);
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->tabel);
    }
}
