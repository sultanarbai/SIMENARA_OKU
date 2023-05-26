<?= content_open('', '') ?>

<!-- start script -->
<script>
    function initialize() {

        var zonaeksisting = L.layerGroup();
        var zonanew = L.layerGroup();
        var menara = L.layerGroup();
        var kecoku = L.layerGroup();
        var bestdbm = L.layerGroup();
        var gooddbm = L.layerGroup();
        var atribut = L.layerGroup();

        var latInput = document.querySelector("[name=latitude]");
        var lngInput = document.querySelector("[name=longitude]");
        var markerjekerbeg;

        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
        var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var map = L.map('map', {
            center: [-4.1145, 104.167],
            zoom: 10,
            layers: [osm, kecoku, menara, zonanew, zonaeksisting] //ini adalah memilih layer yang aktif ketika akses pertama
        });


        var baseLayers = {
            'OpenStreetMap': osm,
            'Streets': streets
        };
        var overlays = {
            'kecamatan': kecoku
        };
        // menampilkan panel kontrol layer
        var layerControl = L.control.layers(baseLayers, overlays, {
            collapsed: false
        }).addTo(map);
        layerControl.addOverlay(zonanew, 'Zona New');
        layerControl.addOverlay(zonaeksisting, 'Zona Eksisting');
        layerControl.addOverlay(menara, 'Menara');
        layerControl.addOverlay(gooddbm, '-85 dBm');
        layerControl.addOverlay(bestdbm, '-65 dBm');
        layerControl.addOverlay(atribut, 'Atribut Tambahan Peta');

        var satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
        layerControl.addBaseLayer(satellite, 'Satellite');

        // menampilkan geojson RBI
        // batas kecamatan
        var bataskecamatan = {
            "color": "green",
            "weight": 1
        }

        function popUpp(f, l) {
            var out = [];
            if (f.properties) {
                // for (key in f.properties) {
                //        out.push(key + ": <b>" + f.properties[key] + "</b>");
                // }
                // l.bindPopup(out.join("<br />"));
                l.bindTooltip(f.properties['NAMOBJ'], {
                    permanent: true,
                    direction: "center",
                    className: "no-background"
                });
            }
        }
        <?php foreach ($datatabel2->result() as $kcmt) { ?>
            var jsonTesti = new L.GeoJSON.AJAX(["<?= site_url('geo/' . $kcmt->geojson) ?>"], {
                onEachFeature: popUpp,
                style: bataskecamatan
            }).addTo(kecoku);
        <?php } ?>
        // end
        // Atribut Peta

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                for (key in f.properties) {
                    out.push(key + ": <b>" + f.properties[key] + "</b>");
                }
                l.bindPopup(out.join("<br />"));
            }
        }
        <?php foreach ($atribut->result() as $atrb) { ?>
            var jsonTest = new L.GeoJSON.AJAX(["<?= site_url('geo/' . $atrb->file_atribut) ?>"], {
                onEachFeature: popUp,
                style: {
                    "color": "<?= $atrb->warna_atribut ?>",
                    "weight": 1
                }
            }).addTo(atribut);
        <?php } ?>
        // end

        // mulai

        <?php foreach ($datatabel1->result() as $key) {
            if ($key->latitude != null or $key->longitude != null) {
        ?>
                // konversi dbm ke watt
                var dbm2 = -85;
                var pangkat2 = (dbm2 - 30) / 10;
                var watt2 = Math.pow(10, pangkat2);

                var pr2 = watt2;
                var pt2 = 4;
                var hb2 = <?= $key->tinggi_menara; ?>;
                var hm2 = 1;

                var d42 = pt2 * ((Math.pow(hb2, 2) * Math.pow(hm2, 2)) / pr2);
                var d2 = Math.sqrt(Math.sqrt(d42));
                // ---------------------------------
                L.circle([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                        fillColor: 'red',
                        fillOpacity: 0.05,
                        radius: d2,
                        stroke: false
                    })
                    .addTo(gooddbm);



        <?php }
        } ?>
        // akhir
        // mulai
        <?php foreach ($datatabel1->result() as $key) {
            if ($key->latitude != null or $key->longitude != null) {
        ?>

                var LeafIcon = L.Icon.extend({
                    options: {

                        iconSize: [20, 20],

                        iconAnchor: [10, 20],
                        shadowAnchor: [4, 62],
                        popupAnchor: [0, -20]
                    }
                });
                <?php foreach ($provider->result() as $icn) {
                    if ($key->kode_provider == $icn->kode_provider) {
                ?>
                        var orangeIcon = new LeafIcon({
                            iconUrl: "<?= template('images/') . $icn->icon ?>"
                        });
                <?php }
                } ?>
                var mGreen = L.marker([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                        icon: orangeIcon
                    })
                    .bindPopup('<h5><?= $key->kode_menara; ?></h5></br>Koordinat : <?= $key->latitude; ?>, <?= $key->longitude; ?></br>Site ID : <?= $key->site_id; ?> </br>Tipe : <?= $key->kode_jenis_menara; ?> </br>Pemilik : <?= $key->kode_provider; ?>')
                    .addTo(menara);

                // konversi dbm ke watt
                var dbm = -65;
                var pangkat = (dbm - 30) / 10;
                var watt = Math.pow(10, pangkat);

                var pr = watt;
                var pt = 4;
                var hb = <?= $key->tinggi_menara; ?>;
                var hm = 1;

                var d4 = pt * ((Math.pow(hb, 2) * Math.pow(hm, 2)) / pr);
                var d = Math.sqrt(Math.sqrt(d4));
                // document.write(d + ' => radius; '+);

                L.circle([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                        fillColor: 'black',
                        fillOpacity: 0.2,
                        radius: d,
                        stroke: false
                    })
                    .addTo(bestdbm);

        <?php }
        }
        ?>

        // akhir

        // menampilkan zona menara
        <?php foreach ($zona->result() as $Dzona) {
            if ($Dzona->latitude != null or $Dzona->longitude != null) {


        ?>
                //        .addTo(map)
                <?php if ($Dzona->status == 'eksisting') { ?>
                    L.circle([<?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?>], {
                            color: 'red',
                            radius: 400
                        })
                        .bindPopup('<h5><?= $Dzona->site_id; ?></h5></br>Koordinat : <?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?></br>Site ID : <?= $Dzona->site_id; ?> </br>Status : <?= $Dzona->status; ?> </br>Kecamatan : <?= $Dzona->kode_kecamatan; ?> </br>Jumlah Menara : <?= $Dzona->jumlah_menara; ?>')
                        .addTo(zonaeksisting);
                <?php } else { ?>
                    L.circle([<?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?>], {
                            color: 'blue',
                            radius: 400
                        })
                        .bindPopup('<h5><?= $Dzona->site_id; ?></h5></br>Koordinat : <?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?></br>Site ID : <?= $Dzona->site_id; ?> </br>Status : <?= $Dzona->status; ?> </br>Kecamatan : <?= $Dzona->kode_kecamatan; ?> </br>Jumlah Menara : <?= $Dzona->jumlah_menara; ?>')
                        .addTo(zonanew);
                <?php } ?>


        <?php }
        } ?>

        // -----------------------

        // mengambil titik koordinat pada peta
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!markerjekerbeg) {
                markerjekerbeg = L.circle(e.latlng, {
                    color: 'black',
                    radius: 400
                }).addTo(kecoku)
            } else {
                markerjekerbeg.setLatLng(e.latlng);
            }
            latInput.value = lat;
            lngInput.value = lng;
        })
        // end
    };
</script>
<!-- end script -->
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>Form Ubah Zona</h2><button class="btn btn-warning"><a href="<?= site_url('zona') ?>" style="color: white ;"><i class="fa fa-times"></i> Cancel</a></button>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- form elegan -->
        <div class="x_content">
            <form class="form-label-left input_mask" method="post" action="<?= site_url() ?>zona/form_ubah/<?= $datatabel[0]->site_id ?>">

                <div class="col-md-4 col-sm-4  form-group has-feedback">
                    <div class="form-group">
                        <input type="text" class="form-control has-feedback-left" name="site_id" id="inputSuccess2" value="<?= $datatabel[0]->site_id ?>" placeholder="Site Id" required readonly>
                        <span class="form-control-feedback" aria-hidden="true"></span>
                        <?php if ($err1 != '') {
                            echo '
                        <small class="text-danger">' . $err1 . '</small>';
                        } ?>
                        <?php if ($same != '') {
                            echo '<small class="text-danger pl-3">' . $same . '</small>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control has-feedback-left" id="kecamatan" name="kecamatan" required>
                            <?php
                            foreach ($datakec->result() as $row2) {
                            ?>
                                <option value="<?= $row2->kode_kecamatan; ?>" <?php if ($datatabel[0]->kode_kecamatan == $row2->kode_kecamatan) {
                                                                                    echo 'selected=""';
                                                                                }
                                                                                ?>><?= $row2->nama_kecamatan; ?></option>
                            <?php } ?>
                        </select>
                        <span class="form-control-feedback" aria-hidden="true"></span>
                        <?php if ($err2 != '') {
                            echo '<small class="text-danger pl-3">' . $err2 . '</small>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control has-feedback-left" name="latitude" id="latitude" value="<?= $datatabel[0]->latitude ?>" placeholder="Latitude" required>
                        <span class="form-control-feedback" aria-hidden="true"></span>
                        <?php if ($err3 != '') {
                            echo '<small class="text-danger pl-3">' . $err3 . '</small>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control has-feedback-left" name="longitude" id="longitude" value="<?= $datatabel[0]->longitude ?>" placeholder="Longitude" required>
                        <span class="form-control-feedback" aria-hidden="true"></span>
                        <?php if ($err4 != '') {
                            echo '<small class="text-danger pl-3">' . $err4 . '</small>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <label>Status *:</label>

                        New :
                        <input type="radio" class="flat" name="status" id="new" value="new" <?php if ($datatabel[0]->status == 'new') {
                                                                                                echo 'checked=""';
                                                                                            } ?> required />



                        || Eksisting :
                        <input type="radio" class="flat" name="status" id="eksisting" <?php if ($datatabel[0]->status == 'eksisting') {
                                                                                            echo 'checked=""';
                                                                                        } ?> value="eksisting" />

                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8  form-group has-feedback">
                    <h5>Pilih Titik</h5>
                    <div id="map" style="height: 400px"></div>
                </div>



            </form>
        </div>
        <!-- form elegan -->
    </div>
</div>


<?= content_close() ?>