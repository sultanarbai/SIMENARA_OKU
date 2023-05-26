<!-- AWAL leaflet -->
<script>
    function initialize() {

        var zonaeksisting = L.layerGroup();
        var zonanew = L.layerGroup();
        var menara = L.layerGroup();
        var kecoku = L.layerGroup();
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
            center: [-4.0901519454943545, 104.51019287109375],
            zoom: 10,
            layers: [osm, kecoku, menara, zonanew, zonaeksisting, atribut]
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
            var jsonTest = new L.GeoJSON.AJAX(["<?= site_url('geo/' . $kcmt->geojson) ?>"], {
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
        <?php if ($lat != null and $long != null and $lat_err == '' and $long_err == '') { ?>
            var markerku = L.marker([<?= $lat; ?>, <?= $long; ?>])
                .bindPopup('<b>Lattitude :</b> <?= $lat; ?></br> <b>Longitude :</b> <?= $long; ?></br><b>Zona terdekat :</b> <?= $siteid; ?> </br><b>Status zona :</b> <?= $statuszon; ?> </br><b>Jarak :</b> <?= $jarakk; ?> </br><b>Posisi :</b> <?= $posisizon; ?> </br><hr><b>Keterangan :</b> <?= $ketzon; ?>')
                .addTo(map);

            var popup = L.popup()
                .setLatLng([<?= $lat; ?>, <?= $long; ?>])
                .setContent('<b>Lattitude :</b> <?= $lat; ?></br> <b>Longitude :</b> <?= $long; ?></br><b>Zona terdekat :</b> <?= $siteid; ?> </br><b>Status zona :</b> <?= $statuszon; ?> </br><b>Jarak :</b> <?= $jarakk; ?> </br><b>Posisi :</b> <?= $posisizon; ?> </br><hr><b>Keterangan :</b> <?= $ketzon; ?>')
                .openOn(map);
        <?php } else { ?>
            // -------On Click--------
            var popup = L.popup()
                .setLatLng([-4.173704951825692, 104.55688476562501])
                .setContent('#tips : klik peta untuk mendapatkan informasi latitude dan longitude<br><i>**jika menara, zona dan kecamatan tidak bisa diklik, maka matikan dan aktifkan kembali pada menu layer peta</i>')
                .openOn(map);
        <?php } ?>

        // mengambil titik koordinat pada peta
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!markerjekerbeg) {
                markerjekerbeg = L.marker(e.latlng, {
                    opacity: 0.5
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
<!-- //batas LEAFLET -->
<a href="<?= site_url(); ?>"><span class="badge badge-primary"><i class="fa fa-home"></i> Back to Home</span></a>
<form method="post" action="<?= site_url('beranda/findmap') ?>">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="col-md-3 col-sm-3  form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" name="latitude" id="inputSuccess4" placeholder="Latitude" value="<?= $lat; ?>" required>
                <span class="fa fa-circle form-control-feedback left" aria-hidden="true"></span>
                <?php if ($lat_err != '') {
                    echo '<small class="text-danger pl-3">' . $lat_err . '</small>';
                } ?>
            </div>


            <div class="col-md-3 col-sm-3  form-group has-feedback">
                <input type="text" class="form-control" name="longitude" id="inputSuccess5" placeholder="Longitude" value="<?= $long; ?>" required>
                <span class="fa fa-circle form-control-feedback right" aria-hidden="true"></span>
                <?php if ($long_err != '') {
                    echo '<small class="text-danger pl-3">' . $long_err . '</small>';
                } ?>
            </div>

            <div class="col-md-2 col-sm-2  form-group has-feedback">
                <button type="submit" class="btn btn-success" name="cat">GO! <i class="fa fa-spin fa-refresh"></i></button>
            </div>
            <div class="col-md-2 col-sm-2  form-group has-feedback">
                <button type="button" class="btn btn-primary" onclick="printDiv('map')">Cetak <i class="fa fa-print"></i></button>
            </div>

        </div>
    </div>
</form>
<!-- leaftlet -->
<div id="map" style="height: 550px;"></div>
<!-- leaftlet -->
<script>
    // print bagian tertentu
    function printDiv(divName) {
        window.print();
    };
</script>