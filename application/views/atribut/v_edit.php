<?= content_open($subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Ubah Kecamatan</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br />
            <form class="user" method="post" action="<?= site_url() ?>atribut/form_ubah" enctype="multipart/form-data">

                <div class="form-group row">
                    <label for="nama_atribut" class="col-sm-2 col-form-label"><b>Nama Atribut</b></label>
                    <div class="col-sm-10">
                        <input type="text" id="kd_atribut" name="kd_atribut" value="<?= $datatabel->kode_atribut; ?>" required hidden>
                        <input type="text" class="form-control" id="nama_atribut" name="nama_atribut" value="<?= $datatabel->nama_atribut; ?>" maxlength="50" required>
                    </div>
                </div>
                <?php if ($err != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $err . '</small>
                    </div>
                </div>';
                } ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><b>Warna Atribut</b></label>
                    <div class="col-sm-10  ">
                        <div class="input-group demo2">
                            <input type="color" id="html5colorpicker" onchange="clickColor(0, -1, -1, 5)" name="color" value="<?= $datatabel->warna_atribut; ?>" class="form-control" />

                        </div>
                    </div>
                </div>
                <!-- select file -->
                <div class="form-group row">
                    <label for="geojson" class="col-sm-2 col-form-label"><b>Select GeoJSON</b></label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="geojson" id="geojson">
                    </div>
                </div>
                <!-- end -->
                <hr>
                <!-- select file -->
                <div class="form-group row">
                    <label for="geojson_used" class="col-sm-2 col-form-label"><b>Used GeoJSON</b></label>
                    <div class="col-sm-10">
                        <p class="form-control" readonly><?= $datatabel->file_atribut; ?></p>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('atribut') ?>" class="btn btn-warning">Cancel</a>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<?= content_close() ?>