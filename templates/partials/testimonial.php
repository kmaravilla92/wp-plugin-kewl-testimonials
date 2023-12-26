<article class="testimonial">
    <div class="readmore js-readmore">
        <header class="testimonial__header">
            <?php echo kr_view('partials/star-rating', ['rating' => $review->get_rating()]); ?>
            <span class="testimonial__quote">&rdquo;</span>
            <h3 class="testimonial__headline"><?php echo esc_html($review->get_headline()); ?></h3>
        </header>
        <p class="testimonial__testimony">
            <?php echo esc_html($review->get_testimony()); ?>
        </p>
    </div>
    <footer class="testimonial__footer testimonial-attestant">
        <?php
        $attestant_image = $review->get_attestant_image();
        if ( $attestant_image ) { ?>
        <figure class="testimonial-attestant__image">
            <?php echo wp_get_attachment_image($attestant_image, 'kr_image_small'); ?>
        </figure>
        <?php } ?>
        <div class="testimonial-attestant__info">
            <h5 class="testimonial-attestant__name">
                <?php echo $review->get_attestant(); ?>
            </h5>
            <h6 class="testimonial-attestant__role">
                <?php echo $review->get_attestant_role(); ?>
            </h6>
        </div>
    </footer>
</article>