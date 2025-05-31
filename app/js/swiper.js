// ainimate sider
(function ($) {
    var Spanizer = (function () {
        var settings = {
            letters: $('.js-letters'),
        };
        return {
            init: function () {
                this.bind();
            },
            bind: function () {
                Spanizer.doSpanize();
            },
            doSpanize: function () {
                settings.letters.html(function (i, el) {
                    var spanize = $.trim(el).split("");
                    var template = '<span>' + spanize.join('</span><span>') + '</span>'
                    return template;
                });
            },
        };
    })();
    // Let's GO!
    if (matchMedia("only screen and (min-width: 768px)").matches) {
        Spanizer.init();
    }
})(jQuery);

//slider
if ($(".tf-sw-mobile").length > 0) {
    var preview = $(".tf-sw-mobile").data("preview");
    var tablet = $(".tf-sw-mobile").data("tablet");
    var mobile = $(".tf-sw-mobile").data("mobile");
    var mobileSm = $(".tf-sw-mobile").data("mobile-sm");
    var spacingLg = $(".tf-sw-mobile").data("space-lg");
    var spacingMd = $(".tf-sw-mobile").data("space-md");
    var spacing = $(".tf-sw-mobile").data("space");
    var swiper = new Swiper(".tf-sw-mobile", {
        slidesPerView: mobile,
        spaceBetween: spacing,
        pagination: {
            el: ".swiper-pagination3",
            clickable: true,
        },
        navigation: {
            clickable: true,
            nextEl: ".nav-prev-latest",
            prevEl: ".nav-next-latest",
        },
        breakpoints: {
            575: {
                slidesPerView: mobileSm,
                spaceBetween: spacing,
            },
            768: {
                slidesPerView: tablet,
                spaceBetween: spacingMd,
            },
            1150: {
                slidesPerView: preview,
                spaceBetween: spacingLg,
            },
        },
    });
}
if ($(".tf-sw-mobile2").length > 0) {
    let swiperMb;
    let screenWidth = $('.tf-sw-mobile2').data('screen');
    function initSwiperMb() {
        if (matchMedia("only screen and (max-width: 1200px)").matches) {
            if (!swiperMb) {
                let preview = $(".tf-sw-mobile2").data("preview");
                let spacing = $(".tf-sw-mobile2").data("space");

                swiperMb = new Swiper(".tf-sw-mobile2", {
                    slidesPerView: preview,
                    spaceBetween: spacing,
                    speed: 1000,
                    pagination: {
                        el: ".swiper-pagination5",
                        clickable: true,
                    },
                    navigation: {
                        clickable: true,
                        nextEl: ".nav-prev-mb-1",
                        prevEl: ".nav-next-mb-1",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        600: {
                            slidesPerView: 2,
                        },
                        991: {
                            slidesPerView: 3,
                        },
                        1200: {
                            slidesPerView: preview,
                        },
                    },
                });
            }
        } else {
            if (swiperMb) {
                swiperMb.destroy(true, true);
                swiperMb = null;
                $(".tf-sw-mobile2 .swiper-wrapper").removeAttr('style');
                $(".tf-sw-mobile2 .swiper-slide").removeAttr('style');
            }
        }
    }

    initSwiperMb();
    window.addEventListener("resize", function () {
        initSwiperMb();
    });
}
if ($(".tf-sw-mobile4").length > 0) {
    let swiperMb;
    let screenWidth = $('.tf-sw-mobile4').data('screen');
    function initSwiperMb() {
        if (matchMedia("only screen and (max-width: 1200px)").matches) {
            if (!swiperMb) {
                let preview = $(".tf-sw-mobile4").data("preview");
                let spacing = $(".tf-sw-mobile4").data("space");

                swiperMb = new Swiper(".tf-sw-mobile4", {
                    slidesPerView: preview,
                    spaceBetween: spacing,
                    speed: 1000,
                    pagination: {
                        el: ".swiper-pagination5",
                        clickable: true,
                    },
                    navigation: {
                        clickable: true,
                        nextEl: ".nav-prev-mb-1",
                        prevEl: ".nav-next-mb-1",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        600: {
                            slidesPerView: 2,
                        },
                        991: {
                            slidesPerView: 3,
                        },
                        1200: {
                            slidesPerView: preview,
                        },
                    },
                });
            }
        } else {
            if (swiperMb) {
                swiperMb.destroy(true, true);
                swiperMb = null;
                $(".tf-sw-mobile4 .swiper-wrapper").removeAttr('style');
                $(".tf-sw-mobile4 .swiper-slide").removeAttr('style');
            }
        }
    }

    initSwiperMb();
    window.addEventListener("resize", function () {
        initSwiperMb();
    });
}
if ($(".tf-sw-mobile6").length > 0) {
    let swiperMb;
    let screenWidth = $('.tf-sw-mobile6').data('screen');
    function initSwiperMb() {
        if (matchMedia("only screen and (max-width: 1200px)").matches) {
            if (!swiperMb) {
                let preview = $(".tf-sw-mobile6").data("preview");
                let spacing = $(".tf-sw-mobile6").data("space");

                swiperMb = new Swiper(".tf-sw-mobile6", {
                    slidesPerView: preview,
                    spaceBetween: spacing,
                    speed: 1000,
                    pagination: {
                        el: ".swiper-pagination5",
                        clickable: true,
                    },
                    navigation: {
                        clickable: true,
                        nextEl: ".nav-prev-mb-1",
                        prevEl: ".nav-next-mb-1",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        600: {
                            slidesPerView: 2,
                        },
                        991: {
                            slidesPerView: 4,
                        },
                        1200: {
                            slidesPerView: 5,
                        },
                    },
                });
            }
        } else {
            if (swiperMb) {
                swiperMb.destroy(true, true);
                swiperMb = null;
                $(".tf-sw-mobile6 .swiper-wrapper").removeAttr('style');
                $(".tf-sw-mobile6 .swiper-slide").removeAttr('style');
            }
        }
    }

    initSwiperMb();
    window.addEventListener("resize", function () {
        initSwiperMb();
    });
}
if ($(".tf-sw-mobile7").length > 0) {
    let swiperMb;
    let screenWidth = $('.tf-sw-mobile7').data('screen');
    function initSwiperMb() {
        if (matchMedia("only screen and (max-width: 991px)").matches) {
            if (!swiperMb) {
                let preview = $(".tf-sw-mobile7").data("preview");
                let spacing = $(".tf-sw-mobile7").data("space");

                swiperMb = new Swiper(".tf-sw-mobile7", {
                    slidesPerView: preview,
                    spaceBetween: spacing,
                    speed: 1000,
                    pagination: {
                        el: ".swiper-pagination3",
                        clickable: true,
                    },
                    navigation: {
                        clickable: true,
                        nextEl: ".nav-prev-mb-1",
                        prevEl: ".nav-next-mb-1",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        480: {
                            slidesPerView: 2,
                        },
                        991: {
                            slidesPerView: preview,
                        },
                    },
                });
            }
        } else {
            if (swiperMb) {
                swiperMb.destroy(true, true);
                swiperMb = null;
                $(".tf-sw-mobile7 .swiper-wrapper").removeAttr('style');
                $(".tf-sw-mobile7 .swiper-slide").removeAttr('style');
            }
        }
    }

    initSwiperMb();
    window.addEventListener("resize", function () {
        initSwiperMb();
    });
}

var swiper = new Swiper(".tf-sw-mobile3", {
    speed: 1000,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination5",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        600: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        991: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },
});
var swiper = new Swiper(".tf-sw-mobile5", {
    speed: 1000,
    spaceBetween: 30,
    pagination: {
        el: ".sw-pagination-mb",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        600: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        991: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },
});
var swiper = new Swiper(".mainslider", {
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    speed: 500,
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination5",
        clickable: true,

    },
});
var swiper = new Swiper(".partner-slide", {
    slidesPerView: 6,
    spaceBetween: 30,
    // autoplay: {
    //     delay: 0,
    //     disableOnInteraction: false,
    // },
    // speed: 10000,
    observer: true,
    observeParents: true,
    pagination: {
        el: ".swiper-pagination4",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 4,
        },
        1440: {
            slidesPerView: 6,
        },
    },
});
var swiper = new Swiper(".partner-slide2", {
    slidesPerView: 8,
    spaceBetween: 30,
    // autoplay: {
    //     delay: 0,
    //     disableOnInteraction: false,
    // },
    // speed: 10000,
    observer: true,
    observeParents: true,
    loop: true,
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 5,
        },
        1440: {
            slidesPerView: 8,
        },
    },
});
var swiper = new Swiper(".partner-slide3", {
    observeParents: true,
    spaceBetween: 30,
    slidesPerView: 6,
    slidesPerColumn: 2,
    slidesPerColumnFill: 'row',
    // direction: 'horizontal',
    // loop: true,
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        450: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
        },
        1400: {
            slidesPerView: 6,
        },
    },
});
var swiper = new Swiper(".carousel-1", {
    slidesPerView: 8,
    spaceBetween: 30,
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
    },
    speed: 10000,
    loop: true,
    observer: true,
    observeParents: true,
    pagination: {
        el: ".swiper-pagination5",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 2,
            spaceBetween: 20,

        },
        480: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
        },
        992: {
            slidesPerView: 5,
        },
        1440: {
            slidesPerView: 8,
        },
    },
});
var swiper = new Swiper(".carousel-2", {
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    //     },
    loop: false,
    slidesPerView: 1,
    spaceBetween: 0,
    navigation: {
        clickable: true,
        nextEl: ".swiper-button-next2",
        prevEl: ".swiper-button-prev2",
    },
    pagination: {
        el: ".swiper-pagination2",
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        1200: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
    },
});
var swiper = new Swiper(".carousel-3", {
    slidesPerView: 1,
    speed: 500,
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
var swiper = new Swiper(".carousel-5", {
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
    },
    slidesPerView: 2,
    loop: true,
    spaceBetween: 30,
    speed: 10000,
    observer: true,
    observeParents: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        450: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        868: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        992: {
            slidesPerView: 6,
            spaceBetween: 30,
        },
    },
});
var swiper = new Swiper(".carousel-6", {
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    centeredSlides: true,
    navigation: {
        clickable: true,
        nextEl: ".swiper-button-next4",
        prevEl: ".swiper-button-prev4",
    },
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1440: {
            slidesPerView: 4.3,
            spaceBetween: 30,
        },
    },
});
var swiper = new Swiper(".carousel-7", {
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    navigation: {
        clickable: true,
        nextEl: ".swiper-button-next4",
        prevEl: ".swiper-button-prev4",
    },
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 30,
        },

    },
});
var swiper = new Swiper(".carousel-8", {
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    navigation: {
        clickable: true,
        nextEl: ".swiper-button-next4",
        prevEl: ".swiper-button-prev4",
    },
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1440: {
            slidesPerView: 2.8,
            spaceBetween: 30,
        },
    },
});
var swiper = new Swiper(".carousel-9", {
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        clickable: true,
        nextEl: ".swiper-button-next4",
        prevEl: ".swiper-button-prev4",
    },
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 1,
        },
        992: {
            slidesPerView: 2,
        },
        1440: {
            slidesPerView: 3,
        },
    },
});
var swiper = new Swiper(".listing-slide", {
    slidesPerView: 3,
    spaceBetween: 40,
    centeredSlides: true,
    centeredSlidesBounds: true,
    speed: 1000,
    loop: true,
    pagination: {
        el: ".swiper-pagination3",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});