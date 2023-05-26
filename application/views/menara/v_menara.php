<?= content_open($subtitle) ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Data Menara </h2>
            <?php if ($hak == 'manage') { ?>
                <a href="<?= site_url($url . '/form_tambah') ?>" class='btn btn-success'><i class="fa fa-plus"> Tambah Data</i></a>
            <?php } ?>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <?= $this->session->tempdata('info'); ?>

            <div class="dataTables_length" id="datatable-buttons_length">

                <form class="user" method="post" action="<?= site_url() ?>menara">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <select class="form-control col-sm-6" name="kat" style="display: inline-block;">
                                <option value="semua">Semua</option>
                                <?php foreach ($kecamatan->result() as $pro) { ?>
                                    <option value="<?= $pro->kode_kecamatan; ?>" <?php if ($pro->kode_kecamatan == $prov) {
                                                                                        echo 'selected';
                                                                                    } ?>>

                                        <i class="fa fa-plus">
                                            <?= $pro->nama_kecamatan; ?>
                                        </i>

                                    </option>
                                <?php } ?>
                            </select>
                            <select class="form-control col-sm-3" name="thn" style="display: inline-block;">
                                <?php foreach ($tahun->result() as $thn) { ?>
                                    <option value="<?= $thn->sumber_data; ?>" <?php if ($thn->sumber_data == $thnn) {
                                                                                    echo 'selected';
                                                                                } ?>>

                                        <i class="fa fa-plus">
                                            <?= $thn->sumber_data; ?>
                                        </i>

                                    </option>
                                <?php } ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="kategori">GO!</button>
                            </span>
                        </div>
                    </div>
                </form>

            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Menara</th>
                                    <th>Lat</th>
                                    <th>Long</th>
                                    <th>Site_ID</th>
                                    <th>Tipe</th>
                                    <th>Tinggi</th>
                                    <th>Pemilik</th>
                                    <th>Jumlah Operator</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <?php if ($hak == 'manage') { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($datatabel->result() as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->kode_menara ?></td>
                                        <td><?= $row->latitude ?></td>
                                        <td><?= $row->longitude ?></td>
                                        <td><?= $row->site_id ?><?php if ($hak == 'manage') { ?> <a href="<?= site_url($url . '/ubah_zona/' . $row->kode_menara) ?>" class='btn btn-warning'><i class="fa fa-edit"></i></a><?php } ?></td>
                                        <td><?= $row->kode_jenis_menara ?></td>
                                        <td><?= $row->tinggi_menara ?></td>
                                        <td>
                                            <?php
                                            foreach ($pemilik->result() as $pmlkk) {
                                                if ($pmlkk->kode_provider == $row->kode_provider) {
                                                    echo $pmlkk->nama_provider;
                                                }
                                            }
                                            ?><label for="">(<?= $row->kode_provider ?>)</label>
                                        </td>
                                        <td><?= $row->jumlah_operator ?></td>
                                        <td><?= $row->kelurahan ?></td>
                                        <td><?php
                                            foreach ($kecamatan->result() as $kccmmtt) {
                                                if ($kccmmtt->kode_kecamatan == $row->kode_kecamatan) {
                                                    echo $kccmmtt->nama_kecamatan;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row->alamat ?></td>
                                        <?php if ($hak == 'manage') { ?>
                                            <td>
                                                <a href="<?= site_url($url . '/form_ubah/' . $row->kode_menara) ?>" class='btn btn-info'><i class="fa fa-edit"></i>Ubah</a>

                                                <a href="<?= site_url($url . '/del/' . $row->kode_menara) ?>" class='btn btn-danger' onclick="return confirm('Data Akan Terhapus Secara Permanen!!')"><i class="fa fa-trash"></i>Hapus</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= content_close() ?>