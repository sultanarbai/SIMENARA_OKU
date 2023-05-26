<?= content_open($subtitle) ?>
<?= $this->session->tempdata('info'); ?>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Role Pegawai</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if ($hak == 'manage') { ?>
                <form class="user" action="<?= site_url($url) ?>" method="post">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="nama_role" name="nama_role" value="<?= $role ?>" placeholder=" Add new Role.....?" required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Add!</button>
                            </span>
                        </div>

                        <?php if ($role_err != '') {
                            echo '<div class="input-group"><small class="text-danger pl-3">' . $role_err . '</small></div>';
                        } ?>
                    </div>
                </form>
            <?php } ?>
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Role</th>
                        <th>Nama Role</th>
                        <th>Akses</th>
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
                            <td><?= $row->kode_role ?></td>
                            <td><?= $row->nama_role ?></td>
                            <td>
                                <?php
                                $i = 1;
                                foreach ($datatabel1->result() as $akses) {
                                    if ($akses->kode_role == $row->kode_role) { ?>
                                        <?= $i . '. ' . $akses->akses . ' <i>(' . $akses->hak . ')</i>' ?><br>
                                <?php $i = $i + 1;
                                    }
                                }
                                ?>
                            </td>
                            <?php if ($hak == 'manage') { ?>
                                <td>
                                    <a href="<?= site_url($url . '/form_ubah/' . $row->kode_role) ?>" class='btn btn-info'><i class="fa fa-edit"></i>Ubah</a>
                                    <a href="<?= site_url($url . '/del/' . $row->kode_role) ?>" class='btn btn-danger' onclick="return confirm('Yakin... Mau Hapus Data ??????')"><i class="fa fa-trash"></i>Hapus</a>
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