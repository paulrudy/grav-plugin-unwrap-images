<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class UnwrapImagesPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPageContentProcessed' => ['onPageContentProcessed', 0]
        ];
    }

    public function onPageContentProcessed(Event $event)
    {
        $page = $event['page'];
        $config = $this->mergeConfig($page);
        $class = $this->config->get('plugins.unwrap-images.class');
        $processcontent = $this->config->get('plugins.unwrap-images.process-content');
        
        if ($config->get('process-content')) {
            $processcontent = $config->get('process-content');
        }

        if ($processcontent == true) {
            // Search for <p> and <a> (may not exist)
            $pattern = '/<p>(<a[^>]*>\s*)?';
            // Search <img> tag. Only match when value $class exists within 'class=" ... "'. Regex uses positive lookahead
            $pattern .= $class ? '(<img[^>]*(?=class=\"[^\"]*' . $class . '[\",\s])[^>]*>)' : '(<img[^>]*>)';
            // Search for </a> (it may not exist) and closing </p>
            $pattern .= '(\s*<\/a>\s*)?<\/p>/';
            $content = preg_replace($pattern, '$1$2$3', $page->content());

            $page->setRawContent($content);
        }
    }
}
