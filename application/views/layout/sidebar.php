<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href=" <?= base_url() ?> " class="site_title"><i class="fa fa-map"></i> <span>SimenaraOKU</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img style="padding: 3px; width: 80%;" src="<?= template('gambarforsite/logoDiskominfo.png') ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span><?= $this->session->userdata('nm_tipe'); ?></span>
                <h2><?= $this->session->userdata('name'); ?></h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <hr>
                <ul class="nav side-menu">

                    <?php
                    $tipe = $this->session->userdata('tipe');
                    $akses = $this->db->get_where('tb_access', array('kode_role' => $tipe))->result();
                    foreach ($akses as $aks) {
                    ?>
                        <!-- akun admin sistem -->
                        <?php if ($aks->akses == 'beranda') { ?>
                            <li>
                                <a href="<?= site_url('operator') ?>"><i class="fa fa-home"></i> Beranda</a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <li><a><i class="fa fa-users"></i> Data Pengguna<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php foreach ($akses as $aks) { ?>
                                <?php if ($aks->akses == 'pegawai') { ?>
                                    <li><a href="<?= site_url('pegawai') ?>">Pegawai</a></li>
                                <?php } ?>
                                <?php if ($aks->akses == 'role') { ?>
                                    <li><a href="<?= site_url('role') ?>">Role Pegawai</a></li>
                            <?php }
                            } ?>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-folder"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php foreach ($akses as $aks) { ?>
                                <?php if ($aks->akses == 'atribut') { ?>
                                    <li><a href="<?= site_url('atribut') ?>">Atribut Peta</a></li>
                                <?php } ?>
                                <?php if ($aks->akses == 'kecamatan') { ?>
                                    <li><a href="<?= site_url('kecamatan') ?>">Kecamatan</a></li>
                                <?php } ?>
                                <?php if ($aks->akses == 'provider') { ?>
                                    <li><a href="<?= site_url('provider') ?>">Provider</a></li>
                                <?php } ?>
                                <?php if ($aks->akses == 'menara') { ?>
                                    <li><a href="<?= site_url('menara') ?>">Menara Eksisting</a></li>
                            <?php }
                            } ?>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-tags"></i> Master Planning <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php foreach ($akses as $aks) { ?>
                                <?php if ($aks->akses == 'zona') { ?>
                                    <li><a href="<?= site_url('zona') ?>">Cell Zone</a></li>
                            <?php }
                            } ?>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-map"></i> Map GIS <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php foreach ($akses as $aks) { ?>
                                <?php if ($aks->akses == 'map') { ?>
                                    <li><a href="<?= site_url('map') ?>">Peta Menara</a></li>
                                <?php } ?>
                                <?php if ($aks->akses == 'findmap') { ?>
                                    <li><a href="<?= site_url('map/findmap') ?>">Cek Koordinat</a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </li>
                    <hr>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= site_url('admin_auth/logout') ?>" onclick="return confirm('apakah anda ingin Logout  ??????')">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= template('gambarforsite/logoDiskominfo.png') ?>" alt=""><?= $this->session->userdata('name'); ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile (segera hadir)</a>

                        <a class="dropdown-item" href="<?= site_url('admin_auth/logout') ?>" onclick="return confirm('apakah anda ingin Logout  ??????')"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">1</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?= template('gambarforsite/logoDiskominfo.png') ?>" alt="Profile Image" /></span>
                                <span>
                                    <span>Admin</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    nantikan fitur notifikasi dari kami,(segera hadir)
                                </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>