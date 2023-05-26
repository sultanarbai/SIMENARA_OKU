<?= content_open() ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Tambah Data</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">


            <br />
            <form class="user" method="post" action="<?= site_url() ?>provider/form_tambah" enctype="multipart/form-data">

                <div class="form-group row">
                    <label for="kode_provider" class="col-sm-2 col-form-label"><b>Kode Provider</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_provider" name="kode_provider" value="<?= $kode_provider; ?>" maxlength="5" required>
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
                    <label for="nama_provider" class="col-sm-2 col-form-label"><b>Nama Provider</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_provider" name="nama_provider" value="<?= $nama_provider; ?>" maxlength="70" required>
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
                    <label for="alamat_provider" class="col-sm-2 col-form-label"><b>Alamat Provider</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat_provider" name="alamat_provider" value="<?= $alamat_provider; ?>" required>
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
                    <label for="logo_tower" class="col-sm-2 col-form-label"><b>Icon</b></label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="logo_tower" name="logo_tower">
                        <p><i>only <b>.png</b> file</i></p>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        <a href="<?= site_url('provider') ?>" class="btn btn-warning">Cancel</a>
                    </div>
                </div>


            </form>

        </div>
    </div>
</div>

<?= content_close() ?>