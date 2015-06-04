#Previewer for URLs

This class takes a url as input and outputs an array of links in that url

##Usage

```
<?php 

use Aboustayyef\LinksGetter;

$getter = new LinksGetter('http://url.goes/here');
$links = $getter->allLinks();

?>

```