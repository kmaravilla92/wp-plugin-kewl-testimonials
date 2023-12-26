<?php
$load_more_options = $widget->get_load_more_options();
$total_reviews = $load_more_options['total_reviews'];
?>
<div class="kr-load-more">
    <div class="kr-load-more-counter">
        Viewing <span class="kr-load-more-counter-current-total js-kr-load-more-counter-current-total">1</span> of <span class="kr-load-more-counter-total-page js-kr-load-more-counter-total-page"><?php echo $total_reviews; ?></span>
    </div>
    <div class="kr-load-more-progress-bar">
        <div class="kr-load-more-progress-value js-load-more-progress-value"></div>
    </div>
    <button class="kr-btn ks-load-more-trigger js-load-more-trigger">Load More</button>
</div>