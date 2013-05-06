<?php
	require_once 'include/connection.php';
?>
	
	
<?php
	global $sitemap_html;
	
	function sitemaps($pid = null){
		global $sitemap_html;
		if (is_null($pid))
			$menus = dbQuery("SELECT * FROM sitemap WHERE pid IS NULL ORDER BY `order` ASC;");
		else 
			$menus = dbQuery("SELECT * FROM sitemap WHERE pid = $pid ORDER BY `order` ASC;");
		if (!empty($menus)) {
			if (!is_null($pid)) $sitemap_html .= '<ul>';
			foreach($menus as $menu){
				if (is_null($pid)) $sitemap_html .= '<ul class="span3">';
				$id = $menu['id'];
				$class_name = 'primary';
				if ($menu['type_id'] == 2) $class_name = 'joint accent';
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
 <style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
html>body #sortable li { height: 1.5em; line-height: 1.2em; }
.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="js/fw.js"></script>
		<script src="js/simple-modal.js"></script>
		<script src="js/misc.js"></script>
		<script>
		
		$(function() {
			$( "ul" ).sortable({
				connectWith: "ul",
				placeholder: "placeholder",
				dropOnEmpty: true,
				update: function(event, ui) {
			        //alert(getObjID());
			    }
			}).disableSelection();

		});
		
		function getObjID(){
			var json = new Array();
			var order = new Array();
			$("ul li").each(function(index){
				var obj = {};
				var id = $(this).attr("id").split(/_/);
				obj.id = Number(id[1]);
				
				var parent = $(this).parent().parent().attr("id");
				if (parent == undefined){
					obj.pid = 0;
				} else {
					parent = parent.split(/_/);
					obj.pid = Number(parent[1]);
				}
				if (order[obj.pid] == null) order[obj.pid] = 0;
				order[obj.pid]++;
				obj.order = order[obj.pid];
				json.push(obj)
			});
			return JSON.stringify(json);
		}
		</script>		
	</head>
	<body>
		<div class="container canvas">
			<div class="row">
				<?php echo $sitemap_html;?>
			</div>
		</div>
	</body>
</html>