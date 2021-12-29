<?php
function login()
{
    $ci = get_instance();
    $role = $ci->session->userdata('idrole');
    if (!$role) {
        redirect('auth');
    } else {
        $url = $ci->uri->segment(1);
        $querymenu = $ci->db->get_where('menu', ['url' => $url])->row();
        $menuid = $querymenu->idmenu;
        $queryakses = $ci->db->get_where('aksesmenu', ['idmenu' => $menuid, 'idrole' => $role])->row();
        // var_dump($queryakses);
        // die;
        if (!$queryakses) {
            if ($role != 2) {
                redirect('admin/notpound');
            }
        }
    }
}
// hak akses menu
function hakaksesmenu($roleid, $menuid)
{
    $ci = get_instance();
    $hakakses = $ci->db->get_where('aksesmenu', ['idmenu' => $menuid, 'idrole' => $roleid])->row();
    // var_dump($hakakses);
    if ($hakakses) {
        return 'checked="checked"';
    }
}
