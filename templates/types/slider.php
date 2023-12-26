<div
    class="testimonials testimonials--<?php echo $widget->get_widget_style(); ?> js-testimonials js-testimonials-slider"
    data-slider-options="<?php echo esc_attr( $widget->get_slider_options(true) ); ?>"
    <?php if ('yes' == $widget->get_enable_readmore()) { ?>
    data-readmore-options="<?php echo esc_attr( $widget->get_readmore_options() ); ?>"
    <?php } ?>
    >
    <?php foreach ($widget->get_reviews(-1) as $review) { ?>
        <div class="slick-slide">
            <?php echo kr_view('partials/testimonial', compact('review')); ?>
        </div>
    <?php } ?>
</div>