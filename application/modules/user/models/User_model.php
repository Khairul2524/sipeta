<?php
defined('BASEPATH') or exit('No direct script access allowed');
class user_model extends CI_Model
{
    public $tabel = 'user';
    public $id  = 'iduser';
    public function get()
    {
        return  $this->db->from($this->tabel)->join('role', 'role.idrole=user.idrole')->get()->result();
    }
    public function insert($data)
    {
        $this->db->insert($this->tabel, $data);
    }
    public function getid($id)
    {
        return $this->db->get_where($this->tabel, [$this->id => $id])->row();
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
