<?php
namespace VideoUrlAnalyzer\Analyzers;

abstract class Base
{
    /** @var array */
    protected static $domains = [];

    /**
     * Analyze video url and returns Video entity which includes all analysis result.
     *
     * @param string $url Video Page URL
     *
     * @return \VideoUrlAnalyzer\Entities\Base|null
     */
    abstract public function analyze($url);

    /**
     * Check if the URL is the video page url of target service.
     *
     * @param string $url Video Page URL
     *
     * @return bool
     */
    public function check($url)
    {
        $parsedUrlElements = parse_url($url);

        return array_key_exists('host', $parsedUrlElements) &&
               in_array(strtolower($parsedUrlElements['host']), static::$domains, true);
    }
}
