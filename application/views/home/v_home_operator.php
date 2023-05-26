<?= content_open($subtitle) ?>
<?php
$total = $eksisting + $new;
$persen_eksisting = $eksisting / $total * 100;
$persen_new = $new / $total * 100;
?>
<div class="row">

  <!-- motion provider -->
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i>
      </div>
      <div class="count"><?= $users;  ?></div>

      <h3>Pengguna</h3>
      <p>terdaftar <small><b><?= $year ?></b></small></p>
    </div>
  </div>
  <!-- --------------- -->
  <!-- motion provider -->
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-check-square-o"></i>
      </div>
      <div class="count"><?= $tot_provider;  ?></div>

      <h3>Provider</h3>
      <p>terdaftar <small><b><?= $year ?></b></small></p>
    </div>
  </div>
  <!-- --------------- -->
  <!-- motion provider -->
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-signal"></i>
      </div>
      <div class="count"><?= $tot_menara;  ?></div>

      <h3>Menara</h3>
      <p>terdaftar <small><b><?= $year ?></b></small></p>
    </div>
  </div>
  <!-- --------------- -->
  <!-- motion provider -->
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-map-marker"></i>
      </div>
      <div class="count"><?= $zona;  ?></div>

      <h3>Zona</h3>
      <p>terdaftar <small><b><?= $year ?></b></small></p>
    </div>
  </div>
  <!-- --------------- -->
  <!-- chart -->
  <div class="col-md-3   widget widget_tally_box">
    <div class="x_panel ui-ribbon-container fixed_height_390">
      <div class="x_title">
        <h2>Zona Eksisting <label><b><?= $year ?></b></label></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div style="text-align: center; margin-bottom: 17px">
          <span class="chart" data-percent="<?= $persen_eksisting; ?>">
            <span class="percent"></span>
          </span>
        </div>

        <h3 class="name_title"><?= $eksisting; ?></h3>
        <p>Zona Terisi(Eksisting) dari total keseluruhan Zona eksisting dan baru : <?= $total; ?></p>

        <div class="divider"></div>

      </div>
    </div>
  </div>
  <!-- ------------ -->
  <!-- chart -->
  <div class="col-md-3   widget widget_tally_box bg">
    <div class="x_panel ui-ribbon-container fixed_height_390">
      <div class="x_title">
        <h2>Zona Baru <label><b><?= $year ?></b></label></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div style="text-align: center; margin-bottom: 17px">
          <span class="chart" data-percent="<?= $persen_new; ?>">
            <span class="percent"></span>
          </span>
        </div>

        <h1 class="name_title"><?= $new; ?></h1>
        <p>Zona Baru Tersisa</p>

        <div class="divider"></div>
      </div>
    </div>
  </div>
  <!-- ------------ -->
  <!-- progresbar -->
  <div class="col-md-6 col-sm-6 ">
    <div class="x_panel fixed_height_650">
      <div class="x_title">
        <h2>Menara Telekomunikasi <label><b><?= $year ?></b></label></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="widget_summary">

          <!-- ---- -->
          <div class="w_left w_25">
            <span>Baturaja Barat</span>
          </div>

          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?= $bb;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $bb;  ?>%">
                <span class="sr-only"><?= $bb;  ?></span>
              </div>
            </div>
          </div>

          <div class="w_right w_20">
            <span><?= $bb;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>

        <!-- ----- -->
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Baturaja Timur</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?= $bt;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $bt;  ?>%">
                <span class="sr-only"><?= $bt;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $bt;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Kedaton Peninjauan Raya</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-valuenow="<?= $kpr;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $kpr;  ?>%">
                <span class="sr-only"><?= $kpr;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $kpr;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Lengkiti</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="<?= $l;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $l;  ?>%">
                <span class="sr-only"><?= $l;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $l;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Lubuk Batang</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="<?= $lb;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $lb;  ?>%">
                <span class="sr-only"><?= $lb;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $lb;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Lubuk Raja</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?= $lr;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $lr;  ?>%">
                <span class="sr-only"><?= $lr;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $lr;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Muara Jaya</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?= $mj;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $mj;  ?>%">
                <span class="sr-only"><?= $mj;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $mj;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Pengandonan</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-valuenow="<?= $penga;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $penga;  ?>%">
                <span class="sr-only"><?= $penga;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $penga;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Peninjauan</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="<?= $peni;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $peni;  ?>%">
                <span class="sr-only"><?= $peni;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $peni;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Semidang Aji</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="<?= $sa;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $sa;  ?>%">
                <span class="sr-only"><?= $sa;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $sa;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Sinar Peninjauan</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?= $sp;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $sp;  ?>%">
                <span class="sr-only"><?= $sp;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $sp;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Sosoh Buay Rayap</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?= $sbr;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $sbr;  ?>%">
                <span class="sr-only"><?= $sbr;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $sbr;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Ulu Ogan</span>
          </div>
          <div class="w_center w_55">
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-valuenow="<?= $uo;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $uo;  ?>%">
                <span class="sr-only"><?= $uo;  ?></span>
              </div>
            </div>
          </div>
          <div class="w_right w_20">
            <span><?= $uo;  ?></span>
          </div>
          <div class="clearfix"></div>
        </div>



      </div>
    </div>
  </div>
  <!-- end progressbar -->
  <!-- kebutuhanmenara -->
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
              <th><b>BTS <?= $tahun ?></b></th>
              <th>Menara <?= $thn ?></th>
              <th><b>Menara <?= $tahun ?></b></th>
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
                <td><b><?= $menaraku[$i]['prediksi_bts']; ?></b></td>
                <td><?= $menaraku[$i]['tot_menara']; ?></td>
                <td><b><?= $menaraku[$i]['prediksi_menara']; ?></b></td>
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
  <!-- end kebutuhanmenara -->
</div>

<?= content_close() ?>