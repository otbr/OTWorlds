<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>OTWorlds Mapeditor</title>
	
	<link rel="shortcut icon" href="img/spellbook-16x16.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	
	<script src="js/jquery.pep.js"></script>
	<script src="js/jquery.infinitedrag/jquery.infinitedrag.js"></script>
	
	<script src="js/vex/js/vex.combined.min.js"></script>
	<script>vex.defaultOptions.className = 'vex-theme-os';</script>
	<link rel="stylesheet" href="js/vex/css/vex.css" />
	<link rel="stylesheet" href="js/vex/css/vex-theme-os.css" />
	<?php
	$allowed = false;
	if(isset($facebook)){
		$profile = $facebook->api('/me');
		
		$logtext = '['.date('d-M-Y H:i:s').'] '.$profile['link'].PHP_EOL;
		file_put_contents('facebook.log', $logtext, FILE_APPEND);
		
		$allowed_usernames = array(
			'eliascarlsson',
			'joakim.hedlund',
			'joran.haagsma',
			'micke.hafner',
		);
		if(in_array($profile['username'], $allowed_usernames)) $allowed = true;
		
	}elseif($_SERVER['HTTP_HOST'] == 'localhost'){
		$allowed = true;
	}
	if($allowed){
	?>
	
		<script src="js/otworlds.mapeditor.js"></script>
		<script src="js/otworlds.materials.js"></script>
		<script src="js/otworlds.tile.js"></script>
		<script src="js/otworlds.tiles.js"></script>
		
		<script src="js/otworlds.init.js"></script>
	<?php
	}
	?>
</head>
<body id="page-main">
	<div class="toolbar" id="menu">
		<span class="mapname">
			<i class="icon-down-open"></i>
			Testmap.otwm
			<ul>
				<li><a href="#">New map</a></li>
				<li><a href="#">Load map</a></li>
			</ul>
		</span>
		<a>
			<i class="icon-download"></i>Download OTBM
		</a><a>
			<i class="icon-share"></i>Share
		</a><a href="http://html2canvas.hertzen.com/examples.html" target="_blank">
			<i class="icon-camera"></i>Screenshot
		</a><a>
			<i class="icon-help-circled"></i>Help
		</a><a href="#">
			<i class="icon-logout"></i>Logout
			<?php
			if(isset($facebook)){
				print htmlentities($profile['username'], ENT_COMPAT, 'UTF-8');
			}
			?>
		</a>
	</div>
	<div id="viewport">
		<div id="canvas"></div>
	</div>
	<div class="toolbar" id="brushes" style="width: 250px; left: 0px; top: 0px; bottom: 0px; overflow-y: scroll;">
		<ul id="itemlist">
		</ul>
	</div>
	<div id="welcome">
		<div>
			<div class="row" id="hero">
				<div class="twelve columns">
					<h1 class="center-text">Welcome<?php
					if(isset($facebook)){
						print ', ';
						print htmlentities($profile['first_name'], ENT_COMPAT, 'UTF-8');
					}
					?>!</h1>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p>Because this is a work in progress, and features are being removed as quickly as they were added, we only allow approved beta-testers to use the editor.</p>
					<p>If you want to get in on the action or just want to support the project, drop a greeting to <a href="http://twitter.com/Sleavely" target="_blank" title="@sleavely on Twitter">@Sleavely</a>.</p>
				</div>
			</div>
			<?php if($allowed){ ?>
			<div class="row">
				<div class="push_five seven columns center-text">
					<div class="large danger btn"><a href="#">Get started</a></div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-2840885-9']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
</body>
</html>