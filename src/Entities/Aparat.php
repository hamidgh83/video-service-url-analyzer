<?php
namespace VideoUrlAnalyzer\Entities;

class Aparat extends Base
{
    protected $type;

    public function __construct($id, $type)
    {
        $this->type = $type;

        return parent::__construct($id);
    }

    public function getEmbeddedSrcUrl()
    {
        return 'https://www.aparat.com/video/video/embed/videohash/'.$this->getId().'/vt/frame';
    }

    public function getEmbeddedHtml($width = 500, $height = 281)
    {
        return '<iframe src="'.$this->getEmbeddedSrcUrl().
        '" width="'.intval($width).'" height="'
        .intval($height).
        '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    public function getUrl()
    {
        return 'https://www.aparat.com/' . $this->type . '/'.$this->getId();
    }

    public function getServiceName()
    {
        return 'Aparat';
    }

    protected function getOEmbedUrl()
    {
        return null;
    }

    public function getInfo($key, $default = null)
    {
        if (empty($this->info)) {
            parent::getInfo($key, $default);

            $metaTags = get_meta_tags($this->getUrl());

            $this->info['thumbnailUrl'] = $metaTags['twitter:image'] ? $metaTags['twitter:image'] : null;
            $this->info['title'] = $metaTags['title'] ? $metaTags['title'] : null;
        }

        return isset($this->info[$key]) ? $this->info[$key] : $default;
    }
}
