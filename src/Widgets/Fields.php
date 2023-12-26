<?php

namespace Kewl\Reviews\Widgets;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Kewl\Reviews\Singleton;
use Kewl\Reviews\Reviews\PostType as ReviewsPostType;

class Fields extends Singleton
{
    public function init()
    {
        add_action('carbon_fields_register_fields', [$this, 'register_fields']);
    }

    public function register_fields()
    {
        Container::make('post_meta', 'Widget Data')
            ->where('post_type', '=', PostType::POST_TYPE)
            ->add_tab('Reviews', [
                Field::make('html', 'shortcode', 'Shortcode')
                    ->set_html( Shortcode::get_instance()->get_shortcode_input() ),
                Field::make('association', 'reviews', 'Reviews')
                    ->set_types([
                        [
                            'type' => 'post',
                            'post_type' => ReviewsPostType::POST_TYPE,
                        ]
                    ])
            ])
            ->add_tab('Settings', [
                Field::make('radio', 'widget_style', 'Widget Style')
                    ->set_options([
                        'list' => 'List',
                        'slider' => 'Slider',
                        'grid' => 'Grid',
                    ]),
                Field::make('checkbox', 'enable_readmore', 'Enable Readmore')
                    ->set_help_text('Truncates testimony and adds a read more/read less toggle.')
                    ->set_option_value('yes'),
                ...$this->get_list_style_fields(),
                ...$this->get_slider_style_fields(),
                ...$this->get_grid_style_fields(),
            ]);
    }

    protected function get_list_style_fields()
    {
        $fields = [
            Field::make('text', 'list_load_more_per_page', 'Load More Per Page')
                ->set_attribute('type', 'number')
                ->set_help_text('Items per page.')
                ->set_default_value(1),
        ];

        return array_map(
            function ($field) {
                $field->set_conditional_logic([
                    [
                        'field' => 'widget_style',
                        'value' => 'list',
                    ]
                ]);

                return $field;
            },
            $fields
        );
    }

    protected function get_slider_style_fields()
    {
        $fields = [
            Field::make('checkbox', 'autoplay', 'Autoplay')
                ->set_help_text('Enables Autoplay.')
                ->set_option_value('yes'),
            Field::make('text', 'autoplay_speed', 'Autoplay Speed')
                ->set_conditional_logic([
                    [
                        'field' => 'autoplay',
                        'value' => 'yes',
                    ],
                ])
                ->set_attribute('type', 'number')
                ->set_help_text('Autoplay Speed in milliseconds.')
                ->set_default_value(3000),
            Field::make('checkbox', 'arrows', 'Arrows')
                ->set_help_text('Prev/Next Arrows.')
                ->set_option_value('yes'),
            Field::make('text', 'slides_to_show', 'Slides To Show')
                ->set_attribute('type', 'number')
                ->set_help_text('# of slides to show.')
                ->set_default_value(1),
            Field::make('text', 'slides_to_scroll', 'Slides To Scroll')
                ->set_attribute('type', 'number')
                ->set_help_text('# of slides to scroll.')
                ->set_default_value(1),
            Field::make('text', 'speed', 'Speed')
                ->set_attribute('type', 'number')
                ->set_help_text('Slide/fade animation speed in milliseconds.')
                ->set_default_value(300),
            Field::make('checkbox', 'center_mode', 'Center Mode')
                ->set_help_text('Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.')
                ->set_option_value('yes'),
            Field::make('text', 'center_padding', 'Center Padding')
                ->set_help_text('Side padding when in center mode (px or %).')
                ->set_default_value('50px'),
            Field::make('checkbox', 'dots', 'Dots')
                ->set_help_text('Show dot indicators.')
                ->set_option_value('yes'),
            Field::make('checkbox', 'infinite', 'Infinite')
                ->set_help_text('Infinite loop sliding.')
                ->set_option_value('yes'),
        ];

        return array_map(
            function ($field) {
                $field->set_conditional_logic([
                    [
                        'field' => 'widget_style',
                        'value' => 'slider',
                    ]
                ]);

                return $field;
            },
            $fields
        );
    }

    protected function get_grid_style_fields()
    {
        $fields = [
            Field::make('text', 'grid_load_more_per_page', 'Load More Per Page')
                ->set_attribute('type', 'number')
                ->set_help_text('Items per page.')
                ->set_default_value(1),
            Field::make('select', 'items_per_row', 'Items Per Row')
                ->set_help_text('Items per row.')
                ->set_options(array_combine(
                    range(1, 5),
                    range(1, 5)
                ))
        ];

        return array_map(
            function ($field) {
                $field->set_conditional_logic([
                    [
                        'field' => 'widget_style',
                        'value' => 'grid',
                    ]
                ]);

                return $field;
            },
            $fields
        );
    }
}