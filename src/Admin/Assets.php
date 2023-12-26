<?php

namespace Kewl\Reviews\Admin;

use Kewl\Reviews\Assets as FrontendAssets;

class Assets extends FrontendAssets
{
    public function init()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_styles()
    {
        $this->enqueue_style('admin', ['carbon-fields-core']);
    }

    public function enqueue_scripts()
    {
        $this->enqueue_script('admin');
    }
}