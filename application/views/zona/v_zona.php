<?= content_open();
// var_dump($menaraku);
// die; 
?>

<?= $this->session->tempdata('info'); ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Data Zona -- </h2>
            <?php if ($hak == 'manage') { ?>
                <a href="<?= site_url($url . '/form_tambah') ?>" class='btn btn-success'><i class="fa fa-plus"></i> Tambah</a>
            <?php } ?>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>site id</th>
                        <th>Status</th>
                        <th>Kecamatan</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
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
                            <td><?= $row->site_id ?></td>
                            <td><?= $row->status ?></td>
                            <td><?= $row->kode_kecamatan ?></td>
                            <td><?= $row->latitude ?></td>
                            <td><?= $row->longitude ?></td>
                            <?php if ($hak == 'manage') { ?>
                                <td>
                                    <a href="<?= site_url($url . '/form_ubah/' . $row->site_id) ?>" class='btn btn-info'><i class="fa fa-edit"></i>Ubah</a>
                                    <a href="<?= site_url($url . '/del/' . $row->site_id) ?>" class='btn btn-danger' onclick="return confirm('Data Akan Terhapus Secara Permanen!!')"><i class="fa fa-trash"></i>Hapus</a>
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

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>KEBUTUHAN MENARA </h2>
            <ul class="nav navbar-right panel_toolbox">
                <i>
                    <p style="color: red ;">* jumlah penambahan zona <b>disarankan</b> sesuai dengan jumlah penambahan menara</p>
                </i>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>kode_kecamatan</th>
                        <th>Kecamatan</th>
                        <th>BTS <?= $thn ?></th>
                        <th>BTS <?= $tahun ?></th>
                        <th>Menara <?= $thn ?></th>
                        <th>Menara <?= $tahun ?></th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    for ($i = 0; $i < $jumlah_kecamatan; $i++) {
                    ?>
                        <tr>
                            <td><?= $menaraku[$i]['kode_kecamatan']; ?></td>
                            <td><?= $menaraku[$i]['nama_kecamatan']; ?></td>
                            <td><?= $menaraku[$i]['tot_bts']; ?></td>
                            <td><?= $menaraku[$i]['prediksi_bts']; ?></td>
                            <td><?= $menaraku[$i]['tot_menara']; ?></td>
                            <td><?= $menaraku[$i]['prediksi_menara']; ?></td>
                            <td>
                                <?php if ($menaraku[$i]['selisih_menara'] > 0) { ?>
                                    <span class="btn btn-warning">Perlu <span class="badge"><?= $menaraku[$i]['selisih_menara'] ?></span> Menara</span>
                                <?php } else { ?>
                                    <span class="btn btn-success">Tetap</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= content_close() ?>