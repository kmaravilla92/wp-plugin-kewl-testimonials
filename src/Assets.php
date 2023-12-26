<?php

namespace Kewl\Reviews;

class Assets extends Singleton
{
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_head', [$this, 'add_font_family']);
    }

    public function enqueue_styles()
    {
        $slick_plugin = $this->enqueue_style('plugins/slick');
        $this->enqueue_style('main', [$slick_plugin]);
    }

    public function enqueue_scripts()
    {
        $slick_plugin = $this->enqueue_script('plugins/slick', ['jquery']);
        $readmore_plugin = $this->enqueue_script('plugins/readmore');
        $this->enqueue_script('main', [$slick_plugin, $readmore_plugin]);
        
        wp_localize_script('kr-main-script', 'KRData', [
            'siteUrl' => get_site_url(),
        ]);
    }

    public function enqueue_style($name = '', $deps = [], $media = 'all')
    {
        $handle = "kr-{$name}-style";
        wp_enqueue_style(
            $handle,
            KR_PLUGIN_URL . "assets/css/{$name}.css",
            $deps,
            filemtime(KR_PLUGIN_PATH . "assets/css/{$name}.css"),
            $media
        );
        return $handle;
    }

    public function enqueue_script($name = '', $deps = [], $args = [])
    {
        $handle = "kr-{$name}-script";
        wp_enqueue_script(
            $handle,
            KR_PLUGIN_URL . "assets/js/{$name}.js",
            $deps,
            filemtime(KR_PLUGIN_PATH . "assets/js/{$name}.js"),
            $args
        );
        return $handle;
    }

    public function add_font_family()
    {
    ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <?php 
    }
}