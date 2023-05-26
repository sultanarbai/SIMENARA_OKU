<?= content_open($subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Tambah Menara</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- form elegan -->
        <div class="x_content">
            <br />
            <form class="form-label-left input_mask" method="post" action="<?= site_url() ?>menara/form_tambah">

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="template" value="" placeholder="Kode Menara Dibuat Otomatis" readonly>
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <div id="year-list"></div>
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <select class="form-control has-feedback-left" id="site_id" name="site_id">
                        <option value="">Site ID</option>
                        <?php
                        foreach ($datatabel4->result() as $row2) {
                        ?>
                            <option value="<?= $row2->site_id; ?>"><?= $row2->site_id; ?></option>
                        <?php } ?>
                    </select>
                    <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <select class="form-control" id="jenis_menara" name="jenis_menara" required>
                        <option value="">Jenis Menara</option>
                        <option value="GF">Green Field (GF)</option>
                        <option value="RT">Roof Top (RT)</option>
                    </select>

                    <span class="form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <select class="form-control has-feedback-left" id="provider" name="provider" required>

                        <option value="">Pilih Pemilik Menara</option>

                        <?php
                        foreach ($datatabel1->result() as $row) {
                        ?>
                            <option value="<?= $row->kode_provider; ?>"><?= $row->nama_provider; ?><label for=""> (<?= $row->kode_provider; ?>)</label></option>
                        <?php } ?>
                    </select>
                    <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <select class="form-control" id="kecamatan" name="kecamatan" required>

                        <option value="">Pilih Kecamatan</option>

                        <?php
                        foreach ($datatabel3->result() as $row) {
                        ?>
                            <option value="<?= $row->kode_kecamatan; ?>"><?= $row->nama_kecamatan; ?></option>
                        <?php } ?>
                    </select>

                    <span class="form-control-feedback right" aria-hidden="true"></span>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelurahan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kelurahan" value="<?= $data1 ?>" placeholder="..." required>
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
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat" value="<?= $data2 ?>" placeholder="..." required>
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
                    <label class="col-sm-2 col-form-label">Tinggi Menara</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tinggi_menara" value="<?= $data3 ?>" placeholder="..." required>
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
                    <label class="col-sm-2 col-form-label">Latitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="latitude" value="<?= $data4 ?>" placeholder="..." required>
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
                    <label class="col-sm-2 col-form-label">Longitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" value="<?= $data5 ?>" placeholder="..." required>
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
                    <label class="col-sm-2 col-form-label">Jumlah Operator</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="jumlah_operator" value="<?= $data6 ?>" placeholder="..." required>
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

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-warning"><a href="<?= site_url('menara') ?>" style="color: white ;">Cancel</a></button>
                    </div>
                </div>

            </form>
        </div>
        <!-- form elegan -->
    </div>
</div>


<script>
    (function() {
        var year_start = 2005;
        var year_end = (new Date).getFullYear();
        var selected_year = 0;

        var option = '<select class="form-control" id="tahun" name="tahun" required>';
        // jangan lupa dikosongkan valuenya jika sudah selesai input data
        option += '<option value="">Sumber Data</option>';

        for (var i = 0; i <= (year_end - year_start); i++) {
            var year = (year_end - i);
            option += '<option value="' + year + '"' + (year == selected_year ? ' selected' : '') + '>' + year + '</option>';
        }

        option += '</select>';
        document.getElementById('year-list').innerHTML = option;
    })();
</script>

<?= content_close() ?>