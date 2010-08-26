<?php
/*
Plugin Name: Map Marker 
Plugin URI: http://xenonsoft.co.uk/wp_plugins/map_markers
Description: Add Markers with description to a map! 
Version: 0.4.1 
Author: Mike Gatward 
Author URI: http://xenonsoft.co.uk/wp_plugins 
*/

function my_function($text)
{
	$map_path = plugins_url('map.html', __FILE__);
	$code = "<iframe style=\"width:780px; height:410px; margin:0px; padding:0px; border:0px;\" src=\"".$map_path."\"></iframe>";
	$text = str_replace("[Marker_Map]", $code, $text);
	return $text;
}

add_filter("the_content", "my_function");



/*

	ADMIN SECTION
	
*/
if (!class_exists("MapMarkerAdmin")) {
	class MapMarkerAdmin {
		var $adminOptionsName = "MapMarkerAdminOptions";
		function MapMarkerAdmin() { //constructor
			
		}
		function init() {
			$this->getAdminOptions();
		}
		//Returns an array of admin options
		function getAdminOptions() {
			$MapMarkerAdminOptions = array('show_header' => 'true',
				'add_content' => 'true', 
				'comment_author' => 'true', 
				'content' => '');
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$MapMarkerAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $MapMarkerAdminOptions);
			return $MapMarkerAdminOptions;
		}
		
		function addHeaderCode() {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['show_header'] == "false") { return; }
			?>
<!-- Devlounge Was Here -->
			<?php
		
		}
		function addContent($content = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['add_content'] == "true") {
				$content .= $devOptions['content'];
			}
			return $content;
		}
		function authorUpperCase($author = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['comment_author'] == "true") {
				$author = strtoupper($author);
			}
			return $author;
		}
		//Prints out the admin page
		function printAdminPage() {
			$admin_map_path = plugins_url('admin_map.html', __FILE__);
			$admin_delete = plugins_url('admin_delete_marker.php', __FILE__);
			?>
            <div class=wrap>
            <div style="display:block; margin-top:10px;"><h2 style="display:inline;">Click the map to add a new marker!</h2> - <a href="#" onclick="window.addmarkermap.location.reload();">refresh</a></div>
            <iframe id="addmarkermap" style="width:780px; height:410px; margin:0px; padding:0px; border:0px; overflow:visible;" src="<?php echo $admin_map_path; ?>"></iframe>
            <br />
            <div style="display:block;"><h2 style="display:inline;">Delete markers</h2> - <a href="#" onclick="window.deletemarkers.location.reload();">refresh</a></div>
            <iframe id="deletemarkers" style="width:400px; height:auto; margin:0px; padding:0px; border:0px; overflow:visible;" src="<?php echo $admin_delete; ?>"></iframe>
           
            </div>
			<?php
		}//End function printAdminPage()
	
	}

} //End Class DevloungePluginSeries

if (class_exists("MapMarkerAdmin")) {
	$dl_pluginSeries = new MapMarkerAdmin();
}

//Initialize the admin panel
if (!function_exists("MapMarkerAdmin_ap")) {
	function MapMarkerAdmin_ap() {
		global $dl_pluginSeries;
		if (!isset($dl_pluginSeries)) {
			return;
		}
		if (function_exists('add_options_page')) {
	add_options_page('Map_Marker', 'Map Marker Admin', 9, basename(__FILE__), array(&$dl_pluginSeries, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_pluginSeries)) {
	//Actions
	add_action('admin_menu', 'MapMarkerAdmin_ap');
	add_action('wp_head', array(&$dl_pluginSeries, 'addHeaderCode'), 1);
	add_action('activate_MapMarkerAdmin/index.php',  array(&$dl_pluginSeries, 'init'));
	//Filters
	add_filter('the_content', array(&$dl_pluginSeries, 'addContent'),1); 
	add_filter('get_comment_author', array(&$dl_pluginSeries, 'authorUpperCase'));
}


?>