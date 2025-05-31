/**
  * isMobile
  * gotop
  * topSearch
  * flatAccordion
  * toggleMenu
  * flatProgressBar
  * no_link
  * flcustominput
  * tabs
  * delete_img
  * Preloader
  * hoverActiveGallery
  * clickSearchForm
  * popUpLightBox
  * footer
  * sidebar_mobie
  * onClickViewListingType
*/

; (function ($) {

    "use strict";

    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var flatAccordion = function () {
        var args = { duration: 600 };
        $('.flat-toggle .toggle-title.active').siblings('.toggle-content').show();
        $('.flat-toggle.enable .toggle-title').on('click', function () {
            $(this).closest('.flat-toggle').find('.toggle-content').slideToggle(args);
            $(this).toggleClass('active');
        });

        $('.flat-accordion .toggle-title').on('click', function () {
            if (!$(this).is('.active')) {
                $(this).closest('.flat-accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(args);
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            }
        });

        $('.flat-accordion .flat-toggle').on('click', function () {
            if (!$(this).is('.activ')) {
                $(this).find('.flat-toggle.activ').toggleClass('activ').next();
                $(this).toggleClass('activ');
            } else {
                $(this).toggleClass('activ');

            }
        });

    };

    var gotop = function () {
        if ($('div').hasClass('progress-wrap')) {
            var progressPath = document.querySelector('.progress-wrap path');
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            var updateprogress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateprogress();
            $(window).scroll(updateprogress);
            var offset = 150;
            var duration = 300;
            jQuery(window).on('scroll', function () {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.progress-wrap').addClass('active-progress');
                } else {
                    jQuery('.progress-wrap').removeClass('active-progress');
                }
            });
            jQuery('.progress-wrap').on('click', function (event) {
                event.preventDefault();
                jQuery('html, body').animate({ scrollTop: 0 }, duration);
                return false;
            })
        }
    }

    new WOW().init();

    var toggleMenu = function () {
        $(".header-menu").on("click", function () {
            $(".side-menu__block").addClass("active");
        });

        $(".side-menu__block-overlay,.side-menu__toggler, .scrollToLink").on(
            "click",
            function (e) {
                $(".side-menu__block").removeClass("active");
                e.preventDefault();
            }
        );
    }

    var topSearch = function () {

        $(document).on('click', function (e) {
            var clickID = e.target.id; if ((clickID !== 's')) {
                $('.top-search').removeClass('show');
            }
        });
        $(document).on('click', function (e) {
            var clickID = e.target.class; if ((clickID !== 'a111')) {
                $('.show-search').removeClass('active');
            }
        });

        $('.show-search').on('click', function (event) {
            event.stopPropagation();
        });
        $('.search-form').on('click', function (event) {
            event.stopPropagation();
        });
        $('.show-search').on('click', function (event) {
            if (!$('.top-search').hasClass("show")) {
                $('.top-search').addClass('show');
                event.preventDefault();
            }
            else
                $('.top-search').removeClass('show');
            event.preventDefault();
            if (!$('.show-search').hasClass("active"))
                $('.show-search').addClass('active');
            else
                $('.show-search').removeClass('active');
        })
            ;
    }

    var flatProgressBar = function () {
        $('.couter').appear(function () {
            $('.chart').easyPieChart({
                easing: 'easeOut',
                lineWidth: 3,
                size: 68,
                scaleColor: false,
                barColor: '#FFF5E0',
                trackColor: '#FFA920',
                animate: 5000,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                },
                rotate: 0,
            });

        }, {
            offset: 400
        });
    };


    var Preloader = function () {
        setTimeout(function () {
            $(".preload").fadeOut("slow", function () {
                $(this).remove();
            });
        }, 100);
    };

    var no_link = function () {
        $('a.nolink').on('click', function (e) {
            e.preventDefault();
        });
        $('.icon_menu .icon a').on('click', function (e) {
            e.preventDefault();
        });
    }

    var flcustominput = function () {
        $("input[type=file]").change(function (e) {
            $(this).parents(".uploadFile").find("#filename,#filename2").text(e.target.files[0].name);
        });
    };


    var tabs = function () {
        $('.flat-tabs').each(function () {
            $(this).find('.content-tab').children().hide();
            $(this).find('.content-tab').children().first().show();
            $(this).find('.menu-tab').children('li').on('click', function () {
                var liActive = $(this).index();
                var contentActive = $(this).siblings().removeClass('active').parents('.flat-tabs').find('.content-tab').children().eq(liActive);
                contentActive.addClass('active').fadeIn("slow");
                contentActive.siblings().removeClass('active');
                $(this).addClass('active').parents('.flat-tabs').find('.content-tab').children().eq(liActive).siblings().hide();
            });
        });
    };

    // img upload style 1
    $("#profileimg").click(function (e) {
        $("#tf-upload-img").click();
    });

    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#profileimg').attr('src',
                window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#tf-upload-img").change(function () {
        fasterPreview(this);
    });

    // delete img
    var delete_img = function (e) {
        $(".remove-file").on("click", function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.closest(".file-delete").remove();
        });
    };
    ;
    var clickSearchForm = function () {
        const widgetSearchForm = $(".wd-search-form");
        if (widgetSearchForm.length) {
            $(".pull-right").on("click", function () {
                widgetSearchForm.toggleClass("show");
                $(".pull-right").toggleClass("active");
            });
            $(document).on(
                "click.pull-right, click.offcanvas-backdrop",
                function (a) {
                    if (
                        $(a.target).closest(".pull-right, .wd-search-form").length === 0
                    ) {
                        widgetSearchForm.removeClass("show");
                        $(".pull-right").removeClass("active")
                    }
                }
            );
        }
    };

    $(".toggle-password").click(function () {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $('.header-search-icon').addClass('closed');

    $('.header-search-icon .search-icon').click(function (e) {
        if ($('.header-search-icon').hasClass('closed')) {
            $('.header-search-icon').removeClass('closed').addClass('opened');
            $('.header-search-icon, .wd-find-select').addClass('opened');
            $('#search-terms').focus();
        } else {
            $('.header-search-icon').removeClass('opened').addClass('closed');
            $('.header-search-icon, .wd-find-select').removeClass('opened');
        }
    });
    var hoverActiveGallery = function () {
        if ($('.container-grid-gallery').length) {
            $(document).ready(function () {
                $('.listing-detail .tfcl-listing-info.style-grid .tfcl-light-gallery').click(
                    function () {
                        $(this).closest('.tfcl-listing-info').find('.tfcl-light-gallery').removeClass('active');
                        $(this).addClass('active');
                    }
                );
            });
        }
    }

    //tab-lisst
    var onClickViewListingType = function () {
        if ($('.category-filter').length > 0) {
            $('.btn-view.grid').click(function (event) {
                event.preventDefault();
                localStorage.setItem('VIEW_LISTING_TYPE', 'grid');
                checkViewListing();
            });
            $('.btn-view.list').click(function (event) {
                event.preventDefault();
                localStorage.setItem('VIEW_LISTING_TYPE', 'list');
                checkViewListing();
            });
        }
    };

    var checkViewListing = function () {
        if ($('.category-filter').length > 0) {
            var type = localStorage.getItem('VIEW_LISTING_TYPE');
            switch (type) {
                case 'grid':
                    $('.listing-list-car-wrap').find('.list-car-list-1').addClass('list-car-grid-1');
                    $('.btn-view.grid').addClass('active');
                    $('.btn-view.list').removeClass('active');
                    break;
                case 'list':
                    $('.listing-list-car-wrap').find('.list-car-list-1').removeClass('list-car-grid-1');
                    $('.btn-view.list').addClass('active');
                    $('.btn-view.grid').removeClass('active');
                    break;
                default:
                    break;
            }
        }
    }

    var popUpLightBox = function () {
        if ($(".lightbox-image").length) {
          $(".lightbox-image").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
            helpers: {
              media: {},
            },
          });
        }
      };

    var footer = function () {
        var args = { duration: 250 };
        $(".footer-heading-mobie").on("click", function () {
          $(this).parent(".footer-col-block").toggleClass("open");
          if (!$(this).parent(".footer-col-block").is(".open")) {
            $(this).next().slideUp(args);
          } else {
            $(this).next().slideDown(args);
          }
        });
    };
    var sidebar_mobie = function () {
        $(".btn-siderbar-mobie-filter").on("click", function () {
          $(".listing-sidebar").toggleClass("open");
          $(".overlay-siderbar-mobie").toggleClass("open");
        });
        $(".overlay-siderbar-mobie").on("click", function () {
            $(".listing-sidebar").toggleClass("open");
            $(".overlay-siderbar-mobie").toggleClass("open");
          });
    };
    
    // Dom Ready
    $(function () {
        gotop();
        topSearch();
        flatAccordion();
        toggleMenu();
        flatProgressBar();
        no_link();
        flcustominput();
        tabs();
        delete_img();
        Preloader();
        hoverActiveGallery();
        clickSearchForm();
        popUpLightBox();
        footer();
        sidebar_mobie();
        onClickViewListingType();
    });

})(jQuery);

