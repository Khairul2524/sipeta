<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends MX_Controller
{
    public function index()
    {
        $this->load->view('welcome');
    }
}
