<?= content_open($subtitle) ?>
<?= $this->session->tempdata('info'); ?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Data Provider -- </h2>
            <?php if ($hak == 'manage') { ?>
                <a href="<?= site_url($url . '/form_tambah') ?>" class='btn btn-success'><i class="fa fa-plus"></i>Tambah</a>
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
                        <th>Kode</th>
                        <th>Nama Provider</th>
                        <th>Ikon</th>
                        <th>Alamat Perusahaan</th>
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
                            <td><?= $row->kode_provider ?></td>
                            <td><?= $row->nama_provider ?></td>
                            <td><img src="<?= template('images/') . $row->icon;
                                            ?>"></td>
                            <td><?= $row->alamat_perusahaan ?></td>
                            <?php if ($hak == 'manage') { ?>
                                <td>
                                    <a href="<?= site_url($url . '/form_ubah/' . $row->kode_provider) ?>" class='btn btn-info'><i class="fa fa-edit"></i>Ubah</a>
                                    <a href="<?= site_url($url . '/del/' . $row->kode_provider) ?>" class='btn btn-danger' onclick="return confirm('Yakin... Mau Hapus Data ??????')"><i class="fa fa-trash"></i>Hapus</a>
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