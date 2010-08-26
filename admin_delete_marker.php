<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#tooltip {
    padding: 5px 10px;
    background: #cad7e0;
    border: 1px solid #b2bdc3;
    opacity: 0.90;
}
</style>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.hoverbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		type: "GET",
		url: "map.xml",
		dataType: "xml",
		success: function(xml) {
			$(xml).find('map').each(function(){
				$(this).find('country').each(function(){
					var id = $(this).find('id').text();
					var name = $(this).find('name').text();
					var description = $(this).find('description').text();
					var treated = $(this).find('treated').text();
					var coords = $(this).find('coords').text();
					coords = coords.split(',');
					var left = coords[0];
					var top = coords[1];
					$('#list').append('<span title="Desc: '+description+'<br />Treated: '+treated+'"><img src="images/marker.png" style="margin:0px; width:10px; height:10px; padding:0;" /> '+name+'</span> - <a href="admin_delete_marker_process.php?id='+id+'" onclick="if(confirm(\'Are you sure you want to delete this?\') == false) { return false; }">Delete Marker</a><br />');
					$(function(){
						$('span').hoverbox();
					});
				});
			});
		}
	});
});

</script>
</head>
<body>
<div id="list"></div>
</body>
</html>