<?php
namespace VideoUrlAnalyzer\Analyzers;

use VideoUrlAnalyzer\Entities\YouTube as YouTubeEntity;

class YouTube extends Base
{
    protected static $domains = [
        'www.youtube.com',
        'youtu.be',
    ];

    public function analyze($url)
    {
        if (!$this->check($url)) {
            return null;
        }
        $parsedUrlElements = parse_url($url);
        $id                = null;
        if (!isset($parsedUrlElements['host'])) {
            return null;
        }
        switch (strtolower($parsedUrlElements['host'])) {
            case 'www.youtube.com':
                if (isset($parsedUrlElements['path'])) {
                    $path = explode('/', substr($parsedUrlElements['path'], 1));
                    if (strtolower($path[0]) == 'embed' && count($path) == 2) {
                        $id = $path[1];
                        break;
                    }
                    if (isset($parsedUrlElements['query'])) {
                        parse_str($parsedUrlElements['query'], $queryParams);
                        if (!array_key_exists('v', $queryParams)) {
                            return null;
                        }
                        $id = $queryParams['v'];
                    }
                }
                break;
            case 'youtu.be':
                $id = explode('/', substr($parsedUrlElements['path'], 1))[0];
                break;
        }
        if (empty($id)) {
            return null;
        }
        $video = new YouTubeEntity($id);
        $title = $name = $video->getTitle();
        if( empty($title) ) {
            return null;
        }
        return $video;
    }
}
