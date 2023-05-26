<?= content_open($title, $subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Ubah Akun Pegawai</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br />
            <form class="user" method="post" action="<?= site_url($url) ?>/form_ubah/<?= $datatabel->nip ?>">
                <input type="text" id="abcdefghijklmnopqrstuvwxyz" name="abcdefghijklmnopqrstuvwxyz" value="<?= $datatabel->password ?>" hidden>
                <input type="text" id="abcdefghijklmnopqrstuvwxyzz" name="abcdefghijklmnopqrstuvwxyzz" value="<?= $datatabel->nip ?>" hidden>

                <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nip" name="nip" value="<?= $datatabel->nip ?>" maxlength="20" required>
                    </div>
                </div>
                <?php if ($nip_err != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $nip_err . '</small>
                    </div>
                </div>';
                } ?>
                <?= form_error('nip', '<div class="form-group row"><label for="nip" class="col-sm-2 col-form-label"></label><div class="col-sm-10"><small class="text-danger pl-3">', '</small></div>
                </div>'); ?>

                <div class="form-group row">
                    <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="<?= $datatabel->nama_pegawai ?>" maxlength="50" required>
                    </div>
                </div>
                <?php if ($nama_err != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $nama_err . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password1" value="" placeholder="kosongkan jika tidak ingin ganti password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password" value="" placeholder="kosongkan jika tidak ganti password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $datatabel->no_hp ?>" maxlength="15" required>
                    </div>
                </div>
                <?php if ($nohp_err != '') {
                    echo '<div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <small class="text-danger pl-3">' . $nohp_err . '</small>
                    </div>
                </div>';
                } ?>
                <div class="form-group row">
                    <label for="kode_role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="col-sm-2 col-form-label" id="kode_role" name="kode_role">
                            <?php
                            foreach ($datatabel4->result() as $row2) {
                            ?>
                                <option <?php if ($datatabel->kode_role == $row2->kode_role) { ?> selected <?php }; ?> value="<?= $row2->kode_role; ?>"><?= $row2->nama_role; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datatabel->alamat ?>" maxlength="400" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Akun:</label>
                    <div class="col-sm-10">
                        <p>
                            Belum Valid ==>
                            <input type="radio" class="flat" name="status" id="0" value="0" <?php if ($datatabel->status_akun == '0') { ?> checked="" <?php }; ?> required />
                            Valid ==>
                            <input type="radio" class="flat" name="status" id="1" value="1" <?php if ($datatabel->status_akun == '1') { ?> checked="" <?php }; ?> />
                        </p>
                    </div>
                </div>


                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                        <button class="btn btn-warning"><a href="<?= site_url('pegawai') ?>" style="color: white ;">Cancel</a></button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<?= content_close() ?>