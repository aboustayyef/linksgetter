<?php namespace Aboustayyef;

require "../vendor/autoload.php";

$site = "http://graphic.com.gh";

// $relTest = (new LinksUtilities)->fixRelativeLinks($rel, $site);
// echo "Test Result: $relTest";

// $relTest2 = (new LinksUtilities)->perfectUrl($base, $site);
// echo "Test Result2: $relTest2";

$getter = new LinksGetter($site);
if ($getter) {
	$getter->allLinks();
}else{
	echo "\n Having Problems with connecting to page \n";
}

?>