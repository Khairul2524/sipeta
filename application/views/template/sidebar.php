<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php
        $idrole = $this->session->userdata('idrole');
        $dimana = array(
            'idrole' => $idrole,
            'aktif' => 1
        );
        $menu = $this->db->from('aksesmenu')->join('menu', 'menu.idmenu=aksesmenu.idmenu')->where($dimana)->get()->result();
        foreach ($menu as $m) {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= site_url($m->url) ?>">
                    <i class="<?= $m->icon; ?>"></i>
                    <span><?= $m->menu; ?></span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->session->userdata('idrole') == 2) {
            $menu = $this->db->get('menu')->result();
            foreach ($menu as $m) {
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url($m->url) ?>">
                        <i class="<?= $m->icon; ?>"></i>
                        <span><?= $m->menu; ?></span>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#menu-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Menu Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="menu-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= site_url('menu') ?>">
                            <i class="bi bi-circle"></i><span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('role/hakakses') ?>">
                            <i class="bi bi-circle"></i><span>Hak Akses</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>

</aside><!-- End Sidebar-->