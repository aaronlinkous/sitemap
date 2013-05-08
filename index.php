<?php
	require_once 'include/connection.php';
?>
	
	
<?php
	
	global $sitemap_html;
	
	function sitemaps($pid = null){
		global $sitemap_html;
		
		$class_ul_span3		= 'span3';
		$class_li_primary 	= 'primary';
		$class_li_accent 	= 'joint accent';
	
		if (is_null($pid)){
			$menus = dbQuery("SELECT * FROM sitemap WHERE pid IS NULL ORDER BY `order` ASC;");
		} else {
			$menus = dbQuery("SELECT * FROM sitemap WHERE pid = $pid ORDER BY `order` ASC;");
		}
		if (!empty($menus)) {
			if (!is_null($pid)) $sitemap_html .= '<ul class="sortable">';
			foreach($menus as $menu){
				if (is_null($pid)) $sitemap_html .= '<ul class="sortable '.$class_ul_span3.'">';
				$id = $menu['id'];
				$class_name = $class_li_primary;
				if ($menu['type_id'] == 2) $class_name = $class_li_accent;
				$sitemap_html .= '<li id="id_'.$id.'" class="'.$class_name.'">'.$menu['name'];
				$sub_menus = dbQuery("SELECT * FROM sitemap WHERE pid = $id;");
				if (!empty($sub_menus)) sitemaps($id);
				if (is_null($pid)) $sitemap_html .= '</ul>';
				$sitemap_html .= '</li>';
	
			}
		    if (!is_null($pid)) $sitemap_html .= '</ul>';
	    }
	    
    }
    
    sitemaps();
    	
	dbClose();
	
?>
<!DOCTYPE  HTML>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/css.css" media="screen" />
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="js/fw.js"></script>
		<script src="js/simple-modal.js"></script>
		<script src="js/misc.js"></script>
	</head>
	<body>
		<input id="save_btn" type="button" value="Save order"/>
		<div class="container canvas">
			<div class="row">
				<?php echo $sitemap_html;?>
			</div>
		</div>
	</body>
</html>
