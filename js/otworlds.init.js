/**
 * Initializing of the main interface on Otworlds
 */

var $viewport;
var $canvas;
jQuery(document).ready(function(){
	$viewport = jQuery("#viewport");
	$canvas = jQuery("#canvas");
	
	function showmap(id) {
		jQuery(".toolbar").animate({'opacity': 1}, 300, function(){
			Mapeditor.load(id);
			_gaq.push(['_trackPageview', '/maps/'+id]);
		});
	}
	
	if (window.location.hash.substr(1, 5) == 'mapid') {
		jQuery("#welcome").remove();
		showmap(window.location.hash.substr(7));
	}else{
		_gaq.push(['_trackPageview', '/welcome']);
		
		jQuery('#welcome a[href="#welcome-listmaps"]').click(function(){
			jQuery.ajax(Mapeditor.config.urls.backend, {
				dataType: "json",
				data: {
					'action' : 'listMaps',
				},
				success: function(data){
					var $box = jQuery("#welcome > div");
					var list = '<h2>Available maps</h2>';
					list += '<ul>';
					jQuery.each(data.maps, function(key, val){
						list += '<li><a href="#mapid-'+ val.id +'" class="loadmap" data-id="'+ val.id +'">'+ val.name +'</a></li>';
					});
					list += '</ul>';
					$box.html(list);
					_gaq.push(['_trackPageview', '/maps']);
				}
			});
		});
		
		jQuery("#welcome").delegate('a.loadmap', 'click', function(){
			var $this = jQuery(this);
			showmap($this.attr('data-id'));
			jQuery("#welcome").animate({'opacity': 0}, 300, function(){
				jQuery("#welcome").remove();
			});
		});
	}
	
	//Keep track of whether we need to lookup ".tile.hovered" all the time
	var hoveredElements = 0;
	var mouseIsPressed = false;
	$viewport.on({
		mousemove: function(e) {
			if (Mapeditor.isEditing) {
				if(hoveredElements > 0) jQuery(".tile.hovered").removeClass('hovered');
				var $target = Mapeditor.internals.figureOutTile(e);
				$target.addClass('hovered');
				hoveredElements++;
				
				if (Mapeditor.isEditing && mouseIsPressed) {
				var activeBrush = Mapeditor.Materials.Brushes.active;
				var $target = Mapeditor.internals.figureOutTile(e);
				
				var Tile = $target.getTile();
				Tile.setItemid( Mapeditor.Materials.Brushes[activeBrush].server_lookid );
				
				console.log('Painting '+Mapeditor.Materials.Brushes[activeBrush].name+' on '+$target.attr('col')+', '+$target.attr('row')+', '+Mapeditor.map.currentFloor);
			}
			}
		},
		//Painting when editing is active
		click: function(e) {
			if (Mapeditor.isEditing) {
				var activeBrush = Mapeditor.Materials.Brushes.active;
				var $target = Mapeditor.internals.figureOutTile(e);
				
				var Tile = $target.getTile();
				Tile.setItemid( Mapeditor.Materials.Brushes[activeBrush].server_lookid );
				
				console.log('Painting '+Mapeditor.Materials.Brushes[activeBrush].name+' on '+$target.attr('col')+', '+$target.attr('row')+', '+Mapeditor.map.currentFloor);
			}
		},
		mousedown: function(e) {
			if (e.which == 1) {
				mouseIsPressed = true;
			}
		},
		mouseup: function(e) {
			if (e.which == 1) {
				mouseIsPressed = false;
			}
		}
	}, '.tile');
	jQuery(window).keyup(function(e) {
		//Spacebar
		if (e.which == 32) {
			Mapeditor.toggleEdit();
			e.preventDefault();
			e.stopPropagation();
		}
	});
	jQuery('#brushes').on({
		click: function(e) {
			var $this = jQuery(this);
			if (!$this.hasClass('active')) {
				jQuery('.active').removeClass('active');
				$this.addClass('active');
				Mapeditor.Materials.Brushes.active = $this.data('name');
				
				if (!Mapeditor.isEditing) {
					Mapeditor.toggleEdit();
				}
			}
		}
	}, '.brush')
	
});