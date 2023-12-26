<?php

namespace Kewl\Reviews\Widgets;

use Kewl\Reviews\Singleton;

class Shortcode extends Singleton
{
    const NAME = 'kewl_reviews';

    public function init()
    {
        add_shortcode(self::NAME, [$this, 'render']);
    }

    public function render($atts, $content = null)
    {
        $atts = shortcode_atts([
            'widget_id' => null,
            'widget_style' => 'list',
        ], $atts, self::NAME);
        ['widget_id' => $widget_id] = $atts;
        return Widget::get_instance()->render($widget_id);
    }

    public function get_shortcode_input()
    {
        $post = $_REQUEST['post'] ?? '';
        if (is_array($post)) {
            return '';
        }
        return sprintf(
            '<label class="cf-field__label kr-cf-field__label" for="kr-shortcode-field">Shortcode</label><input type="text" value="[%s widget_id=%s]" id="kr-shortcode-field" class="large-text" readonly="true">',
            self::NAME,
            $post
        );
    }
}