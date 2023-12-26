var KRApp = ((KRApp, $) => {
    KRApp.Slider = {
        init() {
            $('.js-testimonials-slider').each((i, e) => {
                const $slider = $(e);
                const slidesCount = $slider.find('.slick-slide').length;
                const options = $slider.data('slider-options') || {};
                Object.keys(options).forEach(key => {
                    switch(key) {
                        case 'autoplaySpeed':
                        case 'slidesToScroll':
                        case 'slidesToShow':
                        case 'speed':
                            options[key] = parseInt(options[key]);
                            break;
                        default:
                            break;
                    }
                });
                if (1 === slidesCount) {
                    options.dots = false;
                }
                $slider.on('init', (event, slick) => {
                    const { $slider } = slick;
                    if ($slider.find('.slick-arrow').length > 0) {
                        $slider.addClass('slick-arrowed');
                    }
                });
                $slider.slick({
                    ...options,
                    ...{
                        adapativeHeight: true,
                    }
                });
            });
        }
    }

    KRApp.Readmore = {
        readmore: null,

        init() {
            if (this.readmore) {
                this.readmore.destroy();
            }

            this.readmore = new Readmore('.js-testimonials[data-readmore-options] .js-readmore', {
                collapsedHeight: 230,
                moreLink: '<a href="#" class="readmore-toggle readmore-toggle-more">Read More</a>',
                lessLink: '<a href="#" class="readmore-toggle readmore-toggle-less">Read Less</a>',
            });
        },
    }

    class Loadmore {
        constructor($root) {
            this.$root = $root;
            this.$trigger = $root.find('.js-load-more-trigger');
            this.$counterCurrentTotal = $root.find('.kr-load-more-counter-current-total');
            this.$progressValue = $root.find('.js-load-more-progress-value');
            this.$placeholderRoot = $root.find('.js-placeholders-root');
            
            this.options = $root.data('load-more-options');
            this.currentPage = 1;
        }

        init() {
            this.$trigger.on('click', this.handleTriggerClick.bind(this));
            this.updateLoadMore();
        }

        async handleTriggerClick(e) {
            e.preventDefault();
            this.$trigger.prop('disabled', true);

            const { data } = await this.fetchReviews();
            this.$placeholderRoot.append(data.reviews_html);
            KRApp.Readmore.init();
            this.updateLoadMore();
            
            if (!this.hasNextPage()) {
                this.$trigger.addClass('kr-hidden');
                this.$trigger.off('click', this.handleTriggerClick.bind(this));
                return;
            }

            this.$trigger.prop('disabled', false);
        }

        async fetchReviews() {
            const response = await fetch(`${KRData.siteUrl}/wp-json/kr-api/v1/reviews?widget_id=${this.options.widget_id}&page=${++this.currentPage}`);
            return await response.json();
        }

        hasNextPage() {
            return this.currentPage < this.options.total_page;
        }

        getCounterCurrentTotal() {
            let currentTotal = this.currentPage * this.options.per_page;
            if (currentTotal >= this.options.total_reviews) {
                currentTotal = this.options.total_reviews;
            }
            return currentTotal;
        }

        getCounterProgressPercentage() {
            return (this.currentPage / this.options.total_page) * 100;
        }

        updateLoadMore() {
            this.$counterCurrentTotal.text(this.getCounterCurrentTotal());
            this.$progressValue.width(`${this.getCounterProgressPercentage()}%`);
        }
    }

    KRApp.Loadmore = {
        init() {
            $('.js-load-more-root').each((_, e) => {
                const loadmore = new Loadmore($(e));
                loadmore.init();
            });
        }
    }

    $(() => {
        KRApp.Slider.init();
        KRApp.Readmore.init();
        KRApp.Loadmore.init();
    });

    return KRApp
}) (KRApp || {}, jQuery);