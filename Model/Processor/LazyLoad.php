<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Model\Processor;

use Goomento\Optimizer\Helper\Config;

/**
 * Class LazyLoad
 * @package Goomento\Optimizer\Model\Processor
 */
class LazyLoad extends AbstractProcessor
{
    protected $ignoredUrl = null;
    /**
     * @param $subject
     * @return string|string[]|null
     */
    public function process($subject)
    {
        return $this->filterLazyLoad((string) $subject);
    }

    /**
     * @param $content
     * @return string|string[]|null
     */
    protected function filterLazyLoad($content)
    {
        $content = preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', [$this, 'pregReplaceCallback'], $content);
        $content = str_ireplace('</body', $this->jqueryLazyScript() . '</body', $content);
        return $content;
    }

    /**
     * @param $matches
     * @return string
     */
    protected function pregReplaceCallback($matches)
    {
        if ($this->isIgnoreUrl($matches[2])) {
            $img_replace = $matches[1] . 'src' . substr($matches[2], 3) . $matches[3];
        } else {
            $img_replace = $matches[1] . 'src="' . $this->imagePlaceHolder() . '" data-lazy_load="0" data-src' . substr($matches[2], 3) . $matches[3];
            $img_replace .= '<noscript>' . $matches[0] . '</noscript>';
        }
        return $img_replace;
    }

    /**
     * @param $url
     * @return bool
     */
    protected function isIgnoreUrl($url)
    {
        if (is_null($this->ignoredUrl)) {
            $this->ignoredUrl = Config::staticGetLazyLoadIgnoredUrls();
        }

        if (empty($this->ignoredUrl)) {
            return false;
        }

        foreach ($this->ignoredUrl as $matchUrl) {
            if (strpos($url, $matchUrl)!==false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    protected function imagePlaceHolder() : string
    {
        return 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
    }

    protected function jqueryLazyScript()
    {
        return <<<LAZY_SCRIPT
<script>
require(['jquery', 'jquery/lazy_load'], function($) {
    $("img[data-lazy_load=\"0\"]").Lazy({
        afterLoad: function(element) {
            $(element).data('lazy_load', 1);
        }
    });
});
</script>
LAZY_SCRIPT;
    }
}
