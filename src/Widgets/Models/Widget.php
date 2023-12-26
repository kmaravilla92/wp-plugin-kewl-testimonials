<?php

namespace Kewl\Reviews\Widgets\Models;

use Kewl\Reviews\Reviews\Models\Review as ReviewModel;

class Widget
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function get_reviews($page = 1)
    {
        $reviews = carbon_get_post_meta($this->id, 'reviews') ?: [];
        $total_reviews = count($reviews);
        [
            'offset' => $offset,
            'per_page' => $per_page,
        ] = $this->get_pager($total_reviews, $page);
        if ($page > -1) {
            $reviews = array_slice($reviews, $offset, $per_page);
        }
        return array_map(
            function ($review) {
                return new ReviewModel($review['id']);
            },
            $reviews
        );
    }

    public function get_widget_style()
    {
        return carbon_get_post_meta($this->id, 'widget_style');
    }

    public function get_enable_readmore()
    {
        return carbon_get_post_meta($this->id, 'enable_readmore');
    }

    public function get_load_more_per_page()
    {
        $field = $this->get_widget_style() . '_load_more_per_page';
        return carbon_get_post_meta($this->id, $field) ?: 1;
    }

    public function get_items_per_row()
    {
        return carbon_get_post_meta($this->id, 'items_per_row') ?: 1;
    }

    public function get_readmore_options()
    {
        $options = [];
        return json_encode($options);
    }

    public function get_load_more_options($json = false)
    {
        $total_reviews = count($this->get_reviews(-1));
        [
            'per_page' => $per_page,
            'total_page' => $total_page,
        ] = $this->get_pager($total_reviews);
        $options = [
            'widget_id' => $this->id,
            'total_reviews' => $total_reviews,
            'per_page' => $per_page,
            'total_page' => $total_page,
        ];
        if ($json) {
            return json_encode($options);
        }
        return $options;
    }

    public function get_slider_options($json = false)
    {
        $fields = [
            'autoplay',
            'autoplay_speed',
            'arrows',
            'slides_to_show',
            'slides_to_scroll',
            'speed',
            'center_mode',
            'center_padding',
            'dots',
            'infinite',
        ];
        $options = [];
        foreach ($fields as $field) {
            $field_key = lcfirst(str_replace('_', '', ucwords($field, '_')));
            $field_value = carbon_get_post_meta($this->id, $field);
            $options[$field_key] = $field_value;
        }
        if ($json) {
            return json_encode($options);
        }
        return $options;
    }

    public function get_pager($total_items = 0, $page = 1)
    {
        $per_page = $this->get_load_more_per_page();
        $pager = [
            'offset' => ($page - 1) * $per_page,
            'per_page' => $per_page,
            'total_page' => ceil($total_items / $per_page),
        ];
        return $pager;
    }
}