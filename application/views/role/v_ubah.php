<?= content_open($title, $subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Panel Ubah Role Access</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <form class="user" method="post" action="<?= site_url($url) ?>/add_acc/<?= $datatabel->kode_role ?>">

                <div class="form-group row">
                    <label for="kode_role" class="col-sm-2 col-form-label">Kode Role</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_role" name="kode_role" value="<?= $datatabel->kode_role ?>" readonly required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_role" class="col-sm-2 col-form-label">Akses Yang Dimiliki</label>
                    <div class="col-sm-10">
                        <?php foreach ($datatabel1 as $key) { ?>
                            <div class="col-sm-4">
                                <input type="text" class="form-control col-sm-8" value="<?= $key->akses . ' (' . $key->hak . ')' ?>" readonly>
                                <a href="<?= site_url($url . '/del_acc?role=' . $datatabel->kode_role . '&acc=' . $key->kode_access) ?>" class='btn btn-danger'> X </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="form-group row">
                    <label for="akses" class="col-sm-2 col-form-label">Tambah Hak Akses</label>
                    <div class="col-sm-10">
                        <select class="select2_single form-control col-sm-3" id="akses" name="akses">

                            <option value="beranda">Beranda</option>
                            <option value="pegawai">Pegawai</option>
                            <option value="role">Role Pegawai</option>
                            <option value="atribut">Atribut Peta</option>
                            <option value="kecamatan">Kecamatan</option>
                            <option value="provider">Provider</option>
                            <option value="menara">Menara</option>
                            <option value="zona">Zona</option>
                            <option value="map">Map</option>
                            <option value="findmap">Cek Koordinat</option>

                        </select>
                        <select class="select2_single form-control col-sm-3" id="hak" name="hak">

                            <option value="read">Hanya Lihat</option>
                            <option value="manage">Mengelola Data</option>

                        </select>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button class="btn btn-warning"><a href="<?= site_url('role') ?>" style="color: white ;">Back</a></button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<?= content_close() ?>