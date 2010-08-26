<?php
@$id = $_GET['id'];
$xml_file = "map.xml";

// Load XML
$xml = simplexml_load_file($xml_file);

// Build Array From XML
$i = 0;
foreach($xml->children() as $child)
{
	$country[$i] = array("id" => $child->id, "name" => $child->name, "description" => $child->description, "treated" => $child->treated, "coords" => $child->coords);
	++$i;
}

// Check to see what should be delete
$new_xml = '<?xml version="1.0" encoding="utf-8" ?><map>';
foreach($country as $value)
{
	if($value['id'] == $id)
	{
		// Do not add to $new_xml
	}
	else
	{
		$new_xml .= "<country>";
		// Add to $new_xml
		foreach($value as $key => $val)
		{
			$new_xml .= "<".$key.">".$val."</".$key.">";
		}
		$new_xml .= "</country>";
	}
}
$new_xml .= "</map>";

// Write new XML File
file_put_contents("map.xml", $new_xml);
header("location: admin_delete_success.html");
?>