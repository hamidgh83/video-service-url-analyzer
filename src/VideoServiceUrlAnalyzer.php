<?php
namespace VideoUrlAnalyzer;

class VideoServiceUrlAnalyzer
{
    protected static $analyzers = [
        '\VideoUrlAnalyzer\Analyzers\Vimeo',
        '\VideoUrlAnalyzer\Analyzers\YouTube',
        // '\VideoUrlAnalyzer\Analyzers\Instagram',
        // '\VideoUrlAnalyzer\Analyzers\Aparat',
    ];

    /**
     * @param string                                  $url
     * @param \VideoUrlAnalyzer\Analyzers\Base[]|null $analyzers
     *
     * @return \VideoUrlAnalyzer\Entities\Base|null
     */
    public function analyze($url, $analyzers = null)
    {
        $analyzers = empty($analyzers) ? static::$analyzers : $analyzers;
        foreach ($analyzers as $analyzer) {
            /** @var \VideoUrlAnalyzer\Analyzers\Base $instance */
            $instance = new $analyzer();
            $video    = $instance->analyze($url);
            if (!empty($video)) {
                return $video;
            }
        }

        return;
    }
}
