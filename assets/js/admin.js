(($) => {
    $(() => {
        setTimeout(() => {
            $('#kr-shortcode-field').on('focus', e => {
                e.target.setSelectionRange(0, e.target.value.length);
            });
        }, 0);
    });
}) (jQuery);