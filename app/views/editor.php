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
	
	<link rel="stylesheet" href="js/shepherd/css/shepherd-theme-arrows.css" />
	<script src="js/shepherd/shepherd.min.js"></script>
	
	<?php
	$allowed = false;
	$user = Auth::user();
	$profile = Profile::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->first();
	
	$logtext = '['.date('d-M-Y H:i:s').'] '.$profile->username.PHP_EOL;
	file_put_contents(storage_path().'/logs/facebook.log', $logtext, FILE_APPEND);
	?>
	<!-- build:js js/otworlds.min.js -->
	<script src="js/otworlds.mapeditor.js"></script>
	<script src="js/otworlds.materials.js"></script>
	<script src="js/otworlds.minimap.js"></script>
	<script src="js/otworlds.multiplayer.js"></script>
	<script src="js/otworlds.tile.js"></script>
	<script src="js/otworlds.tiles.js"></script>
	<script src="js/otworlds.shepherd.js"></script>
	<!-- endbuild -->
	
	<script>
	var TogetherJSConfig_siteName = 'OTWorlds';
	var TogetherJSConfig_suppressJoinConfirmation = true;
	//var TogetherJSConfig_suppressInvite = true;
	var TogetherJSConfig_includeHashInUrl = true;
	var TogetherJSConfig_dontShowClicks = true;
	<?php
	print 'var TogetherJSConfig_getUserName = "'.$user->name.'";';
	print 'var TogetherJSConfig_getUserAvatar = "'.$user->photo.'";';
	?>
	//Remove any sessions that may remain open from other maps
	sessionStorage.removeItem("togetherjs-session.status");
	</script>
	<script src="https://togetherjs.com/togetherjs-min.js"></script>
	
	<script src="js/otworlds.init.js"></script>
</head>
<body id="page-main">
	<div class="toolbar" id="menu">
		<span class="mapname">
			<i class="icon-down-open"></i>
			<span><em>No map loaded</em></span>
			<ul>
				<li><a href="#" onclick="createmap(); return false;">New map</a></li>
				<li><a href="#" onclick="showmaps(); return false;">Load map</a></li>
			</ul>
		</span>
		<a class="disabled">
			<i class="icon-download"></i>Download OTBM
		</a><a href="#share" onclick="sharemap(); return false;">
			<i class="icon-share"></i>Share
		</a><a href="http://html2canvas.hertzen.com/examples.html" target="_blank">
			<i class="icon-camera"></i>Screenshot
		</a><a href="#" onclick="Mapeditor.Shepherd.tour.start(); return false;">
			<i class="icon-help-circled"></i>Help
		</a><a href="/logout">
			<i class="icon-logout"></i>Logout <?php	print $profile->username; ?>
		</a>
	</div>
	<div id="viewport">
		<div id="canvas"></div>
	</div>
	<div class="toolbar" id="brushes" style="width: 250px; left: 0px; top: 0px; bottom: 0px; overflow-y: scroll;">
		<ul id="itemlist">
		</ul>
	</div>
	<div class="toolbar" id="minimap">
		<div class="content">
		</div>
	</div>
	<div id="welcome">
		<div>
			<div class="row" id="hero">
				<div class="twelve columns">
					<h1 class="center-text">Welcome!</h1>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<p>I hope you'll enjoy my hobby project. Please remember that this is an experiment in using web technologies and not a drop-in replacement for <a href="http://remeresmapeditor.com/" target="_blank" title="Remeres Map Editor">RME</a>, so all those fancy features you're used to are probably missing. At some point in the future they might get added, but they also might not.</p>
					<p>If you want to get in on the action or just want to support the project, drop a greeting on <a href="http://opentibia.net/topic/173113-mapeditor-otworlds/" target="_blank" title="OTWorlds on OpenTibia.net">the forum</a> or tweet me directly; <a href="http://twitter.com/Sleavely" target="_blank" title="@sleavely on Twitter">@Sleavely</a>.</p>
				</div>
			</div>
			<div class="row">
				<div class="push_five seven columns center-text">
					<div class="large danger btn"><a href="#">Get started</a></div>
				</div>
			</div>
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