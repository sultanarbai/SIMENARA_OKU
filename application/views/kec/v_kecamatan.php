<?= content_open($subtitle) ?>


<?= $this->session->tempdata('info'); ?>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Daftar Kecamatan </h2>
            <?php if ($hak == 'manage') { ?>
                <a href="<?= site_url($url . '/form_tambah') ?>" class='btn btn-success'><i class="fa fa-plus"></i> Tambah </a>
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
                        <th>Id Kecamatan</th>
                        <th>Nama Kecamatan</th>
                        <th>Jumlah Penduduk</th>
                        <th>Laju Pertumbuhan</th>
                        <th>Luas</th>
                        <th>Kepadatan</th>
                        <th>File</th>
                        <th>Tahun Data</th>
                        <th>Teledensitas</th>
                        <th>Rata" Panggilan/hari (Menit)</th>
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
                            <td><?= $row->kode_kecamatan ?></td>
                            <td><?= $row->nama_kecamatan ?></td>
                            <td><?= $row->jumlah_penduduk ?></td>
                            <td><?= $row->laju_pertumbuhan ?></td>
                            <td><?= $row->luas_wilayah ?></td>
                            <td><?= $row->kepadatan_penduduk ?></td>
                            <td><?= $row->geojson ?></td>
                            <td><?= $row->sumber_data ?></td>
                            <td><?= $row->teledensitas ?></td>
                            <td><?= $row->ratarata_pngl ?></td>
                            <?php if ($hak == 'manage') { ?>
                                <td>
                                    <a href="<?= site_url($url . '/form_ubah/' . $row->kode_kecamatan) ?>" class='btn btn-info'><i class="fa fa-edit"></i></a>
                                    <a href="<?= site_url($url . '/del/' . $row->kode_kecamatan) ?>" class='btn btn-danger' onclick="return confirm('Yakin... Mau Hapus Data ??????')"><i class="fa fa-trash"></i></a>
                                    <a href="<?= site_url($url . '/form_geojson/' . $row->kode_kecamatan) ?>" class='btn btn-primary'><i class="fa fa-map"></i> GeoJSON</a>
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

<?= content_close() ?>