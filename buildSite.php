<?php
include('RAW_SITE/LAYOUTS/faith_alive.php');
$target_url = "./";
$sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

renderDoctrine();
renderHistory();
renderProphecies();
renderServices();
renderVision();
renderAboutUs();
renderHelps();
renderPastors();
renderStaff();
renderLeadership();
renderChildrens();
renderToddlers();
renderYouth();
renderMinistries();
renderBooking();
renderGalleries();
renderNews();
renderPartners();
renderTravel();
renderOutreach();
renderContact();
renderSalvation();
renderTestimonies();
renderEvents();
renderHomePage();
renderMedia();
renderBooks();
renderPrayers();
renderSermons();

$sitemap .= "</urlset>";
renderSitemap();
function renderHomePage(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/HOME_PAGE.json';
	$json_file = file_get_contents($path);
	
	addSiteMapEntry("index.html",date("Y-m-d",filemtime($path)),"weekly","1.0");
	
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url;
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
}
//DOCTRINE
function renderDoctrine(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/DOCTRINE/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."about_us";
	$jsonObj->fname = "doctrine.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("about_us/doctrine.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
}
//HISTORY
function renderHistory(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/HISTORY/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	
	addSiteMapEntry("about_us/history.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
	
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."about_us";
	$jsonObj->fname = "history.html";
	print_r($jsonObj);
	createPage($jsonObj);
}
//PROPHECIES
function renderProphecies(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/PROPHECIES/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/ABOUT_US/PROPHECIES');
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
		    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/ABOUT_US/PROPHECIES/'.$file));
			$tjsonObj->url = $target_url."about_us/prophecies";

			addSiteMapEntry("about_us/prophecies/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"yearly","0.1");

			createPage($tjsonObj);
			$content .= "<div class='post limited'>	
				<a href='/about_us/prophecies/".$tjsonObj->fname."'>
					<h2 class='postTitle'>".$tjsonObj->header."</h2>
					<p class='postDescription limited'>".substr($tjsonObj->content,0,200)."</p>
					<div class='fadeOutText'></div>
				</a>
			</div>";
		}
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	
	addSiteMapEntry("about_us/prophecies/index.html",date("Y-m-d",filemtime($path)),"yearly","0.6");
	
	$jsonObj->url = $target_url."about_us/prophecies";
	$jsonObj->fname = "index.html";
	$jsonObj->header = "Prophetic Words";
	$jsonObj->content .= $content;
	createPage($jsonObj);
}
//SERVICES
function renderServices(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/SERVICES/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	
	addSiteMapEntry("about_us/services.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
	
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."about_us";
	$jsonObj->fname = "services.html";
	print_r($jsonObj);
	createPage($jsonObj);
}
//VISION
function renderVision(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/VISION/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	
	addSiteMapEntry("about_us/vision.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
	
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."about_us";
	$jsonObj->fname = "vision.html";
	print_r($jsonObj);
	createPage($jsonObj);
}
//ABOUT US
function renderAboutUs(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/ABOUT_US/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	
	addSiteMapEntry("about_us/index.html",date("Y-m-d",filemtime($path)),"yearly","0.7");
	
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."about_us";
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
}
//EVENTS
function renderEvents(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/EVENTS/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/EVENTS');
	
	$foundFiles = array();
	
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
			if(strtotime(substr($file->getFileName(),4,2)."/".substr($file->getFileName(),6,2)."/".substr($file->getFileName(),0,4)) > time()){
				array_push($foundFiles, $file->getFilename());
			}
		}
	}
	asort( $foundFiles );
	foreach($foundFiles as $file) {
	    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/EVENTS/'.$file));
		$tjsonObj->url = $target_url."events";
		print_r($file);
		createPage($tjsonObj);
		addSiteMapEntry("events/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.3");
		$content .= "<div class='post limited' style=\"z-index: 0\">	
			<a href='/events/".$tjsonObj->fname."'>
				<h2 class='postTitle'>".$tjsonObj->header."</h2>
				<p class='postDescription limited'>".substr($tjsonObj->content,0,strpos($tjsonObj->content,"<br>"))."</p>
				<div class='fadeOutText'></div>
			</a>
		</div>";
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	// print_r($jsonObj);
	$jsonObj->url = $target_url."events";
	$jsonObj->fname = "index.html";
	// $jsonObj->header = "Preaching Engagements";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("events/index.html",date("Y-m-d",filemtime($path)),"monthly","0.8");
}
//HELPS
function renderHelps(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/LEADERSHIP_PAGE/HELPS/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."leadership";
	$jsonObj->fname = "helps.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("leadership/helps.html",date("Y-m-d",filemtime($path)),"yearly","0.2");
}
//PASTORS
function renderPastors(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/LEADERSHIP_PAGE/PASTORS/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."leadership";
	$jsonObj->fname = "pastors.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("leadership/pastors.html",date("Y-m-d",filemtime($path)),"yearly","0.6");
}
//STAFF
function renderStaff(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/LEADERSHIP_PAGE/STAFF/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."leadership";
	$jsonObj->fname = "staff.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("leadership/staff.html",date("Y-m-d",filemtime($path)),"yearly","0.4");
}
//LEADERPSHIP
function renderLeadership(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/LEADERSHIP_PAGE/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."leadership";
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("leadership/index.html",date("Y-m-d",filemtime($path)),"yearly","0.5");
}
//MEDIA
function renderMedia(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/MEDIA/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."media";
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("media/index.html",date("Y-m-d",filemtime($path)),"monthly","1.0");
}
//BOOKS
function renderBooks(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/MEDIA/BOOKS/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/MEDIA/BOOKS');
	
	$foundFiles = array();
	
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
			array_push($foundFiles, $file->getFilename());
		}
	}
	asort( $foundFiles );
	foreach($foundFiles as $file) {
	    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/MEDIA/BOOKS/'.$file));
		$tjsonObj->url = $target_url."media/books";
		$tjsonObj->fname = str_replace(".json",".html",$file);

		createPage($tjsonObj);
		addSiteMapEntry("media/books/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.3");
		$content .= "<div class='post limited' style=\"z-index: 0\">	
			<a href='/media/books/".$tjsonObj->fname."'>
				<h2 class='postTitle'>".$tjsonObj->header."</h2>
				<p class='postDescription limited'>".$tjsonObj->abstract."</p>
				<div class='fadeOutText'></div>
			</a>
		</div>";
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	$jsonObj->url = $target_url."media/books";
	$jsonObj->fname = "index.html";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("media/books/index.html",date("Y-m-d",filemtime($path)),"monthly","1.0");
}
//PRAYERS
function renderPrayers(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/MEDIA/PRAYERS/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/MEDIA/PRAYERS');
	
	$foundFiles = array();
	
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
			array_push($foundFiles, $file->getFilename());
		}
	}
	asort( $foundFiles );
	foreach($foundFiles as $file) {
	    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/MEDIA/PRAYERS/'.$file));
		$tjsonObj->url = $target_url."media/prayers";
		$tjsonObj->fname = str_replace(".json",".html",$file);

		createPage($tjsonObj);
		addSiteMapEntry("media/prayers/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.3");
		$content .= "<div class='post limited' style=\"z-index: 0\">	
			<a href='/media/prayers/".$tjsonObj->fname."'>
				<h2 class='postTitle'>".$tjsonObj->header."</h2>
				<p class='postDescription limited'>".$tjsonObj->abstract."</p>
				<div class='fadeOutText'></div>
			</a>
		</div>";
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	$jsonObj->url = $target_url."media/prayers";
	$jsonObj->fname = "index.html";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("media/prayers/index.html",date("Y-m-d",filemtime($path)),"monthly","1.0");
}
//SERMONS
function renderSermons(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/MEDIA/SERMONS/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/MEDIA/SERMONS');
	
	$foundFiles = array();
	
	foreach($dir as $file) {
		echo $file."\n";
		if(substr($file,0,1) != 'P' && !$file->isDot() && !$file->isDir()){
			array_push($foundFiles, $file->getFilename());
		}elseif($file->isDir() && !$file->isDot()){
			array_push($foundFiles, $file->getFilename()."/PLACE_HOLDER.json");
		}
	}
	asort( $foundFiles );
	foreach($foundFiles as $file) {
		echo dirname(__FILE__).'/RAW_SITE/MEDIA/SERMONS/'.$file;
	    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/MEDIA/SERMONS/'.$file));
		$tjsonObj->url = $target_url."media/sermons";
		//$tjsonObj->fname = str_replace(".json",".html",$file);
		createPage($tjsonObj);
		addSiteMapEntry("media/sermons/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.3");
		$content .= "<div class='post limited' style=\"z-index: 0\">	
			<a href='/media/sermons/".$tjsonObj->fname."'>
				<h2 class='postTitle'>".$tjsonObj->header."</h2>
				<p class='postDescription limited'>".$tjsonObj->abstract."</p>
				<div class='fadeOutText'></div>
			</a>
		</div>";
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	$jsonObj->url = $target_url."media/sermons";
	$jsonObj->fname = "index.html";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("media/sermons/index.html",date("Y-m-d",filemtime($path)),"monthly","1.0");
}
//CHILDRENS
function renderChildrens(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/MINISTRIES/CHILDRENS/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."ministries";
	$jsonObj->fname = "childrens.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("ministries/childrens.html",date("Y-m-d",filemtime($path)),"yearly","0.4");
}
//TODDLERS
function renderToddlers(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/MINISTRIES/TODDLERS/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."ministries";
	$jsonObj->fname = "toddlers.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("ministries/toddlers.html",date("Y-m-d",filemtime($path)),"yearly","0.4");
}
//YOUTH
function renderYouth(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/MINISTRIES/YOUTH/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."ministries";
	$jsonObj->fname = "youth.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("ministries/youth.html",date("Y-m-d",filemtime($path)),"yearly","0.4");
}
//MINISTRIES
function renderMinistries(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/MINISTRIES/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."ministries";
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("ministries/index.html",date("Y-m-d",filemtime($path)),"yearly","0.5");
}
//BOOKING
function renderBooking(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/BOOKING/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."outreach";
	$jsonObj->fname = "booking.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("outreach/booking.html",date("Y-m-d",filemtime($path)),"monthly","0.2");
}
//GALLERIES
function renderGalleries(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/GALLERIES/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."outreach";
	$jsonObj->fname = "galleries.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("outreach/galleries.html",date("Y-m-d",filemtime($path)),"monthly","0.8");
}
//NEWS
function renderNews(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/NEWS/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/OUTREACH/NEWS');
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
		    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/OUTREACH/NEWS/'.$file));
			$tjsonObj->url = $target_url."outreach/news";
			
			createPage($tjsonObj);
			addSiteMapEntry("outreach/news/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.5");
			
			$content .= "<div class='post limited'>	
				<a href='/outreach/news/".$tjsonObj->fname."'>
					<h2 class='postTitle'>".$tjsonObj->header."</h2>
					<p class='postDescription limited'>".substr($tjsonObj->content,0,200)."</p>
					<div class='fadeOutText'></div>
				</a>
			</div>";
		}
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	$jsonObj->url = $target_url."outreach/news";
	$jsonObj->fname = "index.html";
	$jsonObj->header = "Recent News";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("outreach/news/index.html",date("Y-m-d",filemtime($path)),"monthly","0.8");
}
//PARTNERS
function renderPartners(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/AFFILIATIONS/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."outreach";
	$jsonObj->fname = "partners.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("outreach/partners.html",date("Y-m-d",filemtime($path)),"yearly","0.3");
}
//TRAVEL
function renderTravel(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/TRAVEL/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/OUTREACH/TRAVEL');
	
	$foundFiles = array();
	
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
			if(strtotime(substr($file->getFileName(),4,2)."/".substr($file->getFileName(),6,2)."/".substr($file->getFileName(),0,4)) > time()){
				array_push($foundFiles, $file->getFilename());
			}
		}
	}
	asort( $foundFiles );
	foreach($foundFiles as $file) {
	    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/OUTREACH/TRAVEL/'.$file));
		$tjsonObj->url = $target_url."outreach/travel";

		createPage($tjsonObj);
		addSiteMapEntry("outreach/travel/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"daily","0.3");
		$content .= "<div class='post limited' style=\"z-index: 0\">	
			<a href='/outreach/travel/".$tjsonObj->fname."'>
				<h2 class='postTitle'>".$tjsonObj->header."</h2>
				<p class='postDescription limited'>".substr($tjsonObj->content,0,strpos($tjsonObj->content,"<br>"))."</p>
				<div class='fadeOutText'></div>
			</a>
		</div>";
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	// print_r($jsonObj);
	$jsonObj->url = $target_url."outreach/travel";
	$jsonObj->fname = "index.html";
	// $jsonObj->header = "Preaching Engagements";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("outreach/travel/index.html",date("Y-m-d",filemtime($path)),"monthly","0.8");
}
//OUTREACH
function renderOutreach(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/OUTREACH/PLACE_HOLDER.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url."outreach";
	$jsonObj->fname = "index.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("outreach/index.html",date("Y-m-d",filemtime($path)),"monthly","0.7");
}
//CONTACT
function renderContact(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/SINGLE_PAGES/contact.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url;
	$jsonObj->fname = "contact.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("contact.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
}
//SALVATION
function renderSalvation(){
	global $target_url;
	$path = dirname(__FILE__).'/RAW_SITE/SINGLE_PAGES/salvation.json';
	$json_file = file_get_contents($path);
	$jsonObj = json_decode($json_file);
	$jsonObj->url = $target_url;
	$jsonObj->fname = "salvation.html";
	print_r($jsonObj);
	createPage($jsonObj);
	addSiteMapEntry("salvation.html",date("Y-m-d",filemtime($path)),"yearly","0.1");
}
//TESTIMONIES
function renderTestimonies(){
	global $target_url;
	$content = "<div class='linkHolder'>";
	$path = dirname(__FILE__).'/RAW_SITE/TESTIMONIES/PLACE_HOLDER.json';
	$dir = new DirectoryIterator(dirname(__FILE__).'/RAW_SITE/TESTIMONIES');
	foreach($dir as $file) {
		if(substr($file,0,1) != 'P' && !$file->isDot()){
		    $tjsonObj = json_decode(file_get_contents(dirname(__FILE__).'/RAW_SITE/TESTIMONIES/'.$file));
			$tjsonObj->url = $target_url."testimonies";
			$tjsonObj->fname = str_replace(".json",".html",$file);
			addSiteMapEntry("testimonies/".$tjsonObj->fname,date("Y-m-d",filemtime($path)),"yearly","0.1");

			createPage($tjsonObj);
			$content .= "<div class='post limited'>	
				<a href='/testimonies/".$tjsonObj->fname."'>
					<h2 class='postTitle'>".$tjsonObj->header."</h2>
					<p class='postDescription limited'>".$tjsonObj->meta_content."</p>
					<div class='fadeOutText'></div>
				</a>
			</div>";
		}
	}
	$content .= "</div>";
	$jsonObj = json_decode(file_get_contents($path));
	
	$jsonObj->url = $target_url."testimonies";
	$jsonObj->fname = "index.html";
	$jsonObj->header = "Testimonies";
	$jsonObj->content .= $content;
	createPage($jsonObj);
	addSiteMapEntry("testimonies/index.html",date("Y-m-d",filemtime($path)),"monthly","0.8");
}

function addSiteMapEntry($url,$lastMod,$freq,$priority){
	global $sitemap;
	$sitemap .= "<url>";
	$sitemap .= "<loc>http://www.faithalivefellowship.org/".$url."</loc>";
	$sitemap .= "<lastmod>".$lastMod."</lastmod>";
	$sitemap .= "<changefreq>".$freq."</changefreq>";
	$sitemap .= "<priority>".$priority."</priority>";
	$sitemap .= "</url>\n";
}
function renderSitemap(){
	global $sitemap;
	file_put_contents("sitemap.xml", $sitemap);
	chmod("sitemap.xml", 0644);
}
