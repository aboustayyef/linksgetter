<?php

namespace Aboustayyef;
use Symfony\Component\DomCrawler\Crawler as Crawler;

class LinksGetter
{

	protected $content;
	public $crawler;
    public $url;

	public function __construct($url, $internalUrlsOnly = true){
        $this->url = $url;
        $this->internalUrlsOnly = $internalUrlsOnly;
		try {
        	$this->content = @file_get_contents($url);
        	if (strlen($this->content) > 10) {
                $this->crawler = new Crawler;
                $this->crawler->addHTMLContent($this->content, 'UTF-8');
                return true;
        	}else{
                return false;
            }
        } catch (Exception $e) {
        	echo "couldn't extract url";
            return false;
        }
	}

    public function allLinks(){
        $allUrls = $this->crawler->filter('a');
        $result = [];
        echo "\n************** " . $this->getBase() . " *****************\n";
        foreach ($allUrls as $key => $url) {
            $rawLink = $url->getAttribute('href');
            $cleanLink = (new LinksUtilities)->perfectUrl($rawLink, $this->url);

            if ($cleanLink) {
                if ((strpos($cleanLink, $this->getBase()) === 0) && $this->internalUrlsOnly) {
                    $result[] = $cleanLink; 
                }
            }
        }
        var_dump($result);
    }

    public function getBase(){
        $parts = parse_url($this->url);
        return $parts['scheme'] . "://" . $parts['host'];
    }


}
