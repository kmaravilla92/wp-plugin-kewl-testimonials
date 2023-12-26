<div class="testimonial__rating testimonial-rating">
    <?php
    $rating = $rating ?: 1;
    foreach (range(1, 5) as $i) {
        $is_filled = $i <= $rating;
        $class = $is_filled ? ' is-filled' : '';
        $content = $is_filled ? '&starf;' : '';
        printf(
            '<span class="testimonial-rating__item%s">%s</span>',
            $class,
            $content
        );
    }
    ?>
</div>