<?php

namespace VideoUrlAnalyzer\Tests\Entities;

use VideoUrlAnalyzer\Tests\Base;
use VideoUrlAnalyzer\Entities\YouTube;

class YouTubeTest extends Base
{

    public function testYouTube()
    {
        $entity = new YouTube('8UVNT4wvIGY');
        $this->assertEquals('YouTube', $entity->getServiceName());
        $this->assertEquals('8UVNT4wvIGY', $entity->getId());
        $this->assertEquals('https://youtu.be/8UVNT4wvIGY', $entity->getUrl());
        $this->assertEquals('https://www.youtube.com/embed/8UVNT4wvIGY', $entity->getEmbeddedSrcUrl());

        $html = $entity->getEmbeddedHtml();
        $this->assertEquals(1, preg_match('/iframe/', $html));
    }

}