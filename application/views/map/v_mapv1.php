<?= content_open($subtitle) ?>
<!-- AWAL leaflet -->
<script>
       function initialize() {

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
                     layers: [osm]
              });

              var baseLayers = {
                     'OpenStreetMap': osm,
                     'Streets': streets
              };
              var layerControl = L.control.layers(baseLayers).addTo(map);


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

              function popUp(f, l) {
                     var out = [];
                     if (f.properties) {
                            for (key in f.properties) {
                                   out.push(key + ": <b>" + f.properties[key] + "</b>");
                            }
                            l.bindPopup(out.join("<br />"));
                     }
              }
              var jsonTest = new L.GeoJSON.AJAX(["<?= leaflet('geojson/bataskabokufull.geojson') ?>"], {
                     onEachFeature: popUp,
                     style: bataskecamatan
              }).addTo(map);
              // area pemukiman
              var areapemukiman = {
                     "color": "brown",
                     "weight": 1
              }

              function popUp(f, l) {
                     var out = [];
                     if (f.properties) {
                            for (key in f.properties) {
                                   out.push(key + ": <b>" + f.properties[key] + "</b>");
                            }
                            l.bindPopup(out.join("<br />"));
                     }
              }
              var jsonTest = new L.GeoJSON.AJAX(["<?= leaflet('geojson/pemukimanarea.geojson') ?>"], {
                     onEachFeature: popUp,
                     style: areapemukiman
              }).addTo(map);

              // end
              // create a red polygon from an array of LatLng points

              var KDTNPNJ = [
                     [-3.900014, 104.49569],
                     [-3.899674, 104.496219],
                     [-3.899334, 104.496879],
                     [-3.899064, 104.497598],
                     [-3.898989, 104.497697],
                     [-3.898826, 104.497796],
                     [-3.898253, 104.497936],
                     [-3.897977, 104.498157],
                     [-3.897306, 104.498453],
                     [-3.897054, 104.498656],
                     [-3.896883, 104.498863],
                     [-3.896733, 104.499204],
                     [-3.896738, 104.50007],
                     [-3.896872, 104.500534],
                     [-3.896829, 104.50072],
                     [-3.896666, 104.500792],
                     [-3.896511, 104.500703],
                     [-3.896201, 104.500889],
                     [-3.896032, 104.500931],
                     [-3.895861, 104.500913],
                     [-3.895411, 104.500628],
                     [-3.89513, 104.500255],
                     [-3.894929, 104.500172],
                     [-3.894648, 104.500322],
                     [-3.894509, 104.500517],
                     [-3.894517, 104.500955],
                     [-3.894207, 104.502377],
                     [-3.89418, 104.503029],
                     [-3.894038, 104.503562],
                     [-3.894044, 104.503753],
                     [-3.894113, 104.503941],
                     [-3.894418, 104.5044],
                     [-3.894437, 104.504625],
                     [-3.89437, 104.504928],
                     [-3.894028, 104.505701],
                     [-3.893888, 104.505872],
                     [-3.893645, 104.506031],
                     [-3.893482, 104.506208],
                     [-3.89319, 104.506725],
                     [-3.893094, 104.507002],
                     [-3.892955, 104.507681],
                     [-3.892813, 104.5087],
                     [-3.892417, 104.509585],
                     [-3.892352, 104.509829],
                     [-3.89228, 104.511053],
                     [-3.89197, 104.511922],
                     [-3.891962, 104.512668],
                     [-3.892031, 104.51347],
                     [-3.891988, 104.513915],
                     [-3.892045, 104.514468],
                     [-3.89201, 104.514683],
                     [-3.891188, 104.515997],
                     [-3.890985, 104.516663],
                     [-3.890913, 104.517135],
                     [-3.890953, 104.518165],
                     [-3.891308, 104.520101],
                     [-3.891506, 104.520482],
                     [-3.892582, 104.521137],
                     [-3.892742, 104.521308],
                     [-3.892833, 104.522092],
                     [-3.892774, 104.522612],
                     [-3.892319, 104.523583],
                     [-3.891884, 104.523926],
                     [-3.891764, 104.524098],
                     [-3.891595, 104.524817],
                     [-3.891111, 104.52578],
                     [-3.890051, 104.527376],
                     [-3.889066, 104.528592],
                     [-3.888237, 104.52926],
                     [-3.888023, 104.529405],
                     [-3.887544, 104.529592],
                     [-3.887172, 104.529847],
                     [-3.886955, 104.530073],
                     [-3.88631, 104.530942],
                     [-3.885844, 104.531009],
                     [-3.876069, 104.540121],
                     [-3.873197, 104.541508],
                     [-3.872483, 104.54161],
                     [-3.872501, 104.54202],
                     [-3.87244, 104.542603],
                     [-3.872534, 104.543193],
                     [-3.872362, 104.543775],
                     [-3.872341, 104.544102],
                     [-3.872887, 104.545774],
                     [-3.872972, 104.546206],
                     [-3.87313, 104.546447],
                     [-3.873358, 104.546984],
                     [-3.873387, 104.547397],
                     [-3.873304, 104.547609],
                     [-3.872895, 104.548019],
                     [-3.872215, 104.548465],
                     [-3.871862, 104.548915],
                     [-3.871503, 104.54957],
                     [-3.871375, 104.549629],
                     [-3.870949, 104.54964],
                     [-3.870719, 104.549688],
                     [-3.870211, 104.550004],
                     [-3.869882, 104.550455],
                     [-3.869681, 104.551292],
                     [-3.869523, 104.551636],
                     [-3.869322, 104.551789],
                     [-3.869285, 104.552019],
                     [-3.868969, 104.552516],
                     [-3.868578, 104.552674],
                     [-3.868279, 104.552891],
                     [-3.867891, 104.552998],
                     [-3.867719, 104.553275],
                     [-3.867393, 104.553583],
                     [-3.867278, 104.553787],
                     [-3.866464, 104.55449],
                     [-3.865857, 104.554801],
                     [-3.865736, 104.554834],
                     [-3.864891, 104.554721],
                     [-3.864484, 104.554783],
                     [-3.864323, 104.554852],
                     [-3.863234, 104.555638],
                     [-3.863031, 104.555842],
                     [-3.862932, 104.556035],
                     [-3.862924, 104.556156],
                     [-3.862969, 104.556961],
                     [-3.862865, 104.55724],
                     [-3.862552, 104.557699],
                     [-3.862541, 104.558144],
                     [-3.862627, 104.558595],
                     [-3.862972, 104.559316],
                     [-3.863167, 104.5601],
                     [-3.863504, 104.560701],
                     [-3.863628, 104.56102],
                     [-3.863681, 104.561704],
                     [-3.863868, 104.562251],
                     [-3.863788, 104.563807],
                     [-3.86352, 104.5648],
                     [-3.863411, 104.565449],
                     [-3.863376, 104.566877],
                     [-3.863025, 104.567574],
                     [-3.86283, 104.567802],
                     [-3.86207, 104.5681],
                     [-3.861832, 104.566678],
                     [-3.861687, 104.566364],
                     [-3.861171, 104.565954],
                     [-3.859581, 104.565253],
                     [-3.859265, 104.564996],
                     [-3.858931, 104.564392],
                     [-3.858618, 104.56333],
                     [-3.85839, 104.562938],
                     [-3.857874, 104.562353],
                     [-3.857558, 104.561755],
                     [-3.85743, 104.561098],
                     [-3.857561, 104.559805],
                     [-3.857454, 104.558922],
                     [-3.857274, 104.558485],
                     [-3.856889, 104.558141],
                     [-3.856252, 104.55786],
                     [-3.85565, 104.557777],
                     [-3.855061, 104.557916],
                     [-3.854772, 104.557862],
                     [-3.854505, 104.557707],
                     [-3.854398, 104.557516],
                     [-3.854232, 104.557465],
                     [-3.8541, 104.557141],
                     [-3.85098, 104.555885],
                     [-3.849647, 104.556177],
                     [-3.848877, 104.556418],
                     [-3.847488, 104.556373],
                     [-3.847086, 104.556257],
                     [-3.846816, 104.556276],
                     [-3.846412, 104.556426],
                     [-3.846128, 104.557033],
                     [-3.846093, 104.559987],
                     [-3.845925, 104.56033],
                     [-3.845229, 104.561036],
                     [-3.843583, 104.561913],
                     [-3.842336, 104.562076],
                     [-3.841153, 104.561926],
                     [-3.839716, 104.561548],
                     [-3.837653, 104.561395],
                     [-3.837334, 104.561036],
                     [-3.837118, 104.560944],
                     [-3.836561, 104.561095],
                     [-3.835453, 104.561797],
                     [-3.835351, 104.56205],
                     [-3.835271, 104.563174],
                     [-3.835129, 104.563324],
                     [-3.834776, 104.563319],
                     [-3.834243, 104.56305],
                     [-3.833772, 104.562943],
                     [-3.832686, 104.562304],
                     [-3.831567, 104.56294],
                     [-3.830788, 104.563946],
                     [-3.830577, 104.564571],
                     [-3.830601, 104.564799],
                     [-3.830775, 104.565202],
                     [-3.830711, 104.565537],
                     [-3.828963, 104.567447],
                     [-3.82877, 104.568051],
                     [-3.828848, 104.56892],
                     [-3.828749, 104.569368],
                     [-3.82835, 104.569883],
                     [-3.827547, 104.570264],
                     [-3.827499, 104.570511],
                     [-3.827644, 104.571252],
                     [-3.827606, 104.571418],
                     [-3.827213, 104.571842],
                     [-3.827165, 104.572247],
                     [-3.826801, 104.572513],
                     [-3.826426, 104.573108],
                     [-3.826183, 104.573285],
                     [-3.826006, 104.573304],
                     [-3.825754, 104.573248],
                     [-3.82481, 104.572735],
                     [-3.823852, 104.572534],
                     [-3.823814, 104.572424],
                     [-3.823838, 104.571946],
                     [-3.823659, 104.571625],
                     [-3.823581, 104.571233],
                     [-3.82345, 104.571104],
                     [-3.823284, 104.571123],
                     [-3.822473, 104.571893],
                     [-3.821566, 104.572054],
                     [-3.821194, 104.572408],
                     [-3.819834, 104.570989],
                     [-3.817918, 104.569623],
                     [-3.816767, 104.569261],
                     [-3.815577, 104.569197],
                     [-3.815269, 104.569076],
                     [-3.814482, 104.568496],
                     [-3.814163, 104.568075],
                     [-3.813323, 104.567284],
                     [-3.813157, 104.567007],
                     [-3.813029, 104.566573],
                     [-3.812836, 104.566286],
                     [-3.811618, 104.565452],
                     [-3.811351, 104.565138],
                     [-3.811153, 104.56542],
                     [-3.810832, 104.565645],
                     [-3.810427, 104.565736],
                     [-3.810197, 104.565887],
                     [-3.809962, 104.566463],
                     [-3.80982, 104.566635],
                     [-3.808937, 104.56674],
                     [-3.808008, 104.567534],
                     [-3.807687, 104.567596],
                     [-3.807572, 104.567673],
                     [-3.807492, 104.568819],
                     [-3.806421, 104.569564],
                     [-3.806239, 104.569942],
                     [-3.805966, 104.570986],
                     [-3.80569, 104.57134],
                     [-3.804323, 104.571681],
                     [-3.803595, 104.57196],
                     [-3.802829, 104.572443],
                     [-3.802324, 104.573044],
                     [-3.801143, 104.57343],
                     [-3.800597, 104.574015],
                     [-3.79965, 104.574345],
                     [-3.798095, 104.574774],
                     [-3.796743, 104.574704],
                     [-3.795804, 104.574914],
                     [-3.794522, 104.574991],
                     [-3.794396, 104.574753],
                     [-3.794343, 104.574753],
                     [-3.794313, 104.574919],
                     [-3.794137, 104.574876],
                     [-3.79399, 104.574924],
                     [-3.793893, 104.574718],
                     [-3.793425, 104.574779],
                     [-3.793465, 104.575128],
                     [-3.793441, 104.575201],
                     [-3.79335, 104.575211],
                     [-3.793286, 104.575163],
                     [-3.793262, 104.574895],
                     [-3.793163, 104.574847],
                     [-3.793104, 104.574895],
                     [-3.792981, 104.57527],
                     [-3.792708, 104.575386],
                     [-3.79237, 104.575367],
                     [-3.792253, 104.575549],
                     [-3.792022, 104.575477],
                     [-3.791918, 104.575209],
                     [-3.791856, 104.575236],
                     [-3.79184, 104.575439],
                     [-3.791533, 104.575485],
                     [-3.791294, 104.575311],
                     [-3.791134, 104.575851],
                     [-3.791021, 104.575873],
                     [-3.790505, 104.575446],
                     [-3.790459, 104.575615],
                     [-3.790652, 104.575854],
                     [-3.790208, 104.575865],
                     [-3.789223, 104.575854],
                     [-3.788878, 104.576297],
                     [-3.788078, 104.576474],
                     [-3.787515, 104.576519],
                     [-3.787114, 104.576433],
                     [-3.785867, 104.577064],
                     [-3.785845, 104.577193],
                     [-3.78592, 104.577407],
                     [-3.785321, 104.577539],
                     [-3.785051, 104.577887],
                     [-3.785037, 104.57837],
                     [-3.784925, 104.578821],
                     [-3.783809, 104.57921],
                     [-3.783137, 104.57972],
                     [-3.782909, 104.579712],
                     [-3.782931, 104.579452],
                     [-3.781566, 104.579092],
                     [-3.781437, 104.579124],
                     [-3.781124, 104.579497],
                     [-3.780974, 104.579508],
                     [-3.780969, 104.579409],
                     [-3.781159, 104.579205],
                     [-3.781148, 104.579089],
                     [-3.780763, 104.579012],
                     [-3.780284, 104.5791],
                     [-3.780313, 104.578918],
                     [-3.780166, 104.578961],
                     [-3.780137, 104.579114],
                     [-3.780287, 104.579382],
                     [-3.780265, 104.579564],
                     [-3.779433, 104.579481],
                     [-3.778911, 104.579801],
                     [-3.778472, 104.579866],
                     [-3.778386, 104.580016],
                     [-3.778558, 104.580241],
                     [-3.778536, 104.580531],
                     [-3.77814, 104.58066],
                     [-3.778012, 104.580799],
                     [-3.778087, 104.581229],
                     [-3.777851, 104.581443],
                     [-3.777626, 104.581433],
                     [-3.777187, 104.5811],
                     [-3.776609, 104.581196],
                     [-3.776138, 104.581443],
                     [-3.775078, 104.579662],
                     [-3.775003, 104.579469],
                     [-3.774971, 104.57846],
                     [-3.774693, 104.577505],
                     [-3.774661, 104.5764],
                     [-3.773719, 104.575241],
                     [-3.773601, 104.574339],
                     [-3.77267, 104.572011],
                     [-3.771503, 104.570822],
                     [-3.771449, 104.569921],
                     [-3.771117, 104.569406],
                     [-3.77101, 104.56889],
                     [-3.77075, 104.568451],
                     [-3.770557, 104.567764],
                     [-3.769872, 104.567678],
                     [-3.768844, 104.567185],
                     [-3.767838, 104.565704],
                     [-3.767923, 104.564609],
                     [-3.768801, 104.562849],
                     [-3.768694, 104.561046],
                     [-3.769358, 104.560617],
                     [-3.769915, 104.559673],
                     [-3.771521, 104.5586],
                     [-3.769551, 104.554715],
                     [-3.769636, 104.552011],
                     [-3.770129, 104.55126],
                     [-3.772034, 104.549564],
                     [-3.772591, 104.548319],
                     [-3.772548, 104.54671],
                     [-3.771435, 104.545899],
                     [-3.77045, 104.545706],
                     [-3.769658, 104.546135],
                     [-3.768951, 104.546114],
                     [-3.768266, 104.544504],
                     [-3.76696, 104.544397],
                     [-3.766211, 104.543882],
                     [-3.765932, 104.539139],
                     [-3.767495, 104.538366],
                     [-3.767174, 104.53373],
                     [-3.767388, 104.532292],
                     [-3.768416, 104.53075],
                     [-3.770129, 104.530986],
                     [-3.773062, 104.533025],
                     [-3.776402, 104.533669],
                     [-3.776702, 104.53339],
                     [-3.776745, 104.532896],
                     [-3.773341, 104.531651],
                     [-3.769144, 104.526953],
                     [-3.76878, 104.526009],
                     [-3.771221, 104.523026],
                     [-3.773597, 104.51839],
                     [-3.777473, 104.515729],
                     [-3.777537, 104.515299],
                     [-3.77606, 104.513496],
                     [-3.778915, 104.503579],
                     [-3.783132, 104.495296],
                     [-3.786708, 104.496366],
                     [-3.789577, 104.494134],
                     [-3.791847, 104.489369],
                     [-3.796771, 104.487266],
                     [-3.798484, 104.485348],
                     [-3.804821, 104.482258],
                     [-3.808804, 104.476849],
                     [-3.809232, 104.474231],
                     [-3.811801, 104.471956],
                     [-3.812615, 104.468865],
                     [-3.817068, 104.466419],
                     [-3.818481, 104.463457],
                     [-3.820494, 104.462348],
                     [-3.834239, 104.460459],
                     [-3.836551, 104.460931],
                     [-3.836465, 104.46209],
                     [-3.837836, 104.462477],
                     [-3.838906, 104.464752],
                     [-3.843916, 104.466125],
                     [-3.847299, 104.463807],
                     [-3.851067, 104.465739],
                     [-3.853379, 104.469001],
                     [-3.862499, 104.471577],
                     [-3.864683, 104.473465],
                     [-3.868194, 104.472736],
                     [-3.873332, 104.476041],
                     [-3.87346, 104.47926],
                     [-3.875216, 104.479818],
                     [-3.878641, 104.478402],
                     [-3.880611, 104.479861],
                     [-3.88348, 104.480204],
                     [-3.88455, 104.481836],
                     [-3.886434, 104.482866],
                     [-3.892942, 104.490077],
                     [-3.900014, 104.49569]
              ];
              var polygon = L.polygon(KDTNPNJ, {
                     color: 'green'
              }).addTo(map).bindPopup('Kedaton Peninjauan Raya');



              <?php foreach ($datatabel1->result() as $key) {
                     if ($key->latitude != null or $key->longitude != null) {
              ?>

                            // L.marker([<?= $key->latitude; ?>, <?= $key->longitude; ?>])
                            //        .bindPopup('<h5><?= $key->kode_menara; ?></h5></br>Koordinat : <?= $key->latitude; ?>, <?= $key->longitude; ?></br>Site ID : <?= $key->site_id; ?> </br>Tipe : <?= $key->kode_jenis_menara; ?> </br>Pemilik : <?= $key->kode_provider; ?>')
                            //        .addTo(map);

                            // // konversi dbm ke watt
                            // var dbm2 = -85;
                            // var pangkat2 = (dbm2 - 30) / 10;
                            // var watt2 = Math.pow(10, pangkat2);

                            // var pr2 = watt2;
                            // var pt2 = 4;
                            // var hb2 = <?= $key->tinggi_menara; ?>;
                            // var hm2 = 1;

                            // var d42 = pt2 * ((Math.pow(hb2, 2) * Math.pow(hm2, 2)) / pr2);
                            // var d2 = Math.sqrt(Math.sqrt(d42));
                            // // ---------------------------------
                            // L.circle([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                            //               fillColor: 'red',
                            //               fillOpacity: 0.05,
                            //               radius: d2,
                            //               stroke: false
                            //        })
                            //        .addTo(map);



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
                                   .addTo(map);
                            // var mGreen = L.marker([<?= $key->latitude; ?>, <?= $key->longitude; ?>]).addTo(map);

                            // // konversi dbm ke watt
                            // var dbm = -75;
                            // var pangkat = (dbm - 30) / 10;
                            // var watt = Math.pow(10, pangkat);

                            // var pr = watt;
                            // var pt = 4;
                            // var hb = <?= $key->tinggi_menara; ?>;
                            // var hm = 1;

                            // var d4 = pt * ((Math.pow(hb, 2) * Math.pow(hm, 2)) / pr);
                            // var d = Math.sqrt(Math.sqrt(d4));
                            // // document.write(d + ' => radius; '+);

                            // L.circle([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                            //               fillColor: 'black',
                            //               fillOpacity: 0.1,
                            //               radius: d,
                            //               stroke: false
                            //        })
                            //        .addTo(map);



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
                            <?php } else { ?>
                                   L.circle([<?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?>], {
                                          color: 'blue',
                                          radius: 400
                                   })
                            <?php } ?>
                                   .bindPopup('<h5><?= $Dzona->site_id; ?></h5></br>Koordinat : <?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?></br>Site ID : <?= $Dzona->site_id; ?> </br>Status : <?= $Dzona->status; ?> </br>Kecamatan : <?= $Dzona->kode_kecamatan; ?> </br>Jumlah Menara : <?= $Dzona->jumlah_menara; ?>')
                                   .addTo(map);

              <?php }
              } ?>


              // -----------------------




              var popup = L.popup()
                     .setLatLng([-4.081699, 104.092704])
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

<form method="post" action="<?= site_url('map_v1') ?>">
       <label>

              <div class="input-group">
                     <select class="select2_single form-control" name="kat" tabindex="-1">
                            <option value="<?= $prov; ?>"><?= $prov; ?></option>
                            <?php foreach ($datatabel2->result() as $pro) { ?>
                                   <option value="<?= $pro->kode_kecamatan; ?>"><?= $pro->nama_kecamatan; ?></option>
                            <?php } ?>
                     </select>
                     <select class="select2_single form-control" name="thn" tabindex="-1">
                            <option value="<?= $thn; ?>"><?= $thn; ?></option>
                            <?php foreach ($tahun->result() as $thn) { ?>
                                   <option value="<?= $thn->sumber_data; ?>"><?= $thn->sumber_data; ?></option>
                            <?php } ?>
                     </select>
                     <span class="input-group-btn">
                            <button type="submit" class="btn btn-success" name="cat">Go!</button>
                     </span>
              </div>
       </label>

</form>
<!-- leaftlet -->

<div id="map" style="height: 650px;"></div>
<!-- leaftlet -->




<?= content_close() ?>