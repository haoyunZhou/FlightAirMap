<?php
require_once('require/class.Connection.php');
require_once('require/class.Common.php');
require_once('require/class.Satellite.php');
date_default_timezone_set('UTC');
//$begintime = microtime(true);
$Satellite = new Satellite();
$Common = new Common();

if (isset($_GET['download'])) {
	if ($_GET['download'] == "true")
	{
		header('Content-disposition: attachment; filename="flightairmap-santa.czml"');
	}
}
header('Content-Type: text/javascript');

$timeb = time();
//$sqltime = round(microtime(true)-$begintime,2);

$spotter_array = array();
$j = 0;
$prev_satname = '';

$output = '[';
$output .= '{"id" : "document", "name" : "famsanta","version" : "1.0"';
//	$output .= ',"clock": {"interval" : "'.date("c",time()-$globalLiveInterval).'/'.date("c").'","currentTime" : "'.date("c",time() - $globalLiveInterval).'","multiplier" : 1,"range" : "LOOP_STOP","step": "SYSTEM_CLOCK_MULTIPLIER"}';

//	$output .= ',"clock": {"interval" : "'.date("c",time()-$globalLiveInterval).'/'.date("c").'","currentTime" : "'.date("c",time() - $globalLiveInterval).'","multiplier" : 1,"range" : "UNBOUNDED","step": "SYSTEM_CLOCK_MULTIPLIER"}';
$output .= ',"clock": {"currentTime" : "'.date("c",time() - $globalLiveInterval).'","multiplier" : 1,"range" : "UNBOUNDED","step": "SYSTEM_CLOCK_MULTIPLIER"';
if (!isset($_GET['now'])) $output .= ',"interval": "'.date("Y").'-12-24T02:00:00Z/'.date("Y").'-12-25T02:00:00Z"';
$output .= '}';
//$output .= ',"clock": {"currentTime" : "'.date("c",time()).'","multiplier" : 300,"range" : "UNBOUNDED","step": "TICK_DEPENDENT"}';
//$output .= ',"clock": {"currentTime" : "%minitime%","multiplier" : 1,"range" : "UNBOUNDED","step": "SYSTEM_CLOCK_MULTIPLIER"}';

//	$output .= ',"clock": {"interval" : "'.date("c",time()-$globalLiveInterval).'/'.date("c").'","currentTime" : "'.date("c",time() - $globalLiveInterval).'","multiplier" : 1,"step": "SYSTEM_CLOCK_MULTIPLIER"}';
$output .= '},';
$output .= '{';
$output .= '"id": "santaclaus",';
if (!isset($_GET['now'])) $output .= '"interval": "'.date("Y").'-12-24T02:00:00Z/'.date("Y").'-12-25T02:00:00Z",';
$output .= '"properties": {';
// Not yet supported in CZML with Cesium
$output .= '},';
$output .= '"path" : { ';
$output .= '"show" : false, ';
$output .= '"material" : { ';
$output .= '"polylineOutline" : { ';
$output .= '"color" : { "rgba" : [238, 250, 255, 255] }, ';
$output .= '"outlineColor" : { "rgba" : [200, 209, 214, 255] }, ';
$output .= '"outlineWidth" : 5, ';
$output .= '"polylineGlow" : { "color" : { "rgba" : [214, 208, 214, 255] }, "glowPower" : 3 } ';
$output .= '}';
$output .= '}, ';
$output .= '"heightReference": "NONE",';
$output .= '"width" : 6, "leadTime" : 0, "trailTime" : 1000000, "resolution" : 10 },';
$output .= '"model": {"gltf" : "'.$globalURL.'/models/santa.glb'.'","scale" : 1.0,"minimumPixelSize": 100,"maximunPixelSize": 600 ,';
$output .= '"heightReference": "NONE"},';
$output .= '"position": {';
if (!isset($_GET['now'])) {
	$output .= '"epoch" : "'.date("Y").'-12-24T02:00:00Z",';
} else {
	$output .= '"epoch" : "'.date("c",time() - $globalLiveInterval).'",';
}
//$output .= '"type": "Point",';
//$output .= '"interpolationAlgorithm" : "LAGRANGE",';
//$output .= '"interpolationDegree" : 5,';
//		$output .= '"epoch" : "'.date("c",strtotime($spotter_item['date'])).'", ';
$output .= '"cartographicDegrees": [';
$i = 0;
$output .= $i.',-114.4,82.7,150000,';
$i = $i+300;
$output .= $i.',-173.300003,64.379997,150000,';
$i = $i+300;
$output .= $i.',177.479995,64.75,150000,';
$i = $i+300;
$output .= $i.',158.65,53.016667,150000,';
$i = $i+300;
$output .= $i.',165.545318,11.626074,150000,';
$i = $i+300;
$output .= $i.',171.1300517813333,7.07999665990053,150000,';
$i = $i+300;
$output .= $i.',179.380004,-16.469999,150000,';
$i = $i+300;
$output .= $i.',178.429992,-18.129999,150000,';
$i = $i+300;
$output .= $i.',174.759994,-36.849998,150000,';
$i = $i+300;
$output .= $i.',176.839996,-39.639999,150000,';
$i = $i+300;
$output .= $i.',174.779998,-41.279998,150000,';
$i = $i+300;
$output .= $i.',172.639999,-43.529998,150000,';
$i = $i+300;
$output .= $i.',167.838199,-46.986747,150000,';
$i = $i+300;
$output .= $i.',168.320999,-17.740391,150000,';
$i = $i+300;
$output .= $i.',167.149993,-15.51,150000,';
$i = $i+300;
$output .= $i.',159.910003,-9.43,150000,';
$i = $i+300;
$output .= $i.',156.850006,-8.1,150000,';
$i = $i+300;
$output .= $i.',158.160003,6.92,150000,';
$i = $i+300;
$output .= $i.',150.017702,45.873311,150000,';
$i = $i+300;
$output .= $i.',154.796487,49.429802,150000,';
$i = $i+300;
$output .= $i.',142.7262,46.948978,150000,';
$i = $i+300;
$output .= $i.',150.800003,59.569999,150000,';
$i = $i+300;
$output .= $i.',135.119995,48.419998,150000,';
$i = $i+300;
$output .= $i.',131.899993,43.130001,150000,';
$i = $i+300;
$output .= $i.',142.212096,27.070652,150000,';
$i = $i+300;
$output .= $i.',141.312779,24.78389,150000,';
$i = $i+300;
$output .= $i.',144.79373,13.444305,150000,';
$i = $i+300;
$output .= $i.',151.783334,8.45,150000,';
$i = $i+300;
$output .= $i.',151.749999,7.416667,150000,';
$i = $i+300;
$output .= $i.',152.160003,-4.199999,150000,';
$i = $i+300;
$output .= $i.',146.990005,-6.719999,150000,';
$i = $i+300;
$output .= $i.',143.211639,-9.085352,150000,';
$i = $i+300;
$output .= $i.',146.779998,-19.26,150000,';
$i = $i+300;
$output .= $i.',149.179992,-21.139999,150000,';
$i = $i+300;
$output .= $i.',153.020004,-27.459999,150000,';
$i = $i+300;
$output .= $i.',151.210006,-33.869998,150000,';
$i = $i+300;
$output .= $i.',147.291199,-42.85088,150000,';
$i = $i+300;
$output .= $i.',138.600006,-34.93,150000,';
$i = $i+300;
$output .= $i.',133.869995,-23.7,150000,';
$i = $i+300;
$output .= $i.',130.850006,-12.43,150000,';
$i = $i+300;
$output .= $i.',143.62,-3.56,150000,';
$i = $i+300;
$output .= $i.',134.5552,7.3608,150000,';
$i = $i+300;
$output .= $i.',135.169998,34.68,150000,';
$i = $i+300;
$output .= $i.',138.690002,35.169998,150000,';
$i = $i+300;
$output .= $i.',139.770004,35.669998,150000,';
$i = $i+300;
$output .= $i.',140.740005,40.830001,150000,';
$i = $i+300;
$output .= $i.',128.600006,35.869998,150000,';
$i = $i+300;
$output .= $i.',125.925925,38.950981,150000,';
$i = $i+300;
$output .= $i.',129.771118,62.093056,150000,';
$i = $i+300;
$output .= $i.',104.239997,52.330001,150000,';
$i = $i+300;
$output .= $i.',114.5056,48.060478,150000,';
$i = $i+300;
$output .= $i.',106.580001,29.569999,150000,';
$i = $i+300;
$output .= $i.',121.470001,31.229999,150000,';
$i = $i+300;
$output .= $i.',113.25,23.12,150000,';
$i = $i+300;
$output .= $i.',114.177465,22.307184,150000,';
$i = $i+300;
$output .= $i.',121.639999,18.36,150000,';
$i = $i+300;
$output .= $i.',122.080001,6.92,150000,';
$i = $i+300;
$output .= $i.',114.639999,4.809999,150000,';
$i = $i+300;
$output .= $i.',119.412399,-5.152193,150000,';
$i = $i+300;
$output .= $i.',122.230003,-17.959999,150000,';
$i = $i+300;
$output .= $i.',115.839996,-31.959999,150000,';
$i = $i+300;
$output .= $i.',105.680687,-10.428593,150000,';
$i = $i+300;
$output .= $i.',104.75,-2.99,150000,';
$i = $i+300;
$output .= $i.',113.029998,3.17,150000,';
$i = $i+300;
$output .= $i.',100.720001,4.86,150000,';
$i = $i+300;
$output .= $i.',104.18,10.609999,150000,';
$i = $i+300;
$output .= $i.',103.864403,13.36866,150000,';
$i = $i+300;
$output .= $i.',99.330001,9.14,150000,';
$i = $i+300;
$output .= $i.',105.073303,18.30217,150000,';
$i = $i+300;
$output .= $i.',91.132088,29.6507,150000,';
$i = $i+300;
$output .= $i.',116.477651,40.332809,150000,';
$i = $i+300;
$output .= $i.',93.059997,56.02,150000,';
$i = $i+300;
$output .= $i.',86.18,69.410003,150000,';
$i = $i+300;
$output .= $i.',88.202881,69.315422,150000,';
$i = $i+300;
$output .= $i.',73.400001,55,150000,';
$i = $i+300;
$output .= $i.',76.949996,52.299999,150000,';
$i = $i+300;
$output .= $i.',78.379997,42.490001,150000,';
$i = $i+300;
$output .= $i.',69.779998,37.919998,150000,';
$i = $i+300;
$output .= $i.',86.933333,27.983333,150000,';
$i = $i+300;
$output .= $i.',84.870002,27.02,150000,';
$i = $i+300;
$output .= $i.',88.36,22.569999,150000,';
$i = $i+300;
$output .= $i.',90.389999,23.7,150000,';
$i = $i+300;
$output .= $i.',97.04,20.78,150000,';
$i = $i+300;
$output .= $i.',92.762917,11.66857,150000,';
$i = $i+300;
$output .= $i.',50.23720550537109,-46.10261535644531,150000,';
$i = $i+300;
$output .= $i.',72.422489,-7.336367,150000,';
$i = $i+300;
$output .= $i.',73.510915,4.174199,150000,';
$i = $i+300;
$output .= $i.',81.050003,6.989999,150000,';
$i = $i+300;
$output .= $i.',72.819999,18.959999,150000,';
$i = $i+300;
$output .= $i.',78.042222,27.174167,150000,';
$i = $i+300;
$output .= $i.',71.449996,30.2,150000,';
$i = $i+300;
$output .= $i.',67.109993,36.703819,150000,';
$i = $i+300;
$output .= $i.',54.36,39.509998,150000,';
$i = $i+300;
$output .= $i.',63.726529,40.214486,150000,';
$i = $i+300;
$output .= $i.',58.853439,48.251126,150000,';
$i = $i+300;
$output .= $i.',56.23246,58.00024,150000,';
$i = $i+300;
$output .= $i.',49.659999,58.599998,150000,';
$i = $i+300;
$output .= $i.',50.150001,53.2,150000,';
$i = $i+300;
$output .= $i.',44.11,41.979999,150000,';
$i = $i+300;
$output .= $i.',49.893226,40.38344,150000,';
$i = $i+300;
$output .= $i.',44.75,40.5,150000,';
$i = $i+300;
$output .= $i.',50.95,34.650001,150000,';
$i = $i+300;
$output .= $i.',56.27433,27.18717,150000,';
$i = $i+300;
$output .= $i.',54.989491,25.005817,150000,';
$i = $i+300;
$output .= $i.',59.549999,22.569999,150000,';
$i = $i+300;
$output .= $i.',47.58318996007591,-9.722414273737707,150000,';
$i = $i+300;
$output .= $i.',57.471008,-20.26026,150000,';
$i = $i+300;
$output .= $i.',37.946460723877,-46.6428451538086,150000,';
$i = $i+300;
$output .= $i.',53,-67.5,150000,';
$i = $i+300;
$output .= $i.',46.99004,-25.03233,150000,';
$i = $i+300;
$output .= $i.',46.310001,-15.72,150000,';
$i = $i+300;
$output .= $i.',44.41203117370608,-12.22338294982911,150000,';
$i = $i+300;
$output .= $i.',39.3822,-6.097406,150000,';
$i = $i+300;
$output .= $i.',39.659999,-4.039999,150000,';
$i = $i+300;
$output .= $i.',40.033333,7.916667,150000,';
$i = $i+300;
$output .= $i.',42.549999,16.899999,150000,';
$i = $i+300;
$output .= $i.',43.970001,26.37,150000,';
$i = $i+300;
$output .= $i.',41.12,30.455,150000,';
$i = $i+300;
$output .= $i.',38.278671,34.547951,150000,';
$i = $i+300;
$output .= $i.',37.619998,55.75,150000,';
$i = $i+300;
$output .= $i.',30.453329,59.951889,150000,';
$i = $i+300;
$output .= $i.',23.12,63.84,150000,';
$i = $i+300;
$output .= $i.',26.709999,58.380001,150000,';
$i = $i+300;
$output .= $i.',25.42,57.549999,150000,';
$i = $i+300;
$output .= $i.',23.319999,55.93,150000,';
$i = $i+300;
$output .= $i.',26.1,52.119998,150000,';
$i = $i+300;
$output .= $i.',32.259998,48.5,150000,';
$i = $i+300;
$output .= $i.',28.829999,47.029998,150000,';
$i = $i+300;
$output .= $i.',25.61,45.659999,150000,';
$i = $i+300;
$output .= $i.',27.469999,42.509998,150000,';
$i = $i+300;
$output .= $i.',23.729999,37.979999,150000,';
$i = $i+300;
$output .= $i.',27.149999,38.43,150000,';
$i = $i+300;
$output .= $i.',31.132659,29.977088,150000,';
$i = $i+300;
$output .= $i.',32.659999,13.17,150000,';
$i = $i+300;
$output .= $i.',33.599998,1.71,150000,';
$i = $i+300;
$output .= $i.',25.92,-2.95,150000,';
$i = $i+300;
$output .= $i.',28.45,-14.439999,150000,';
$i = $i+300;
$output .= $i.',30.819999,-20.059999,150000,';
$i = $i+300;
$output .= $i.',21.639999,-21.7,150000,';
$i = $i+300;
$output .= $i.',25.59,-33.959999,150000,';
$i = $i+300;
$output .= $i.',18.129999,-26.579999,150000,';
$i = $i+300;
$output .= $i.',13.767777,-10.722417,150000,';
$i = $i+300;
$output .= $i.',10.13,-0.15,150000,';
$i = $i+300;
$output .= $i.',20.67,5.76,150000,';
$i = $i+300;
$output .= $i.',9.71,4.059999,150000,';
$i = $i+300;
$output .= $i.',7.44,10.52,150000,';
$i = $i+300;
$output .= $i.',18.69,12.189999,150000,';
$i = $i+300;
$output .= $i.',7.98,17,150000,';
$i = $i+300;
$output .= $i.',14.42,27.069999,150000,';
$i = $i+300;
$output .= $i.',3.678539,32.489059,150000,';
$i = $i+300;
$output .= $i.',-7.619999,33.599998,150000,';
$i = $i+300;
$output .= $i.',13.611066,38.129963,150000,';
$i = $i+300;
$output .= $i.',12.482323,41.895466,150000,';
$i = $i+300;
$output .= $i.',17.189752,44.763891,150000,';
$i = $i+300;
$output .= $i.',16.45,43.509998,150000,';
$i = $i+300;
$output .= $i.',14.51,46.060001,150000,';
$i = $i+300;
$output .= $i.',21.629999,47.54,150000,';
$i = $i+300;
$output .= $i.',16.37,48.220001,150000,';
$i = $i+300;
$output .= $i.',10.736111,47.554444,150000,';
$i = $i+300;
$output .= $i.',14.43,50.080001,150000,';
$i = $i+300;
$output .= $i.',17.129999,48.159999,150000,';
$i = $i+300;
$output .= $i.',22.569999,51.240001,150000,';
$i = $i+300;
$output .= $i.',13.411895,52.523781,150000,';
$i = $i+300;
$output .= $i.',10.039999,56.470001,150000,';
$i = $i+300;
$output .= $i.',13.02,55.61,150000,';
$i = $i+300;
$output .= $i.',17.329999,62.400001,150000,';
$i = $i+300;
$output .= $i.',14.229999,78.059997,150000,';
$i = $i+300;
$output .= $i.',10.399999,63.439998,150000,';
$i = $i+300;
$output .= $i.',2.350966,48.856558,150000,';
$i = $i+300;
$output .= $i.',7.42,43.75,150000,';
$i = $i+300;
$output .= $i.',1.57,42.54,150000,';
$i = $i+300;
$output .= $i.',-0.991293,37.605651,150000,';
$i = $i+300;
$output .= $i.',-7.429999,39.29,150000,';
$i = $i+300;
$output .= $i.',-11.4053,16.5889,150000,';
$i = $i+300;
$output .= $i.',-3.009999,16.78,150000,';
$i = $i+300;
$output .= $i.',-5.36008,5.83885,150000,';
$i = $i+300;
$output .= $i.',-12.3,11.319999,150000,';
$i = $i+300;
$output .= $i.',-16.239999,12.829999,150000,';
$i = $i+300;
$output .= $i.',-16.2507,28.457661,150000,';
$i = $i+300;
$output .= $i.',-0.126197,51.500197,150000,';
$i = $i+300;
$output .= $i.',-2.968111,56.461428,150000,';
$i = $i+300;
$output .= $i.',-7.308429,54.998539,150000,';
$i = $i+300;
$output .= $i.',-8.92,52.7,150000,';
$i = $i+300;
$output .= $i.',-19.000959,63.427502,150000,';
$i = $i+300;
$output .= $i.',-28.364049911499,38.47212219238281,150000,';
$i = $i+300;
$output .= $i.',-23.76,15.279999,150000,';
$i = $i+300;
$output .= $i.',-36.511219,-54.274151,150000,';
$i = $i+300;
$output .= $i.',-58.979999,-51.830001,150000,';
$i = $i+300;
$output .= $i.',-64.190002,-31.399999,150000,';
$i = $i+300;
$output .= $i.',-54.18,-32.36,150000,';
$i = $i+300;
$output .= $i.',-43.2,-22.909999,150000,';
$i = $i+300;
$output .= $i.',-37.333333,65.666667,150000,';
$i = $i+300;
$output .= $i.',-69.345131,77.48262,150000,';
$i = $i+300;
$output .= $i.',-55.65049,48.929001,150000,';
$i = $i+300;
$output .= $i.',-63.530471,44.681263,150000,';
$i = $i+300;
$output .= $i.',-66.647818,45.957319,150000,';
$i = $i+300;
$output .= $i.',-59.630001,13.18,150000,';
$i = $i+300;
$output .= $i.',-61.744888,12.06526,150000,';
$i = $i+300;
$output .= $i.',-61.171322,10.30501,150000,';
$i = $i+300;
$output .= $i.',-67.470001,7.9,150000,';
$i = $i+300;
$output .= $i.',-58.159999,6.789999,150000,';
$i = $i+300;
$output .= $i.',-60.02,-3.119999,150000,';
$i = $i+300;
$output .= $i.',-56.45,-14.409999,150000,';
$i = $i+300;
$output .= $i.',-65.260002,-19.059999,150000,';
$i = $i+300;
$output .= $i.',-56.636503,-24.158676,150000,';
$i = $i+300;
$output .= $i.',-56.509998,-33.409999,150000,';
$i = $i+300;
$output .= $i.',-68.523514,-50.021889,150000,';
$i = $i+300;
$output .= $i.',-72.505127,-51.732529,150000,';
$i = $i+300;
$output .= $i.',-71.639999,-33.04,150000,';
$i = $i+300;
$output .= $i.',-72.515821,-13.162849,150000,';
$i = $i+300;
$output .= $i.',-76.970001,-6.03,150000,';
$i = $i+300;
$output .= $i.',-78.620002,-1.24,150000,';
$i = $i+300;
$output .= $i.',-76.739997,8.1,150000,';
$i = $i+300;
$output .= $i.',-79.879913,9.368985,150000,';
$i = $i+300;
$output .= $i.',-76.949996,18,150000,';
$i = $i+300;
$output .= $i.',-72.699996,19.11,150000,';
$i = $i+300;
$output .= $i.',-75.220001,20.149999,150000,';
$i = $i+300;
$output .= $i.',-73.682953,20.95027,150000,';
$i = $i+300;
$output .= $i.',-80.605,28.405556,150000,';
$i = $i+300;
$output .= $i.',-84.388056,33.748889,150000,';
$i = $i+300;
$output .= $i.',-79.931111,32.776389,150000,';
$i = $i+300;
$output .= $i.',-83.920833,35.960556,150000,';
$i = $i+300;
$output .= $i.',-84.500278,38.049167,150000,';
$i = $i+300;
$output .= $i.',-77.460833,38.303056,150000,';
$i = $i+300;
$output .= $i.',-82.515556,40.758333,150000,';
$i = $i+300;
$output .= $i.',-83.045833,42.331389,150000,';
$i = $i+300;
$output .= $i.',-74.006389,40.714167,150000,';
$i = $i+300;
$output .= $i.',-71.802778,42.2625,150000,';
$i = $i+300;
$output .= $i.',-72.973056,43.610556,150000,';
$i = $i+300;
$output .= $i.',-68.0125,46.860556,150000,';
$i = $i+300;
$output .= $i.',-72.581779,46.357398,150000,';
$i = $i+300;
$output .= $i.',-78.53632621543271,52.72737572958358,150000,';
$i = $i+300;
$output .= $i.',-66.921779,52.940118,150000,';
$i = $i+300;
$output .= $i.',-75.652573,62.201069,150000,';
$i = $i+300;
$output .= $i.',-64.865257,67.935417,150000,';
$i = $i+300;
$output .= $i.',-94.969443,74.716943,150000,';
$i = $i+300;
$output .= $i.',-82.793909,76.395731,150000,';
$i = $i+300;
$output .= $i.',-97.49276733398439,69.18675994873048,150000,';
$i = $i+300;
$output .= $i.',-90.5537452697754,63.36753463745121,150000,';
$i = $i+300;
$output .= $i.',-89.270113,48.412197,150000,';
$i = $i+300;
$output .= $i.',-79.604159,43.68731,150000,';
$i = $i+300;
$output .= $i.',-89.401111,43.073056,150000,';
$i = $i+300;
$output .= $i.',-94.633611,42.395278,150000,';
$i = $i+300;
$output .= $i.',-89.588889,40.693611,150000,';
$i = $i+300;
$output .= $i.',-90.197778,38.627222,150000,';
$i = $i+300;
$output .= $i.',-90.704167,35.842222,150000,';
$i = $i+300;
$output .= $i.',-91.061667,33.41,150000,';
$i = $i+300;
$output .= $i.',-92.445,31.311111,150000,';
$i = $i+300;
$output .= $i.',-98.493333,29.423889,150000,';
$i = $i+300;
$output .= $i.',-103.349998,20.67,150000,';
$i = $i+300;
$output .= $i.',-86.830001,21.17,150000,';
$i = $i+300;
$output .= $i.',-89.529998,14.979999,150000,';
$i = $i+300;
$output .= $i.',-87.449996,13.42,150000,';
$i = $i+300;
$output .= $i.',-83.709999,9.369999,150000,';
$i = $i+300;
$output .= $i.',-91.5149765,-0.3781085,150000,';
$i = $i+300;
$output .= $i.',-109.425598,-27.1546,150000,';
$i = $i+300;
$output .= $i.',-109.9142,22.88093,150000,';
$i = $i+300;
$output .= $i.',-110.910003,27.92,150000,';
$i = $i+300;
$output .= $i.',-110.925833,32.221667,150000,';
$i = $i+300;
$output .= $i.',-104.526667,33.395,150000,';
$i = $i+300;
$output .= $i.',-113.061111,37.6775,150000,';
$i = $i+300;
$output .= $i.',-104.820833,38.833889,150000,';
$i = $i+300;
$output .= $i.',-108.73,42.833056,150000,';
$i = $i+300;
$output .= $i.',-113.895,45.175833,150000,';
$i = $i+300;
$output .= $i.',-113.993056,46.872222,150000,';
$i = $i+300;
$output .= $i.',-114.080796,51.039877,150000,';
$i = $i+300;
$output .= $i.',-102.3889594419702,57.15883691318781,150000,';
$i = $i+300;
$output .= $i.',-118.0333,66.0833,150000,';
$i = $i+300;
$output .= $i.',-140.55,64.45,150000,';
$i = $i+300;
$output .= $i.',-122.690386,58.80667,150000,';
$i = $i+300;
$output .= $i.',-121.92985,50.686341,150000,';
$i = $i+300;
$output .= $i.',-122.330833,47.606389,150000,';
$i = $i+300;
$output .= $i.',-122.274167,47.564167,150000,';
$i = $i+300;
$output .= $i.',-122.968503,45.309901,150000,';
$i = $i+300;
$output .= $i.',-122.874444,42.326667,150000,';
$i = $i+300;
$output .= $i.',-122.390556,40.586667,150000,';
$i = $i+300;
$output .= $i.',-117.068611,39.493333,150000,';
$i = $i+300;
$output .= $i.',-122.418333,37.775,150000,';
$i = $i+300;
$output .= $i.',-117.108333,34.207778,150000,';
$i = $i+300;
$output .= $i.',-116.544444,33.830278,150000,';
$i = $i+300;
$output .= $i.',-117.156389,32.715278,150000,';
$i = $i+300;
$output .= $i.',-149.891667,61.218333,150000,';
$i = $i+300;
$output .= $i.',-155.566389,62.948889,150000,';
$i = $i+300;
$output .= $i.',-165.406389,64.501111,150000,';
$i = $i+300;
$output .= $i.',-155.09,19.729722,150000,';
$i = $i+300;
$output .= $i.',-156.337974,20.804858,150000,';
$i = $i+300;
$output .= $i.',-157.043209,21.141189,150000,';
$i = $i+300;
$output .= $i.',-158.009167,21.386667,150000,';
$i = $i+300;
$output .= $i.',-159.371111,21.981111,150000';

$output .= ']}}';
$output .= ']';
print $output;
?>
