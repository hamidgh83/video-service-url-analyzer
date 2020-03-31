<?php
namespace VideoUrlAnalyzer\Analyzers;

use VideoUrlAnalyzer\Entities\Aparat as AparatEntity;

class Aparat extends Base
{
    protected static $domains = [
        'www.aparat.com',
    ];

    public function analyze($url)
    {
        if (!$this->check($url)) {
            return null;
        }
        $parsedUrlElements = parse_url($url);
        $elements          = explode('/', substr(strtolower($parsedUrlElements['path']), 1));

        $id   = $elements[count($elements) - 1];
        $type = $elements[count($elements) - 2];

        if (empty($id)) {
            return null;
        }
        
        $video = new AparatEntity($id, $type);

        return $video;
    }
}
