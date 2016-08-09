<?php 
function createPage($jsonObj){
	print_r($jsonObj);
	$page_title = $jsonObj->title;
	$meta_content = $jsonObj->meta_content;
	$page_header = $jsonObj->header;
	$rel_url = $jsonObj->url;
	echo $rel_url;
	$filename = $jsonObj->fname;
	$page_content = $jsonObj->content;
	$create_date = $jsonObj->cdate;
	$mod_date = $jsonObj->mdate;
	$exclude = $jsonObj->exclude;
	$css_file = $jsonObj->css_file;
	$header_content = $jsonObj->header_content;
	if (!$exclude) { $exclude = false; }
	if (!$page_title) { $page_title = "FAF - Template"; }
	if (!$meta_content) { $meta_content = "150-160 character summary with keywords on this article"; }
	if( strlen($page_title) > 55 ) { throw new Exception("Your title needs to be shorter"); }
	if (strpos($page_title, "-- Faith Alive Fellowship") !== false) {
		 throw new Exception("Remove deprecated values"); 
	}else{
		 $page_title .= " - Faith Alive Fellowship";
	}
	if (!$rel_url) { throw new Exception("You forgot to define the URL"); }
	if (!$page_header) { throw new Exception("You forgot to define a page header"); }
	if (!$filename) { throw new Exception("You done messed up"); } else { $filename = str_replace(".php",".html",$filename); }
	if (!$page_content) { throw new Exception("Missing page"); }
	// if (strlen($meta_content) < 150) {throw new Exception("Your Meta is too short ");}
	// if (strlen($meta_content) > 160) {throw new Exception("Your Meta is too long ");}
	echo basename(dirname(__DIR__));
	echo "\n";
	// $rel_url = substr($rel_url,strpos($rel_url,"POSTS")+6);
	echo "\n";
	echo "$rel_url/$filename";
	echo "\n";
	ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($page_title); ?></title>
		<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/nav.css" />
		<link rel="stylesheet" type="text/css" href="/css/footer.css" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<?php
			if($exclude){
				echo "<meta name=\"robots\" content=\"noindex\" />";
			}else{
				echo "<meta name=\"description\" content=\"$meta_content\" />";
			}
		?>
		<?php
			if($css_file){
				echo "<link rel='stylesheet' type='text/css' href='/css/".$css_file.".css' />";
			}
			if($header_content){
				echo $header_content;
			}
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div id="bgImage"><a href="/"><h1 class="title1">FAITH ALIVE FELLOWSHIP</h1></a></div>
		<div class="topBar">
			<div class="contact"><h4>Sundays @ 10:00 am | <a href="/contact.html">Contact Us</a></h4></div>
			<div class="smediaHolder">
				<div id="menu">
					<div class="hamLine"></div>
					<div class="hamLine"></div>
					<div class="hamLine"></div>
				</div>
				<a href="https://www.facebook.com/pages/Faith-Alive-Fellowship/522267067929628?sk=timeline"><div id="Facebook"></div></a>
				<a href="https://www.youtube.com/user/fafvideo1"><div id="Youtube"></div></a>
				<a href="https://twitter.com/KnocksAtTheDoor"><div id="Twitter"></div></a>
				<a href="https://plus.google.com/112284199753242978219/posts"><div id="Google"></div></a>
				<!-- <div class="connect"></div> -->
			</div>
			<a href="/"><h1 class="title2">FAITH ALIVE FELLOWSHIP</h1></a>
			<h4 class="title3">Sturgeon Bay, WI</h4>
		</div>
		<?php include 'components/nav.html';?>
		<article class="content" align="left">
			<header class="current">
				<h1><?php echo($page_header); ?></h1>
				<p class="ptime">
					<?php 
					if($create_date){
						if(is_numeric($create_date)){
							echo "Posted: <i>";
							echo(date("l F jS\, Y",$create_date)); 
							echo "</i>";
						}
					}
					?>
					<?php 
					if($mod_date){
						if(is_numeric($mod_date)){
							echo "<br>Last modified: <i>";
							echo(date("l F jS\, Y",$mod_date)); 
							echo "</i>";
						}
					}
					?></p>
				<hr>
				<?php echo($page_content); ?>
			</header>
			<aside>
				<h4>Pastor Thomas C. Terry</h4>
				<hr>
				<div id='pastor_bio'>Thank you for visiting,
					I would like to invite you to join me on social
					media or at one of our services for a study in the Word!
					</div>
				<a href="https://www.facebook.com/thomas.c.terry"><div id="Facebook"></div></a>
				<a href="https://www.youtube.com/user/MrThomascterry"><div id="Youtube"></div></a>
				<a href="https://twitter.com/wildmanfromWisc"><div id="Twitter"></div></a>
				<a href="https://plus.google.com/112284199753242978219"><div id="Google"></div></a>
				<a href="https://www.linkedin.com/pub/thomas-terry/47/7b0/782"><div id="LinkedIn"></div></a>
				<a href="https://katch.me/wildmanfromWisc"><div id="Katch"></div></a>
				<a href="https://www.periscope.tv/wildmanfromWisc"><div id="Periscope"></div></a>
			</aside>
		</article>
		<?php include 'components/bot.html';?>
		<script>
			document.getElementById("menu").onclick = function(e){
				this.classList.toggle("open");
				document.getElementById("navBar").classList.toggle("open");
				e.stopPropagation();
			}
		</script>
	</body>
</html>
<?php
	if(!file_exists("$rel_url")){
		mkdir("$rel_url", 0755, true);
	}
	$order   = array("\r\n\r\n", "\n\n", "\r\r");
	$replace = '<br><br>';

	// Processes \r\n's first so they aren't converted twice.
	$newstr = str_replace($order, $replace,ob_get_contents());
	file_put_contents("$rel_url/$filename", $newstr);
	chmod("$rel_url/$filename", 0644);
	ob_end_flush();
}
function createSubArticle($ptitle,$mcontent,$phead,$content,$exclude){
	$page_title = $GLOBALS['ptitle'];
	$meta_content = $GLOBALS['mcontent'];
	$rel_url = $GLOBALS['url'];
	$page_header = $GLOBALS['phead'];
	$filename = $GLOBALS['fname'];
	$page_content = $GLOBALS['content'];
	$create_date = $GLOBALS['cdate'];
	$mod_date = $GLOBALS['mdate'];
	$exclude = $GLOBALS['exclude'];
	if (!$exclude) { $exclude = false; }
	if (!$page_title) { $page_title = "Weborg Technologies - Template"; } else { $page_title = "$page_title - Weborg Technologies"; }
	if (!$meta_content) { $meta_content = "150-160 character summary with keywords on this article"; }
	if (!$rel_url) { throw new Exception("You forgot to define the URL"); }
	if (!$page_header) { throw new Exception("You forgot to define "); }
	if (!$filename) { throw new Exception("You done messed up"); } else { $filename = str_replace(".php",".html",$filename); }
	if (!$page_content) { throw new Exception("Missing page"); }
	echo basename(dirname(__DIR__));
	echo "\n";
	$rel_url = substr($rel_url,strpos($rel_url,"POSTS")+6);
	echo "\n";
	echo "$rel_url/$filename";
	echo "\n";
	ob_start();
	
?>
	<article class="post">
    	<div class="postTitle"><?php echo($page_header); ?></div>
    	<div class="postDescription"><?php echo($page_content); ?></div>
    </article>
<?php
	if(!file_exists("blog/$rel_url")){
		mkdir("blog/$rel_url", 0755, true);
	}
	file_put_contents("blog/$rel_url/$filename", ob_get_contents());
	chmod("blog/$rel_url/$filename", 0644);
	ob_end_flush();
}
?>