<?php
error_reporting(0);
ini_set('display_errors', '0');
ini_set('max_execution_time', 259200);
ini_set('zlib.output_compression','Off');
set_time_limit(0);
ob_implicit_flush(true);
$GZipEncodingEnable = true;
function GZipAccepts()
{
$accept = str_replace(" ","",strtolower($_SERVER['HTTP_ACCEPT_ENCODING']));
$accept = explode(",",$accept);
return in_array("gzip",$accept);
}
function MinifyHTML($HtmlOutput)
{
return preg_replace("/\s+/"," ",$HtmlOutput);
}
function CompressPage($HtmlOutput)
{
global $GZipEncodingEnable;
$HtmlOutput = MinifyHTML($HtmlOutput);
if(!GZipAccepts() || headers_sent() || !$GZipEncodingEnable) return $HtmlOutput;
header("Content-Encoding: gzip");
return gzencode($HtmlOutput);
}
ob_start("CompressPage");
require ('control_module_config.php');
function spin($str){
$tmp = explode("<spin>",$str);
$pos = strpos($str, '<spin>');
if ($pos !== false) {
for($i=0;$i<count($tmp);$i++){
$pos = strpos($tmp[$i], '</spin>');
if ($pos !== false) {
unset($temp);
$temp = explode("</spin>",$tmp[$i]);
$temp[0] = spinin($temp[0]);
$tmp[$i] = implode($temp);
}
}
return implode('',$tmp);
}else{
return $str;
}
}
function spinin($s){
preg_match('#\{(.+?)\}#is',$s,$m);
if(empty($m)) return $s;
$t = $m[1];
if(strpos($t,'{')!==false){
$t = substr($t, strrpos($t,'{') + 1);
}
$parts = explode("|", $t);
$s = preg_replace("+\{".preg_quote($t)."\}+is", $parts[array_rand($parts)], $s, 1);
return spinin($s);
}
// get city, state data from CSV
$data_file = fopen("database.csv", "r")or die("Unable to open file!");
$city_data = str_replace("_"," ",$city);    // remove _ from city names set in GET
$state_data = str_replace("_"," ",$state);    // remove _ from state names set in GET
// iterate on all rows of csv
$extractpostalcodes = array();
$zipcode = array();
$longitude_array = array();
$latitude_array = array();
$coords_array = array();
while( !feof($data_file) ) {
$line_of_text = fgetcsv($data_file);
// 0 = State
// 1 = State Abbv
// 2 = City
// 3 = Zip Code
// 4 = Latitude
// 5 = Longitude
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $stateabrr = $line_of_text[1];
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $longitude_array[] = $line_of_text[5];
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $latitude_array[] = $line_of_text[4];
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $coords_array[] = array( "zip" => $line_of_text[3], "lat" => $line_of_text[4], "long" => $line_of_text[5] );
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $extractpostalcodes[] = $line_of_text[3];
if( stripos($line_of_text[2],$city_data) !== FALSE && stripos($line_of_text[0],$state_data) !== FALSE )
        $zipcode[] = $line_of_text[3];
}
$latitude = implode(',',$latitude_array);
$longitude = implode(',',$longitude_array);
// convert into comma separated value
$postalcodes = implode(',',$extractpostalcodes);
$zipcodelist = '<ul>';
foreach( $zipcode as $curr ){
    $zipcodelist .= '<li>'.$curr.'</li>';
}
$zipcodelist .= '</ul>';
$coords_list = '<ul>';
foreach( $coords_array as $curr ){
    $coords_list .= '<li>'.$curr['zip']. ' ('.$curr['lat'].','.$curr['long'].')</li>';
}
$coords_list .= '</ul>';

$template_data = str_replace("[current_url]",$current_full_url,$template_data);
$template_data = str_replace("[current_host]",$current_host,$template_data);
$state_data = str_replace("_"," ",$state);
$template_data = str_replace("[state]",$state_data,$template_data);
$template_data = str_replace("[state_css]",'<div id="state" class="state">' . $state_data . '</div>',$template_data);
$template_data = str_replace("[state_abv.]",$stateabrr,$template_data);
$template_data = str_replace("[state_abv_css]",'<div id="state_abv" class="state_abv">' .$stateabrr. '</div>',$template_data);
$template_data = str_replace("[city]",$city_data,$template_data);
$template_data = str_replace("[city_css]",'<div id="city" class="city">' . $city_data . '</div>',$template_data);
$template_data = str_replace("[zipcode]",$zipcodelist,$template_data);
$template_data = str_replace("[zipcode_css]",'<div id="zipcode" class="zipcode">' . $zipcodelist . '</div>',$template_data);
$template_data = str_replace("[postal_code]",$postalcodes,$template_data);
$template_data = str_replace("[postal_codes]",$postalcodes,$template_data);
$template_data = str_replace("[postal_code_css]",'<a href="[current_url]" title="[city], {[state_abv.]|[state]}">'. $postalcodes . '</a>',$template_data);
$template_data = str_replace("[longitude]",$longitude,$template_data);
$template_data = str_replace("[longitude_css]",'<div id="longitude" class="longitude">'.$longitude. '</div>',$template_data);
$template_data = str_replace("[latitude]",$latitude,$template_data);
$template_data = str_replace("[latitude_css]",'<div id="latitude" class="latitude">'.$latitude. '</div>',$template_data);
$template_data = str_replace("[coords]",$coords_list,$template_data);
{
$state_link = str_replace(" ","_",$state);
$template_data = str_replace("[statelink]",$state_link,$template_data);
$state_link = str_replace(" ","_",$state);
$template_data = str_replace("[statelink_css]",'<div id="state_link" class="state_link">'. $state_link .'</div>',$template_data);
$city_link = str_replace(" ","_",$city);
$template_data = str_replace("[citylink]",$city_link,$template_data);
$city_link = str_replace(" ","_",$city);
$template_data = str_replace("[citylink_css]",'<div id="city_link" class="city_link">'. $city_link .'</div>',$template_data);
}
$template_data = str_replace("[Current_Time_and_Date]",$present_time_and_date,$template_data);
$template_data = str_replace("[Current_Time_and_Date_css]",'<div id="current_time_and_date" class="current_time_and_date">' . $present_time_and_date . '</div>',$template_data);
$news_feed_data=(' <script type="text/javascript">
var socialfeed=new gfeedfetcher("newsfeed", "newsfeedclass", "_new")
socialfeed.addFeed("Google", "http://news.google.com/news?hl=en&gl=us&q=Roofing&um=1&ie=UTF-8&output=rss") //Specify "label" plus URL to RSS feed
          socialfeed.addFeed("Google", "http://news.google.com/news?hl=en&gl=us&q=[city_for_news_feed]+[state_for_news_feed]&um=1&ie=UTF-8&output=rss") //Specify "label" plus URL to RSS feed
          socialfeed.displayoptions("label datetime snippet") //show the specified additional fields
          socialfeed.setentrycontainer("div") //Display each entry as a DIV
          socialfeed.filterfeed(4, "label") //Show 6 entries, sort by label
          socialfeed.init() //Always call this last
        </script> ');
$city_for_news_feed = str_replace("_","+",$city);
$state_for_news_feed = str_replace("_","+",$state);
$news_feed_data = str_replace("[city_for_news_feed]",$city_for_news_feed,$news_feed_data);
$news_feed_data = str_replace("[state_for_news_feed]",$state_for_news_feed,$news_feed_data);
$template_data = str_replace("[News_Feed]",$news_feed_data,$template_data);
$template_data = str_replace("[city_for_news_feed]",$city_for_news_feed,$template_data);
$template_data = str_replace("[state_for_news_feed]",$state_for_news_feed,$template_data);
$template_data = str_replace("[News_Feed_css]",'<div id="News_Feed" class="News_Feed">' . $news_feed_data . '</div>',$template_data);








$tags_data = ('<ul class="tag_links">
 <br>
{
<li><a href="[current_url]">Local Roofers Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Companies Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repair Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repairs Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers Located Near Me in [city], [state]</a></li>
|
<li><a href="[current_url]">Local Roofing Companies Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repair Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repairs Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Companies Located close by in [city], [state]</a></li>
|
<li><a href="[current_url]">Local Roofing Contractors Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repair Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repairs Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Located close by  in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Companies Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Located near your location in [city], [state]</a></li>
|
<li><a href="[current_url]">Local Roofing Company Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repair Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repairs Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Companies Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company Located near my location in [city], [state]</a></li>
|
<li><a href="[current_url]">Local Roof Repair Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repairs Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Companies based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roof Repair based near me in [city], [state]</a></li>
|
<li><a href="[current_url]">Local Roof Repairs based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Siding Replacement based near me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Located Near Me in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Company Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofer Located near your location in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofers Located close by in [city], [state]</a></li>
<li><a href="[current_url]">Local Roofing Contractors Located near my location in [city], [state]</a></li>
<li><a href="[current_url]">Local New Roof Replacement Located near your location in [city], [state]</a></li>
} 
</ul> ');
$tags_data = str_replace("[current_url]",$current_full_url,$tags_data);
$tags_data = str_replace("[city]",$city_data,$tags_data);
$tags_data = str_replace("[state]",$state_data,$tags_data);
$template_data = str_replace("[tags]",$tags_data,$template_data);
$map_data =('
<iframe async defer width="100%" height="485" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"src="https://maps.google.com/maps?q=[city_for_map]+[state_for_map]&amp;ie=UTF8&amp;&amp;output=embed&amp;z=14"></iframe><br />
');
$city_for_map = str_replace("_","+",$city);
$state_for_map = str_replace("_","+",$state);
$map_data  = str_replace("[city_for_map]",$city_for_map,$map_data);
$map_data  = str_replace("[state_for_map]",$state_for_map,$map_data);
$template_data = str_replace("[Map]",$map_data,$template_data);
$template_data = str_replace("[Map_css]",'<div id="Map" class="Map">' . $map_data . '</div>',$template_data);
echo (spin($template_data)); 
ob_flush();
flush();
ob_end_clean();
?>