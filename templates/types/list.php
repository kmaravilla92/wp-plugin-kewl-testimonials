<div
    class="js-load-more-root"
    data-load-more-options="<?php echo esc_attr( $widget->get_load_more_options(true) ); ?>">
    <div
        class="testimonials testimonials--<?php echo $widget->get_widget_style(); ?> js-placeholders-root js-testimonials"
        <?php if ('yes' == $widget->get_enable_readmore()) { ?>
        data-readmore-options="<?php echo esc_attr( $widget->get_readmore_options() ); ?>"
        <?php } ?>
        >
        <?php foreach ($widget->get_reviews() as $review) { ?>
            <?php echo kr_view('partials/testimonial', compact('review')); ?>
        <?php } ?>
    </div>
    <?php echo kr_view('partials/load-more', compact('widget')); ?>
</div>