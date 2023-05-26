<?= content_open() ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Ubah Data</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br />
            <?= form_open_multipart('provider/form_ubah/' . $datatabel->kode_provider); ?>

            <input type="hidden" name="kode_provider" value="<?= $datatabel->kode_provider ?>" readonly required>

            <div class="form-group row">
                <label for="nama_provider" class="col-sm-2 col-form-label">Nama Provider</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_provider" name="nama_provider" value="<?= $datatabel->nama_provider ?>" maxlength="70" required>
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
                <label for="alamat_provider" class="col-sm-2 col-form-label">Alamat Provider</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat_provider" name="alamat_provider" value="<?= $datatabel->alamat_perusahaan ?>" required>
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
                <label for="logo_tower" class="col-sm-2 col-form-label">Icon</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="logo_tower" name="logo_tower">
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="logo_tower" class="col-sm-2 col-form-label">Used Icon</label>
                <div class="col-sm-10">
                    <img src="<?= template('images/') . $datatabel->icon ?>" alt="">
                    <i><?= $datatabel->icon ?></i>
                </div>
            </div>

            <hr>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="<?= site_url('provider'); ?>" class="btn btn-warning">Cancel</a>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>

<?= content_close() ?>