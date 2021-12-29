<?php
defined('BASEPATH') or exit('No direct script access allowed');
class All_model extends CI_Model
{
    public function gettiket()
    {
        return  $this->db->get('tiket')->result();
    }
    public function getidtiket($id)
    {
        return $this->db->get_where('tiket', ['idtiket' => $id])->row();
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
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->tabel, $data);
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->tabel);
    }
}
