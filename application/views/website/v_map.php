<!-- AWAL leaflet -->
<script>
    function initialize() {

        var zonaeksisting = L.layerGroup();
        var zonanew = L.layerGroup();
        var menara = L.layerGroup();
        var kecoku = L.layerGroup();
        var atribut = L.layerGroup();

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
            layers: [osm, kecoku, menara, zonanew, zonaeksisting, atribut] //ini adalah memilih layer yang aktif ketika akses pertama
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

        // -----------------------

        var popup = L.popup()
            .setLatLng([-3.696928, 103.52829])
            .setContent('')
            .openOn(map);

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent('You clicked the map at ' + e.latlng.toString())
                .openOn(map);
        }

        map.on('click', onMapClick);
    };
</script>
<!-- //batas LEAFLET -->
<a href="<?= site_url(); ?>"><span class="badge badge-primary"><i class="fa fa-home"></i> Back to Home</span></a>
<form method="post" action="<?= site_url('beranda/map') ?>">
    <div class="col-sm-6">
        <div class="input-group">
            <select class="form-control col-sm-6" name="kat" style="display: inline-block;">
                <option value="semua">Semua</option>
                <?php foreach ($datakec->result() as $pro) { ?>
                    <option value="<?= $pro->kode_kecamatan; ?>" <?php if ($pro->kode_kecamatan == $prov) {
                                                                        echo 'selected';
                                                                    } ?>><i class="fa fa-plus"><?= $pro->nama_kecamatan; ?></i></option>
                <?php } ?>
            </select>
            <select class="form-control col-sm-2" name="thn" style="display: inline-block;">
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
                <button type="submit" class="btn btn-success" name="cat">GO! <i class="fa fa-spin fa-refresh"></i></button>
            </span>
            <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="printDiv('map')">Cetak <i class="fa fa-print"></i></button></span>
        </div>
    </div>
</form>
<!-- leaftlet -->
<div id="map" style="height: 550px;"></div>
<!-- leaftlet -->
<script>
    // print bagian tertentu
    function printDivonly(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    };
    // print all content
    function printDiv(divName) {
        window.print();
    };
</script>