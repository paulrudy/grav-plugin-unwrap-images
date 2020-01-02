<?php
namespace Grav\Plugin;

use DOMDocument;
use DOMXpath;
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
        $processcontent = $this->config->get
        ('plugins.unwrap-images.process_content');

        if (isset ($pageobject->header()->unwrap_images['process_content']))  {
            $processcontent = $pageobject->header()->unwrap_images['process_content'];
            if ($processcontent == true) {
                $buffer = $page->content();
                $url = $page->url();
                $doc = new DOMDocument();

                // Hack to force DOMDocument to load the HTML using UTF-8:
                $doc->loadHTML('<?xml encoding="UTF-8">'.$buffer); 

                $xpath = new DOMXpath($doc);
                $elements = $xpath->query("//img");

                foreach  ($elements as $element){
                    $parentnode = $element->parentNode;

                    // if parent is <a>, shift up one DOM level to find <p> wrapper if present:
                    if ($element->parentNode->nodeName == 'a') {
                        $parentnode = $parentnode->parentNode;
                        $element = $element->parentNode;
                    }
                    $parentnodetype = $parentnode->nodeName;
                    if ($parentnodetype == 'p') {
                        $parentnode->parentNode->replaceChild($element,$parentnode);                  
                    }
                }
                $buffer = $doc->saveHTML();
                $page->setRawContent($buffer);
            }
        }
    }
}