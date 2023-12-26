<?php

namespace Kewl\Reviews\Widgets;

use Kewl\Reviews\Singleton;
use Kewl\Reviews\Widgets\Models\Widget as WidgetModel;

class Widget extends Singleton
{
    public function render($widget_id)
    {
        $widget = new WidgetModel($widget_id);
        $template = "types/{$widget->get_widget_style()}";
        $content = kr_view($template, compact('widget'));
        return kr_view('main', compact('content'));
    }
}