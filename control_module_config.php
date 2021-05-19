<?php
function get_template($template_file){
$return = '';
if ($fp = fopen($template_file, 'rb')) {
while (!feof($fp)) {
$return .= fread($fp, 1024);
}
fclose($fp);
return $return;
} else {
return false;
}
}
date_default_timezone_set("America/New_York");
$present_time_and_date = date("F j, Y, g:i a"); 
$url_path = $_SERVER['REQUEST_URI'];
// URL REGEX
$url_regex_match_1 = ('/roofing-contractor-services-near-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_2 = ('/roof-repair-services-near-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_3 = ('/roofing-services-near-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_4 = ('/roofer-services-close-to-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_5 = ('/roofing-company-services-near-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_6 = ('/roofer-near-me-in-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_7 = ('/roofing-contractor-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_8 = ('/roof-repair-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_9 = ('/roof-repair-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_10 = ('/roof-leak-repair-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_11 = ('/roof-leak-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_12 = ('/roof-leak-inspection-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_13 = ('/roof-inspection-Hampton_Roads-Tidewater-Virginia.html/');
$url_regex_match_14 = ('/roof-repair-contractor-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_15 = ('/roofer-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_16 = ('/roofing-services-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_17 = ('/roofers-([a-z_A-Z]+)-([a-z_A-Z]+).html/');
$url_regex_match_18 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-roof-repair-services.html/');
$url_regex_match_19 = ('/Pungo-Blackwater-Virginia_Beach-roofing-repair-services.html/');
$url_regex_match_20 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-roofing-repair-services.html/');
$url_regex_match_21 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-roof-leak-fix.html/');
$url_regex_match_22 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-roof-repair.html/');
$url_regex_match_23 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-free-roof-repair-estimate.html/');
$url_regex_match_24 = ('/southside-of-hampton-roads-roofing-services.html/');
$url_regex_match_25 = ('/roof-repair-new-roof-in-the-757.html/');
$url_regex_match_26 = ('/([a-z_A-Z]+)-([a-z_A-Z]+)-expert-roofing-services.html/');
$url_regex_match_27 = ('/Peninsula-roofing-services.html/');
$url_regex_match_28 = ('/roof-repair-services-seven-cities-of-hampton-roads.html/');
$server_push_regex  = '#(src|href)="([^"]+\.(mp4|php|html|html?|xml|txt|ico|js|css|png|jpg)(\?[^"]+)?)"#';
// TEMPLATE PATHS
$template_path_1 = ("../templates/Norfolk_template_1/Norfolk_template_1.html"); 
$template_path_2 = ("../templates/Virginia_Beach_template_1/Virginia_Beach_template_1.html"); 
$template_path_3 = ("../templates/Chesapeake_template_1/Chesapeake_template_1.html");
$template_path_4 = ("../templates/Portsmouth_template_1/Portsmouth_template_1.html");
$template_path_5 = ("../templates/Suffolk_template_1/Suffolk_template_1.html");
$template_path_6 = ("../templates/Newport_News_template_1/Newport_News_template_1.html");
$template_path_7 = ("../templates/Hampton_template_1/Hampton_template_1.html");
$template_path_8 = ("../templates/Chesapeake_template_2/Chesapeake_template_2.html");
$template_path_9 = ("../templates/Norfolk_template_2/Norfolk_template_2.html");
$template_path_10 = ("../templates/Virginia_Beach_template_2/Virginia_Beach_template_2.html");
$template_path_11 = ("../templates/Chesapeake_template_3/Chesapeake_template_3.html");
$template_path_12 = ("../templates/Franklin_template_1/Franklin_template_1.html");
$template_path_13 = ("../templates/HAMPTON_ROADS_TIDEWATER/Hampton_Roads_Tidewater_template_1.html");
$template_path_14 = ("../templates/Suffolk_template_2/Suffolk_template_2.html");
$template_path_15 = ("../templates/Portsmouth_template_2/Portsmouth_template_2.html");
$template_path_16 = ("../templates/Newport_News_template_2/Newport_News_template_2.html");
$template_path_17 = ("../templates/Hampton_template_2/Hampton_template_2.html");
$template_path_18 = ("../templates/Yorktown_template_1/Yorktown_template_1.html");
$template_path_19 = ("../templates/PUNGO_BLACKWATER_VA_BEACH/Pungo_Blackwater_VA_Beach_template_1.html");
$template_path_20 = ("../templates/Smithfield_Windsor_template_1/Smithfield_Windsor_template_1.html");
$template_path_21 = ("../templates/Poquoson_Denbigh_template_1/Poquoson_Denbigh_template_1.html");
$template_path_22 = ("../templates/Gloucester_template_1/Gloucester_template_1.html");
$template_path_23 = ("../templates/Elizabeth_City_template_1/Elizabeth_City_template_1.html");
$template_path_24 = ("../templates/SOUTHSIDE_OF_HAMPTON_ROADS/SOUTHSIDE_OF_HAMPTON_ROADS_template_1.html");
$template_path_25 = ("../templates/THE_757_template_1/THE_757_template_1.html");
$template_path_26 = ("../templates/Moyock_NC_template_1/Moyock_NC_template_1.html");
$template_path_27 = ("../templates/Peninsula_template_1/Peninsula_template_1.html");
$template_path_28 = ("../templates/SEVEN_CITIES_OF_HAMPTON_ROADS/Seven_Cities_template_1.html");
if (preg_match($url_regex_match_1, $url_path, $matches)) {
$template_data = get_template($template_path_1);
}else if (preg_match($url_regex_match_2, $url_path, $matches)) {
$template_data = get_template($template_path_2);
}else if (preg_match($url_regex_match_3, $url_path, $matches)) {
$template_data = get_template($template_path_3);
}else if (preg_match($url_regex_match_4, $url_path, $matches)) {
$template_data = get_template($template_path_4);
}else if (preg_match($url_regex_match_5, $url_path, $matches)) {
$template_data = get_template($template_path_5);
}else if (preg_match($url_regex_match_6, $url_path, $matches)) {
$template_data = get_template($template_path_6);
}else if (preg_match($url_regex_match_7, $url_path, $matches)) {
$template_data = get_template($template_path_7);
}else if (preg_match($url_regex_match_8, $url_path, $matches)) {
$template_data = get_template($template_path_8);
}else if (preg_match($url_regex_match_9, $url_path, $matches)) {
$template_data = get_template($template_path_9);
}else if (preg_match($url_regex_match_10, $url_path, $matches)) {
$template_data = get_template($template_path_10);
}else if (preg_match($url_regex_match_11, $url_path, $matches)) {
$template_data = get_template($template_path_11);
}else if (preg_match($url_regex_match_12, $url_path, $matches)) {
$template_data = get_template($template_path_12);
}else if (preg_match($url_regex_match_13, $url_path, $matches)) {
$template_data = get_template($template_path_13);
}else if (preg_match($url_regex_match_14, $url_path, $matches)) {
$template_data = get_template($template_path_14);
}else if (preg_match($url_regex_match_15, $url_path, $matches)) {
$template_data = get_template($template_path_15);
}else if (preg_match($url_regex_match_16, $url_path, $matches)) {
$template_data = get_template($template_path_16);
}else if (preg_match($url_regex_match_17, $url_path, $matches)) {
$template_data = get_template($template_path_17);
}else if (preg_match($url_regex_match_18, $url_path, $matches)) {
$template_data = get_template($template_path_18);
}else if (preg_match($url_regex_match_19, $url_path, $matches)) {
$template_data = get_template($template_path_19);
}else if (preg_match($url_regex_match_20, $url_path, $matches)) {
$template_data = get_template($template_path_20);
}else if (preg_match($url_regex_match_21, $url_path, $matches)) {
$template_data = get_template($template_path_21);
}else if (preg_match($url_regex_match_22, $url_path, $matches)) {
$template_data = get_template($template_path_22);
}else if (preg_match($url_regex_match_23, $url_path, $matches)) {
$template_data = get_template($template_path_23);
}else if (preg_match($url_regex_match_24, $url_path, $matches)) {
$template_data = get_template($template_path_24);
}else if (preg_match($url_regex_match_25, $url_path, $matches)) {
$template_data = get_template($template_path_25);
}else if (preg_match($url_regex_match_26, $url_path, $matches)) {
$template_data = get_template($template_path_26);
}else if (preg_match($url_regex_match_27, $url_path, $matches)) {
$template_data = get_template($template_path_27);
}else if (preg_match($url_regex_match_28, $url_path, $matches)) {
$template_data = get_template($template_path_28);
}else{
$home_page = get_template('../index.html');
echo ($home_page);
}
$city  = $matches[1]; 
$state = $matches[2];
$current_full_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$current_host = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
//  SERVER PUSH DATA
$header = "Link: ";
if (preg_match_all($server_push_regex, $template_data, $file_asset_data, PREG_SET_ORDER)) {
foreach ($file_asset_data as $asset_matches) {
$asset_file_name = $asset_matches[2];
$asset_type = $asset_matches[3];
if ($asset_type === 'js') {
$asset_type = 'script';
}else if ($asset_type === 'css') {
$asset_type = 'style';
} 
else if ($asset_type === 'txt') {
$asset_type = 'text';
}
else if ($asset_type === 'xml') {
$asset_type = 'xml';
}
else if ($asset_type === 'html') {
$asset_type = 'html';
}
else if ($asset_type === 'php') {
$asset_type = 'script';
}
else if ($asset_type === 'mp4') {
$asset_type = 'video';
}
else {
$asset_type = 'image';
}
$header = str_replace('[current_host]','',$header);
$header .= sprintf('<'.$current_host.'/%s>; rel=preload; as=%s,', $asset_file_name, $asset_type);
}
}
header(rtrim($header, ","));
header("HTTP/1.1 200 OK");
header("Link: <".$current_full_url.">; rel=\"canonical\"");
header("Connection keep-alive");
header("Strict-Transport-Security: \"max-age=0; includeSubDomains; preload\"");
header("Accept-Push-Policy: fast-load");
header("Access-Control-Allow-Headers: Accept");
header("Accept-Ranges: bytes");
header('X-Robots-Tag: index,all');
header('Content-language: en');
header("KeepAlive: On");
header("Connection: keep-alive");
header("MaxKeepAliveRequests: 0");
header("KeepAliveTimeout: 400");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: Mon, 15 Jul 1997 05:00:00 GMT");
header('Last-Modified: ' .$present_time_and_date);
header("Cache-Control: post-check=0, pre-check=0, false");
header("Cache-Control: \"max-age=0, false\"");
$etag_number_generator = (mt_rand(200, 10000));
header('Etag: '.$etag_number_generator);
header('Roofing Contractor' .$city.' '.$state);
header('Roof Repair Services' .$city.' '.$state); 
header('New Roof Replacement Services' .$city.' '.$state); 
header('Services Area' .$city.' '.$state);
?>