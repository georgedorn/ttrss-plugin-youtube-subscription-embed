<?php
class Youtube_Gdata extends Plugin {

	function about() {
		return array(0.1,
			"Embed video player in gdata.youtube.com feeds",
			"gdorn",
			false);
	}

	function api_version() {
		return 2;
	}

	function init($host) {
		$host->add_hook($host::HOOK_RENDER_ARTICLE_CDM, $this);
		$host->add_hook($host::HOOK_RENDER_ARTICLE, $this);
	}

	function hook_render_article_cdm($article) {
		return $this->hook_render_article($article);
	}

	function hook_render_article($article) {

		if (strpos($article['link'], "youtube_gdata") === false){
			return $article;
		}
		$info = "";

		$doc = new DOMDocument();
		$doc->loadHTML($article['content']);
		$xpath = new DOMXPath($doc);
		$entries = $xpath->query('//div/a/img');

		foreach ($entries as $entry) {
			$src = $this->_getSrcAttribute($entry);
			$info .= "|SRC: $src|";
			$url = parse_url($src);
			if (strpos($url['path'], '/vi/') !== 0){
			  $info .= "|Bad path?|";
			  continue;
			}
			$url_parts = explode('/', $url['path']);
			$video_id = $url_parts[2];  // null, '/vi/', video_id, '.jpg'
			$info .= "|Video id: $video_id";

			$tag_object = $entry->parentNode;
			$tag_parent = $tag_object->parentNode;
			$height     = intval($entry->getAttribute('height'));
			$width      = intval($entry->getAttribute('width'));
			// youtube defaults
			if ($height < 10) {
				$height = 315;
			}
			if ($width  < 10) {
				$width = 560;
			}

			$tag_iframe = $doc->createElement('iframe');
			$tag_iframe->setAttribute('allowfullscreen', '');
			$tag_iframe->setAttribute('width', $width);
			$tag_iframe->setAttribute('height', $height);
			$tag_iframe->setAttribute('frameborder', '0');
			$tag_iframe->setAttribute('src', "https://www.youtube.com/embed/$video_id");

			$tag_parent->replaceChild($tag_iframe, $tag_object);
		}


		$article['content'] = $doc->saveHTML();
		//Use this to debug if something goes wrong:
		//$article['content'] .= "<br>INFO:" . $info;
		return $article;
	}

	protected function _getSrcAttribute(DOMNode $node)
	{
		$src = $node->getAttribute('src');
		// unfortunately parse_url won't support urls without protocol
		// (albeit apparently allowed by the RFC...)
		if (strpos($src, '//') === 0) {
			$src = 'https:' . $src;
		}

		return $src;
	}

}
