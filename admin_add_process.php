<?php
$new['id'] = date('U');
$new['name'] = htmlspecialchars($_POST['country_name'], ENT_QUOTES);
$new['description'] = htmlspecialchars($_POST['description'] ,ENT_QUOTES);
$new['treated'] = htmlspecialchars($_POST['treated'], ENT_QUOTES);
$new['coords'] = $_POST['coords'];

$xml_file = file_get_contents("map.xml"); 

// Add new data to $new_xml
$new_xml = "<country>";
foreach($new as $key => $value)
{
	$new_xml .= "<".$key.">".$value."</".$key.">";
}
$new_xml .= "</country></map>";

// Write XML
$xml_file = substr_replace($xml_file, "", -6);
$new_xml = $xml_file . $new_xml;
file_put_contents("map.xml", $new_xml);
header("location: admin_success.html");
?>