<?= content_open($subtitle) ?>
<?= $this->session->tempdata('info'); ?>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Data Pegawai -- </h2>
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
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>No. HP</th>
                        <th>Kode Role</th>
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
                            <td><?= $row->nip ?></td>
                            <td><?= $row->nama_pegawai ?></td>
                            <td><?= $row->no_hp ?></td>
                            <td><?= $row->kode_role ?></td>
                            <td><?= $row->alamat ?></td>
                            <?php if ($hak == 'manage') { ?>
                                <td>
                                    <a href="<?= site_url($url . '/form_ubah/' . $row->nip) ?>" class='btn btn-info'><i class="fa fa-edit"></i>Ubah</a>
                                    <a href="<?= site_url($url . '/del/' . $row->nip) ?>" class='btn btn-danger' onclick="return confirm('Yakin... Mau Hapus Data ??????')"><i class="fa fa-trash"></i>Hapus</a>
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