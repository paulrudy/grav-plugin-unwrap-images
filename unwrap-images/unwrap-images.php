<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class UnwrapImagesPlugin extends Plugin
{
    public static function getSubscribedEvents() {
        return [
            'onPageContentProcessed' => ['onPageContentProcessed', 0]
        ];
    }
 
    public function onPageContentProcessed(Event $event)
    {
        $page = $event['page'];
        $pageobject = $this->grav['page'];
        $processcontent = $this->config->get('plugins.unwrap-images.process_content');
        if (isset ($pageobject->header()->unwrap_images['process_content']))  {
            $processcontent = $pageobject->header()->unwrap_images['process_content'];
            if ($processcontent == true) {
                $buffer = $page->content();
                $url = $page->url();
                $buffer = preg_replace("/<p>\s*?(<a .*<img.*<\/a>|<img.*)?\s*<\/p>/",
                    "$1",
                    $buffer);
                $page->setRawContent($buffer);
            }
        }
    }
}