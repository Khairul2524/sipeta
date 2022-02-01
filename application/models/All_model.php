<?php
defined('BASEPATH') or exit('No direct script access allowed');
class All_model extends CI_Model
{
    public function getstatus()
    {
        return  $this->db->get('status')->result();
    }
    public function getkasus()
    {
        return  $this->db->get('kasus')->result();
    }
    public function getdusun()
    {
        return  $this->db->get('dusun')->result();
    }

    public function getidrole($id)
    {
        return $this->db->get_where('role', ['idrole' => $id])->row();
    }
    public function getmenu()
    {
        return  $this->db->get('menu')->result();
    }
    public function inserthakakses($data)
    {
        return  $this->db->insert('aksesmenu', $data);
    }

    public function deleteakses($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('aksesmenu');
    }
    public function transaksi()
    {
        return  $this->db->from('transaksi')->join('tiket', 'tiket.idtiket=transaksi.idtiket')->order_by('id', 'DESC')->get()->result();
    }
}
