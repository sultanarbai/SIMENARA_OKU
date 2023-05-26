<?= content_open($subtitle) ?>

<script>
       function initialize() {

              var locations = [

                     ['<?= $latitude; ?>, <?= $longitude; ?> <br>Radius 3 km (besar)<br>Radius 100 m (kecil)', <?= $latitude; ?>, <?= $longitude; ?>, '<?= template("images/tessmenara.png"); ?>'],
              ];


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
              var crownHill = L.marker([39.75, -105.09]).bindPopup('This is Crown Hill Park.');
              var rubyHill = L.marker([39.68, -105.00]).bindPopup('This is Ruby Hill Park.');


              var satellite = L.tileLayer(mbUrl, {
                     id: 'mapbox/satellite-v9',
                     tileSize: 512,
                     zoomOffset: -1,
                     attribution: mbAttr
              });
              layerControl.addBaseLayer(satellite, 'Satellite');



              // create a red polygon from an array of LatLng points
              var latlngs = [
                     [-4.354757, 104.216303],
                     [-4.402682, 104.158281],
                     [-4.425274, 104.108843],
                     [-4.436912, 104.098200],
                     [-4.445469, 104.063181],
                     [-4.458134, 104.045328],
                     [-4.455396, 104.026789],
                     [-4.445127, 104.013743],
                     [-4.449919, 103.995546],
                     [-4.460872, 103.985933],
                     [-4.465664, 103.971171],
                     [-4.457107, 103.960184],
                     [-4.444442, 103.952631],
                     [-4.421166, 103.925509],
                     [-4.397547, 103.907313],
                     [-4.383170, 103.903193],
                     [-4.381458, 103.898386],
                     [-4.382143, 103.890146],
                     [-4.379404, 103.881907],
                     [-4.379747, 103.864054],
                     [-4.376666, 103.851008],
                     [-4.360234, 103.853411],
                     [-4.291423, 103.846201],
                     [-4.261979, 103.835558],
                     [-4.230823, 103.812555],
                     [-4.210279, 103.798823],
                     [-4.216100, 103.791269],
                     [-4.229453, 103.760370],
                     [-4.251366, 103.731875],
                     [-4.264718, 103.716768],
                     [-4.284918, 103.698916],
                     [-4.287315, 103.636774],
                     [-4.306144, 103.627161],
                     [-4.305460, 103.621668],
                     [-4.291423, 103.624758],
                     [-4.285004, 103.624758],
                     [-4.263520, 103.626560],
                     [-4.247771, 103.617806],
                     [-4.225002, 103.616432],
                     [-4.221236, 103.617462],
                     [-4.218668, 103.619179],
                     [-4.215929, 103.621582],
                     [-4.213703, 103.621754],
                     [-4.213874, 103.625015],
                     [-4.212162, 103.631367],
                     [-4.212676, 103.633598],
                     [-4.209594, 103.642182],
                     [-4.203774, 103.647331],
                     [-4.200863, 103.646301],
                     [-4.198466, 103.646816],
                     [-4.197782, 103.648361],
                     [-4.193673, 103.666386],
                     [-4.183572, 103.690762],
                     [-4.183229, 103.705696],
                     [-4.089747, 103.704151],
                     [-4.085123, 103.704838],
                     [-4.084781, 103.707584],
                     [-4.085466, 103.710331],
                     [-4.084267, 103.746895],
                     [-4.070055, 103.768009],
                     [-4.069713, 103.770241],
                     [-4.057384, 103.778481],
                     [-4.046426, 103.788437],
                     [-4.038207, 103.792429],
                     [-4.034097, 103.800153],
                     [-4.031357, 103.814230],
                     [-4.026905, 103.820238],
                     [-4.018343, 103.825731],
                     [-4.014405, 103.830709],
                     [-4.014233, 103.835172],
                     [-4.006185, 103.842725],
                     [-4.007384, 103.846845],
                     [-4.006699, 103.849248],
                     [-4.000534, 103.851480],
                     [-3.995739, 103.854913],
                     [-3.994198, 103.856973],
                     [-3.993513, 103.861436],
                     [-3.988205, 103.868990],
                     [-3.982725, 103.871564],
                     [-3.978272, 103.874998],
                     [-3.972964, 103.876028],
                     [-3.971080, 103.878259],
                     [-3.969881, 103.882379],
                     [-3.967484, 103.887872],
                     [-3.964572, 103.890791],
                     [-3.960120, 103.892335],
                     [-3.954982, 103.891992],
                     [-3.950530, 103.890276],
                     [-3.941624, 103.892679],
                     [-3.939741, 103.894567],
                     [-3.936487, 103.894224],
                     [-3.929123, 103.891821],
                     [-3.924670, 103.892850],
                     [-3.921930, 103.907785],
                     [-3.918505, 103.915510],
                     [-3.916621, 103.922720],
                     [-3.914394, 103.928041],
                     [-3.910798, 103.931818],
                     [-3.901892, 103.936452],
                     [-3.897439, 103.940057],
                     [-3.895555, 103.944692],
                     [-3.893672, 103.957395],
                     [-3.891616, 103.961858],
                     [-3.888534, 103.965635],
                     [-3.892473, 103.971300],
                     [-3.909942, 103.986406],
                     [-3.919703, 103.994817],
                     [-3.914737, 104.011812],
                     [-3.913196, 104.015073],
                     [-3.913709, 104.023141],
                     [-3.911654, 104.025373],
                     [-3.908058, 104.026575],
                     [-3.908058, 104.029321],
                     [-3.910455, 104.033269],
                     [-3.908914, 104.038591],
                     [-3.910284, 104.042024],
                     [-3.908229, 104.045629],
                     [-3.906688, 104.045801],
                     [-3.905660, 104.047174],
                     [-3.905489, 104.049577],
                     [-3.904632, 104.062624],
                     [-3.905489, 104.071722],
                     [-3.906859, 104.073953],
                     [-3.905660, 104.075670],
                     [-3.903091, 104.077043],
                     [-3.902406, 104.079961],
                     [-3.899837, 104.082536],
                     [-3.895898, 104.084425],
                     [-3.895042, 104.088716],
                     [-3.898467, 104.105882],
                     [-3.892301, 104.122533],
                     [-3.895213, 104.123048],
                     [-3.887506, 104.137296],
                     [-3.884594, 104.147253],
                     [-3.874661, 104.156522],
                     [-3.863186, 104.179182],
                     [-3.857363, 104.186563],
                     [-3.851711, 104.188966],
                     [-3.847086, 104.193430],
                     [-3.845031, 104.198064],
                     [-3.847429, 104.202528],
                     [-3.847429, 104.205618],
                     [-3.845887, 104.208192],
                     [-3.843661, 104.209909],
                     [-3.841434, 104.210252],
                     [-3.839721, 104.209222],
                     [-3.837152, 104.209222],
                     [-3.832699, 104.210424],
                     [-3.825386, 104.209995],
                     [-3.818192, 104.215317],
                     [-3.816651, 104.220638],
                     [-3.808943, 104.225788],
                     [-3.804832, 104.229221],
                     [-3.801920, 104.234200],
                     [-3.799694, 104.235745],
                     [-3.785648, 104.236260],
                     [-3.782736, 104.239178],
                     [-3.777940, 104.256172],
                     [-3.773829, 104.262352],
                     [-3.772802, 104.265270],
                     [-3.767492, 104.272480],
                     [-3.765950, 104.276257],
                     [-3.754816, 104.287930],
                     [-3.756700, 104.290676],
                     [-3.771603, 104.302521],
                     [-3.773315, 104.307327],
                     [-3.771431, 104.310417],
                     [-3.772459, 104.312992],
                     [-3.771089, 104.316597],
                     [-3.771431, 104.319000],
                     [-3.770232, 104.320545],
                     [-3.766806, 104.321919],
                     [-3.763723, 104.329643],
                     [-3.762182, 104.330502],
                     [-3.760126, 104.334793],
                     [-3.767492, 104.346638],
                     [-3.766635, 104.349041],
                     [-3.767492, 104.350414],
                     [-3.766464, 104.355221],
                     [-3.768862, 104.360199],
                     [-3.767663, 104.362774],
                     [-3.765607, 104.363976],
                     [-3.765779, 104.367580],
                     [-3.763381, 104.370155],
                     [-3.764408, 104.372730],
                     [-3.763381, 104.374962],
                     [-3.763209, 104.380970],
                     [-3.769204, 104.379425],
                     [-3.783935, 104.406376],
                     [-3.784620, 104.410324],
                     [-3.773487, 104.436588],
                     [-3.774172, 104.442253],
                     [-3.770575, 104.452381],
                     [-3.776056, 104.462853],
                     [-3.775713, 104.464226],
                     [-3.760297, 104.459076],
                     [-3.760297, 104.460278],
                     [-3.760982, 104.460964],
                     [-3.761154, 104.464741],
                     [-3.764408, 104.470921],
                     [-3.764408, 104.472294],
                     [-3.765093, 104.472637],
                     [-3.764922, 104.474697],
                     [-3.765779, 104.474697],
                     [-3.765607, 104.477100],
                     [-3.767663, 104.480877],
                     [-3.768005, 104.485169],
                     [-3.771260, 104.486027],
                     [-3.773315, 104.489632],
                     [-3.770917, 104.493580],
                     [-3.770232, 104.496327],
                     [-3.786505, 104.499588],
                     [-3.786333, 104.505596],
                     [-3.790444, 104.510574],
                     [-3.791472, 104.513493],
                     [-3.793527, 104.529972],
                     [-3.795583, 104.538212],
                     [-3.800893, 104.551430],
                     [-3.805860, 104.556236],
                     [-3.809114, 104.555721],
                     [-3.818192, 104.557781],
                     [-3.822817, 104.557953],
                     [-3.825043, 104.557781],
                     [-3.839259, 104.543533],
                     [-3.843199, 104.537010],
                     [-3.851762, 104.531517],
                     [-3.852105, 104.528771],
                     [-3.855359, 104.523106],
                     [-3.865807, 104.514179],
                     [-3.869061, 104.509716],
                     [-3.871459, 104.508858],
                     [-3.878481, 104.510403],
                     [-3.883619, 104.508858],
                     [-3.891154, 104.510059],
                     [-3.892867, 104.509544],
                     [-3.906397, 104.511089],
                     [-3.909822, 104.512119],
                     [-3.920954, 104.512119],
                     [-3.935340, 104.505253],
                     [-3.944759, 104.491348],
                     [-3.944245, 104.487915],
                     [-3.944588, 104.485855],
                     [-3.948698, 104.484310],
                     [-3.953493, 104.477444],
                     [-3.952123, 104.471607],
                     [-3.951951, 104.464054],
                     [-3.954691, 104.460964],
                     [-3.952636, 104.458218],
                     [-3.953835, 104.456673],
                     [-3.953664, 104.454098],
                     [-3.956233, 104.453926],
                     [-3.957432, 104.451180],
                     [-3.958802, 104.449463],
                     [-3.958802, 104.447231],
                     [-3.963083, 104.441910],
                     [-3.972502, 104.437447],
                     [-3.973872, 104.435043],
                     [-3.979180, 104.429894],
                     [-3.979180, 104.423714],
                     [-3.977297, 104.417877],
                     [-3.978324, 104.414787],
                     [-3.977982, 104.412899],
                     [-3.982091, 104.404831],
                     [-3.985516, 104.402599],
                     [-3.999901, 104.404144],
                     [-4.000757, 104.401569],
                     [-4.004011, 104.399853],
                     [-4.005552, 104.395905],
                     [-4.004353, 104.395218],
                     [-4.005894, 104.389081],
                     [-4.005638, 104.387965],
                     [-4.006751, 104.386249],
                     [-4.007093, 104.384017],
                     [-4.007778, 104.383760],
                     [-4.007949, 104.383159],
                     [-4.008634, 104.383159],
                     [-4.009405, 104.382472],
                     [-4.009576, 104.381614],
                     [-4.010689, 104.381013],
                     [-4.010518, 104.380069],
                     [-4.011374, 104.379640],
                     [-4.011888, 104.378781],
                     [-4.010946, 104.376292],
                     [-4.010004, 104.375949],
                     [-4.010518, 104.374919],
                     [-4.011802, 104.374318],
                     [-4.011032, 104.372602],
                     [-4.010604, 104.372602],
                     [-4.010604, 104.372602],
                     [-4.010261, 104.370627],
                     [-4.009491, 104.370284],
                     [-4.009833, 104.369083],
                     [-4.009148, 104.368739],
                     [-4.009491, 104.367881],
                     [-4.009148, 104.367108],
                     [-4.009319, 104.366336],
                     [-4.008806, 104.365735],
                     [-4.009062, 104.365220],
                     [-4.008121, 104.365306],
                     [-4.008463, 104.363675],
                     [-4.009148, 104.363761],
                     [-4.008720, 104.362903],
                     [-4.009062, 104.361529],
                     [-4.008121, 104.359984],
                     [-4.008549, 104.359469],
                     [-4.008121, 104.359212],
                     [-4.009491, 104.357152],
                     [-4.009062, 104.356637],
                     [-4.010518, 104.356465],
                     [-4.011717, 104.354577],
                     [-4.012915, 104.354405],
                     [-4.013600, 104.351659],
                     [-4.015398, 104.351573],
                     [-4.016083, 104.350801],
                     [-4.017111, 104.350972],
                     [-4.018994, 104.350286],
                     [-4.022077, 104.351230],
                     [-4.022933, 104.349685],
                     [-4.025758, 104.348655],
                     [-4.026871, 104.349084],
                     [-4.031238, 104.347539],
                     [-4.034149, 104.345222],
                     [-4.036803, 104.345307],
                     [-4.039115, 104.343162],
                     [-4.041940, 104.342475],
                     [-4.043481, 104.343076],
                     [-4.044937, 104.342389],
                     [-4.047591, 104.343333],
                     [-4.052813, 104.339557],
                     [-4.054697, 104.339128],
                     [-4.055467, 104.336553],
                     [-4.056238, 104.334922],
                     [-4.058378, 104.334836],
                     [-4.059919, 104.333549],
                     [-4.060176, 104.332347],
                     [-4.061289, 104.332690],
                     [-4.062060, 104.332175],
                     [-4.064200, 104.327455],
                     [-4.066512, 104.324880],
                     [-4.068224, 104.324193],
                     [-4.069680, 104.322047],
                     [-4.069680, 104.320588],
                     [-4.071477, 104.318957],
                     [-4.072419, 104.318013],
                     [-4.071906, 104.316211],
                     [-4.072419, 104.315009],
                     [-4.074731, 104.313979],
                     [-4.075073, 104.312949],
                     [-4.074217, 104.311318],
                     [-4.076357, 104.308143],
                     [-4.078070, 104.308829],
                     [-4.081837, 104.308057],
                     [-4.083635, 104.308486],
                     [-4.087487, 104.313979],
                     [-4.089884, 104.314065],
                     [-4.091511, 104.315009],
                     [-4.092025, 104.316297],
                     [-4.096648, 104.320073],
                     [-4.099302, 104.318614],
                     [-4.099473, 104.317498],
                     [-4.101956, 104.317069],
                     [-4.103154, 104.315782],
                     [-4.107349, 104.316897],
                     [-4.108719, 104.316640],
                     [-4.109575, 104.315353],
                     [-4.113598, 104.313893],
                     [-4.115824, 104.315181],
                     [-4.119934, 104.315524],
                     [-4.120961, 104.316211],
                     [-4.122930, 104.316125],
                     [-4.125070, 104.317069],
                     [-4.125156, 104.320846],
                     [-4.131748, 104.323335],
                     [-4.132176, 104.324966],
                     [-4.133973, 104.324708],
                     [-4.134059, 104.323506],
                     [-4.134829, 104.323678],
                     [-4.135343, 104.322648],
                     [-4.139795, 104.324451],
                     [-4.141336, 104.327197],
                     [-4.145188, 104.325824],
                     [-4.147927, 104.327369],
                     [-4.148441, 104.325824],
                     [-4.150153, 104.324794],
                     [-4.150324, 104.325910],
                     [-4.151437, 104.324279],
                     [-4.154947, 104.324622],
                     [-4.154604, 104.325910],
                     [-4.157601, 104.325652],
                     [-4.157515, 104.326854],
                     [-4.167359, 104.328828],
                     [-4.168301, 104.329858],
                     [-4.175577, 104.332690],
                     [-4.177889, 104.335694],
                     [-4.179686, 104.334750],
                     [-4.179002, 104.333549],
                     [-4.184566, 104.331403],
                     [-4.185850, 104.329686],
                     [-4.188332, 104.329343],
                     [-4.191071, 104.326167],
                     [-4.194239, 104.325910],
                     [-4.194923, 104.326768],
                     [-4.196550, 104.326854],
                     [-4.197834, 104.325910],
                     [-4.197834, 104.323678],
                     [-4.199375, 104.323249],
                     [-4.198947, 104.320159],
                     [-4.200231, 104.319129],
                     [-4.199803, 104.317412],
                     [-4.202799, 104.314923],
                     [-4.200659, 104.312606],
                     [-4.199631, 104.308143],
                     [-4.200402, 104.306769],
                     [-4.199375, 104.303508],
                     [-4.199717, 104.301963],
                     [-4.201001, 104.301190],
                     [-4.200915, 104.299989],
                     [-4.201600, 104.299131],
                     [-4.202542, 104.299045],
                     [-4.204083, 104.295783],
                     [-4.205623, 104.296212],
                     [-4.204767, 104.294324],
                     [-4.208705, 104.293466],
                     [-4.208962, 104.292178],
                     [-4.212814, 104.288659],
                     [-4.212471, 104.286513],
                     [-4.218720, 104.283252],
                     [-4.231046, 104.283938],
                     [-4.239092, 104.282222],
                     [-4.240205, 104.280334],
                     [-4.241660, 104.273467],
                     [-4.240718, 104.267716],
                     [-4.241146, 104.265142],
                     [-4.239862, 104.261108],
                     [-4.239948, 104.258704],
                     [-4.244142, 104.253297],
                     [-4.244827, 104.249520],
                     [-4.246625, 104.246345],
                     [-4.235494, 104.231976],
                     [-4.235836, 104.224767],
                     [-4.274867, 104.232320],
                     [-4.352581, 104.219273]
              ];

              var polygon = L.polyline(latlngs, {
                     color: 'blue'
              }).addTo(map).bindPopup('ini Batas Kabupaten Oku');


              // zoom the map to the polygon
              map.fitBounds(polygon.getBounds());

              // mulai

              // menampilkan zona
              <?php foreach ($zona->result() as $Dzona) {
                     if ($Dzona->latitude != null or $Dzona->longitude != null) {


              ?>

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
                                   .bindPopup('<h5><?= $Dzona->status; ?>,<?= $Dzona->site_id; ?></h5></br><?= $Dzona->latitude; ?>, <?= $Dzona->longitude; ?>')
                                   .addTo(map);

              <?php }
              } ?>


              for (i = 0; i < locations.length; i++) {
                     L.marker([locations[i][1], locations[i][2]])
                            .bindPopup('lokasi awal')
                            .addTo(map);


              };


              // perhitungan harvesain
              // Converts numeric degrees to radians
              function toRad(Value) {
                     return Value * Math.PI / 180;
              };

              var temp = 1000;
              var latt = 0;
              var longg = 0;
              var temp1 = 1000;
              var latt1 = 0;
              var longg1 = 0;
              var temp2 = 1000;
              var latt2 = 0;
              var longg2 = 0;
              // error
              var site_id;
              var site_id1 = '';
              var site_id2;
              // 
              <?php foreach ($zona_rekomendasi->result() as $key) {
                     if ($key->latitude != null or $key->longitude != null) {
              ?>

                            var R = 6371; // km
                            var lat1 = <?= $latitude; ?>;
                            var lon1 = <?= $longitude; ?>;
                            var dLat = toRad(<?= $key->latitude; ?> - lat1);
                            var dLon = toRad(<?= $key->longitude; ?> - lon1);
                            var lat1 = toRad(lat1);
                            var lat2 = toRad(<?= $key->latitude; ?>);

                            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                   Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
                            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                            var d = R * c;
                            if (<?= $key->status ?> == 'new') {
                                   // jika jarak antar tower lebih dekat
                                   if (d < temp) {
                                          temp = d;
                                          latt = <?= $key->latitude; ?>;
                                          longg = <?= $key->longitude; ?>;
                                          site_id = '<?= $key->site_id; ?>';

                                   }
                            }
                            if (<?= $key->jumlah_menara ?> == 1) {
                                   // jika jarak antar tower lebih dekat
                                   if (d < temp1) {
                                          temp1 = d;
                                          latt1 = <?= $key->latitude; ?>;
                                          longg1 = <?= $key->longitude; ?>;
                                          site_id1 = '<?= $key->site_id; ?>';

                                   }
                            }
                            if (<?= $key->jumlah_menara ?> == 2) {
                                   // jika jarak antar tower lebih dekat
                                   if (d < temp2) {
                                          temp2 = d;
                                          latt2 = <?= $key->latitude; ?>;
                                          longg2 = <?= $key->longitude; ?>;
                                          site_id2 = '<?= $key->site_id; ?>';
                                   }
                            }







              <?php }
              } ?>

              // tampilkan garis
              // tampilkan jarak dan garisnya
              var jarakgaris = [
                     [<?= $latitude; ?>, <?= $longitude; ?>],
                     [latt, longg]
              ];
              var garisjarak = L.polyline(jarakgaris, {
                     color: 'green'
              }).addTo(map).bindPopup('jarak nya : ' + temp + 'Km');
              // var jarakgaris1 = [
              //        [<?= $latitude; ?>, <?= $longitude; ?>],
              //        [latt1, longg1]
              // ];
              // var garisjarak1 = L.polyline(jarakgaris1, {
              //        color: 'green'
              // }).addTo(map).bindPopup('jarak nya : ' + temp1 + 'Km');
              // var jarakgaris2 = [
              //        [<?= $latitude; ?>, <?= $longitude; ?>],
              //        [latt2, longg2]
              // ];
              // var garisjarak2 = L.polyline(jarakgaris2, {
              //        color: 'green'
              // }).addTo(map).bindPopup('jarak nya : ' + temp2 + 'Km');

              // perhitungan midpoint formulla
              var x1 = <?= $latitude; ?>;
              var y1 = <?= $longitude; ?>;
              var x2 = latt;
              var y2 = longg;
              var range = temp;
              var radius = 0.195; //kilometer sesuai ketentuan

              var xtemp = 0;
              var ytemp = 0;

              var rangetemp = 0;

              var pembagi = 2;
              var R = 6371; // km

              while (range > radius) {

                     xtemp = (x1 + x2) / 2;
                     ytemp = (y1 + y2) / 2;


                     var dLat = toRad(x2 - xtemp);
                     var dLon = toRad(y2 - ytemp);
                     var lat1 = toRad(xtemp);
                     var lat2 = toRad(x2);

                     var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                            Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
                     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                     var d = R * c;

                     if (d > radius) {
                            x1 = xtemp;
                            y1 = ytemp;
                            rangetemp = d;
                     }
                     range = d;
                     // if (pembagi <= 1) {
                     //        range = 0;
                     // }
              }



              var latitudezona2 = 0;
              var longitudezona2 = 0;
              var site_idxxx
              <?php



              foreach ($datatabel1->result() as $kuy) {
                     if ($kuy->site_id != null) {
              ?>
                            site_idxxx = '<?= $kuy->site_id ?>';
                            if (site_id1 == '<?= $kuy->site_id ?>') {
                                   latitudezona2 = <?= $kuy->latitude ?>;
                                   longitudezona2 = <?= $kuy->longitude ?>;
                            }
                            // document.write('[' + site_idxxx + '=' + site_id1 + ']');
              <?php }
              } ?>


              // perhitungan midpoint formulla rekomendasi alternatif 1
              var a1 = latt1;
              var b1 = longg1;

              var a2 = latitudezona2;
              var b2 = longitudezona2;
              var radius1 = 0.200; //kilometer sesuai ketentuan

              var atemp = 0;
              var btemp = 0;

              var rangetemp1 = 0;

              var pembagi1 = 2;
              var R = 6371; // km

              var dLat = toRad(a2 - a1);
              var dLon = toRad(b2 - b1);
              var lat1 = toRad(a1);
              var lat2 = toRad(a2);

              var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                     Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
              var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
              var d = R * c;
              var range1 = d;
              if (d < radius1) {
                     while (range1 < radius1) {

                            atemp = (a1 + a2) / 2.00003;
                            btemp = (b1 + b2) / 2.00003;


                            var dLat = toRad(a2 - atemp);
                            var dLon = toRad(b2 - btemp);
                            var lat1 = toRad(atemp);
                            var lat2 = toRad(a2);

                            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                   Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
                            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                            var d = R * c;

                            if (d > radius1) {
                                   a1 = atemp;
                                   b1 = btemp;
                                   rangetemp1 = d;
                                   range1 = d;
                            } else {
                                   a1 = atemp;
                                   b1 = btemp;
                                   rangetemp1 = d;
                                   range1 = d + radius1;
                            }


                            // if (pembagi <= 1) {
                            //        range = 0;
                            // }
                     }
              } else if (d >= radius1) {
                     rangetemp1 = d;
              }


              // amiasi bayangan
              var LeafIcon = L.Icon.extend({
                     options: {
                            shadowUrl: "<?= templatefile('leaf-shadow.png') ?>",
                            iconSize: [38, 95],
                            shadowSize: [50, 64],
                            iconAnchor: [22, 94],
                            shadowAnchor: [4, 62],
                            popupAnchor: [-3, -76]
                     }
              });

              // menampilkan ikon rekomendasi 1
              var greenIcon = new LeafIcon({
                     iconUrl: "<?= templatefile('leaf-green.png') ?>"
              });
              var mGreen = L.marker([x1, y1], {
                     icon: greenIcon
              }).bindPopup('Hasil Analisa Rekomendasi <br> lat:<h5> ' + x1 + '</h5>  <br>long:<h5>' + y1 + '</h5>. <br>Silahkan untuk menggunakan koordinat hasil analisa rekomendasi tersebut untuk melakukan pengajuan surat rekomendasi').addTo(map);

              var latlngs = [
                     [x1, y1],
                     [x2, y2]
              ];
              var polyline = L.polyline(latlngs, {
                     color: 'red'
              }).addTo(map).bindPopup('jarak nya : ' + rangetemp + 'Km');

              // // menampilkan hasil rekomendasi alternatif 1
              // var yellowIcon = new LeafIcon({
              //        iconUrl: "<?= templatefile('leaf-orange.png') ?>"
              // });
              // var mYellow = L.marker([a1, b1], {
              //        icon: yellowIcon
              // }).bindPopup('Hasil Analisa Rekomendasi Alternatif 1 <br> lat:<h5> ' + a1 + '</h5>  <br>long:<h5>' + b1 + '</h5>. <br>Silahkan untuk menggunakan koordinat hasil analisa rekomendasi tersebut untuk melakukan pengajuan surat rekomendasi').addTo(map);


              // var latlngs1 = [
              //        [a1, b1],
              //        [latitudezona2, longitudezona2]
              // ];
              // var polyline = L.polyline(latlngs1, {
              //        color: 'red'
              // }).addTo(map).bindPopup('jarak nya : ' + rangetemp1 + 'Km');


              // // hasil rekomendasi 3 menara bersama(alternatif 2)
              // var redIcon = new LeafIcon({
              //        iconUrl: "<?= templatefile('leaf-red.png') ?>"
              // });
              // var mRed = L.marker([latt2, longg2], {
              //        icon: redIcon
              // }).bindPopup('Hasil Analisa Rekomendasi Alternatif 2 . <br>Silahkan untuk menggunakan koordinat <b>SALAH SATU MENARA YANG BERADA DI ZONA EKSISTING TERSEBUT (SEBAGAI MENARA BERSAMA)</b> untuk melakukan pengajuan surat rekomendasi').addTo(map);

              // menampilkan marker menara
              <?php foreach ($datatabel1->result() as $key) {
                     if ($key->latitude != null or $key->longitude != null) {
              ?>

                            var LeafIcon = L.Icon.extend({
                                   options: {

                                          iconSize: [24, 24],

                                          iconAnchor: [15, 15],
                                          shadowAnchor: [4, 62],
                                          popupAnchor: [-3, -76]
                                   }
                            });
                            var orangeIcon = new LeafIcon({
                                   iconUrl: "<?= templatefile('menara.png') ?>"
                            });
                            var mGreen = L.marker([<?= $key->latitude; ?>, <?= $key->longitude; ?>], {
                                   icon: orangeIcon
                            }).bindPopup('<h5><?= $key->provider; ?>,<?= $key->id_menara; ?></h5></br><?= $key->latitude; ?>, <?= $key->longitude; ?>').addTo(map);



              <?php }
              } ?>
              // akhir

              var popup = L.popup()
                     .setLatLng([x1, y1])
                     .setContent('Rekomendasi Ter Atas . <i>selengkapnya klik tangkai daun hijau</i>')
                     .openOn(map);

              function onMapClick(e) {
                     popup
                            .setLatLng(e.latlng)
                            .setContent(e.latlng.toString())
                            .openOn(map);
              }

              map.on('click', onMapClick);
       };
</script>



<form class="user" method="post" action="<?= site_url() ?>map_cari">
       <div class="form-group">
              <label for="latitude" class="col-sm-1 col-form-label">Latitude</label>
              <div class="col-sm-3">
                     <input type="float" class="form-control" style="display: inline-block;" id="latitude" name="latitude" step=".000001" value="<?= set_value('latitude'); ?>" min="-10" max="10" required>
              </div>
       </div>

       <div class="form-group">
              <label for="longitude" class="col-sm-1 col-form-label">Longitude</label>
              <div class="col-sm-3">
                     <input type="float" class="form-control" style="display: inline-block;" id="longitude" name="longitude" value="<?= set_value('longitude'); ?>" step=".000001" min="100" max="120" required>
              </div>
       </div>

       <button type="submit" class="btn btn-success" name="cat">GO!</button>
</form>
<!--- Bagian Judul-->
<div id="map" style="height: 650px;"></div>
<?= content_close() ?>