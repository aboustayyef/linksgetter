<?php

namespace Aboustayyef;

/**
* 
*/
class LinksUtilities
{
	
	function __construct()
	{
		# nothing...
	}

	public function fixRelativeLinks($rel, $base){

		// Source: https://subinsb.com/how-to-create-a-simple-web-crawler-in-php
		
		if (parse_url($rel, PHP_URL_SCHEME) != ''){
			return $rel;
		}
		if ($rel[0]=='#' || $rel[0]=='?'){
			return $base.$rel;
		}
		extract(parse_url($base));
		$path = preg_replace('#/[^/]*$#', '', $path);
		if ($rel[0] == '/'){
			$path = '';
		}
		$abs = "$host$path/$rel";
		$re = array('#(/.?/)#', '#/(?!..)[^/]+/../#');
		for($n=1; $n>0;$abs=preg_replace($re,'/', $abs,-1,$n)){}
		$abs=str_replace("../","",$abs);
		return $scheme.'://'.$abs;
	}

	public function perfectUrl($u,$b){

		$bp=parse_url($b);
		if(($bp['path']!="/" && $bp['path']!="") || $bp['path']==''){
			if($bp['scheme']==""){
				$scheme="http";
			}else{
				$scheme=$bp['scheme'];
			}
			$b=$scheme."://".$bp['host']."/";
		}
		if(substr($u,0,2)=="//"){
			$u="http:".$u;
		}
		if(substr($u,0,4)!="http"){
			$u=$this->fixRelativeLinks($u,$b);
		}

		if (strpos($u, 'javascript') === 0) {
			return false;
		}

		return $u;
	} 

}

?>