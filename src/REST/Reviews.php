<?php

namespace Kewl\Reviews\REST;

use Kewl\Reviews\Singleton;
use Kewl\Reviews\Widgets\Models\Widget as WidgetModel;

class Reviews extends Singleton
{
    protected $namespace;

    protected $resource_name;

    public function __construct()
    {
        $this->namespace = 'kr-api/v1';
        $this->resource_name = 'reviews';
    }

    public function init()
    {
        add_action( 'rest_api_init', [$this, 'register_routes'] );
    }

    public function register_routes()
    {
        register_rest_route(
            $this->namespace,
            '/' . $this->resource_name,
            [
                'methods' => 'GET',
                'callback' => [$this, 'get_reviews'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function get_reviews($request)
    {
        $widget_id = $request->get_param('widget_id');
        $page = $request->get_param('page') ?: 1;
        $widget = new WidgetModel($widget_id);
        $reviews = $widget->get_reviews($page);
        ob_start();
        foreach ($reviews as $review) {
            echo kr_view('partials/testimonial', compact('review'));
        }

        wp_send_json([
            'data' => [
                'reviews_html' => ob_get_clean(),
                'page' => $page,
            ],
        ]);
    }
}