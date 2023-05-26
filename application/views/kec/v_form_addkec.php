<?= content_open() ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Tambah Kecamatan</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br />
            <form class="user" method="post" action="<?= site_url() ?>kecamatan/form_tambah">

                <div class="form-group row">
                    <label for="kode_kecamatan" class="col-sm-2 col-form-label">Kode Kecamatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_kecamatan" name="kode_kecamatan" value="<?= $kode_kecamatan; ?>" maxlength="4" required>
                    </div>
                </div>
                <?php if ($err1 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err1 . '</small>
                    </div>
                </div>';
                } ?>
                <?php if ($same != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $same . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="nama_kecamatan" class="col-sm-2 col-form-label">Nama Kecamatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" value="<?= $nama_kecamatan; ?>" maxlength="30" required>
                    </div>
                </div>
                <?php if ($err2 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err2 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="jumlah_penduduk" class="col-sm-2 col-form-label">Jumlah Penduduk</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk" value="<?= $jumlah_penduduk; ?>" min="0" required>
                    </div>
                </div>
                <?php if ($err3 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err3 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="laju_pertumbuhan" class="col-sm-2 col-form-label">Laju Pertumbuhan</label>
                    <div class="col-sm-10">
                        <input type="float" class="form-control" id="laju_pertumbuhan" name="laju_pertumbuhan" value="<?= $laju_pertumbuhan; ?>" required>
                    </div>
                </div>
                <?php if ($err4 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err4 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="luas_wilayah" class="col-sm-2 col-form-label">Luas Wilayah</label>
                    <div class="col-sm-10">
                        <input type="float" class="form-control" id="luas_wilayah" name="luas_wilayah" value="<?= $luas_wilayah; ?>" required>
                    </div>
                </div>
                <?php if ($err5 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err5 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="sumber_data" class="col-sm-2 col-form-label">Tahun Data</label>
                    <div class="col-sm-2">
                        <input type="float" class="form-control" id="sumber_data" name="sumber_data" value="<?= $sumber_data; ?>" maxlength="4" required>
                    </div>
                </div>
                <?php if ($err6 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err6 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="teledensitas" class="col-sm-2 col-form-label">Teledensitas</label>
                    <div class="col-sm-2">
                        <input type="float" class="form-control" id="teledensitas" name="teledensitas" value="<?= $teledensitas; ?>" required>
                    </div>
                </div>
                <?php if ($err7 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err7 . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="ratarata_pngl" class="col-sm-2 col-form-label">Rata" Panggilan/hari (satuan Menit)</label>
                    <div class="col-sm-2">
                        <input type="float" class="form-control" id="ratarata_pngl" name="ratarata_pngl" value="<?= $ratarata_pngl; ?>" required>
                    </div>
                </div>
                <?php if ($err8 != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err8 . '</small>
                    </div>
                </div>';
                } ?>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        <button class="btn btn-warning"><a href="<?= site_url('kecamatan') ?>" style="color: white ;">Cancel</a></button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<?= content_close() ?>