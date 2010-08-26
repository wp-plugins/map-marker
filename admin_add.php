<?php
$coords = $_GET['coords'];

if(is_null($coords))
{
	$coords = "1,1";
}
else
{
	$coords = explode(",", $coords);
	if(is_numeric($coords[0]) && is_numeric($coords[1]))
	{
		$coords = $coords[0] . "," . $coords[1];
	}
	else
	{
		$coords = "1,1";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add a marker</title>
</head>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#country_name').focus();
});
</script>
<body>
<div id="add_form">
<form id="add_to_map" method="post" action="admin_add_process.php">
<table align="center">
<tr>
<td>County Name:</td>
<td><input type="text" name="country_name" id="country_name" /></td>
</tr>
<tr>
<td>Description:</td>
<td><input type="text" name="description" id="description" /></td>
</tr>
<tr>
<td>Children Treated:</td>
<td><input type="text" name="treated" id="treated" /></td>
</tr>
<tr>
<td>Coords:</td>
<td><input type="text" name="coords" id="coords" readonly="readonly" value="<?php echo $coords; ?>" /></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="Submit" /></td>
</tr>
</table>
</form>
</div>
</body>
</html>