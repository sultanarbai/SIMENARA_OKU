<?= content_open($subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Update GeoJSON Kecamatan</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br />
            <form class="user" method="post" action="<?= site_url() ?>kecamatan/geojson" enctype="multipart/form-data">

                <div class="form-group row">
                    <label for="kode_kecamatan" class="col-sm-2 col-form-label">Kode Kecamatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_kecamatan" name="kode_kecamatan" value="<?= $datatabel->kode_kecamatan ?>" maxlength="4" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gjs" class="col-sm-2 col-form-label">GeoJSON Terpakai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="gjs" name="gjs" value="<?= $datatabel->geojson ?>" maxlength="4" required readonly>
                    </div>
                </div>

                <!-- select file -->
                <hr>
                Ganti File GeoJSON
                <div class="form-group row">
                    <label for="geojson" class="col-sm-2 col-form-label">Pilih GeoJSON</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="geojson" id="geojson">
                    </div>
                </div>
                <!-- end -->

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button class="btn btn-warning"><a href="<?= site_url('kecamatan') ?>" style="color: white ;">Cancel</a></button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<?= content_close() ?>