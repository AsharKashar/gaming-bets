$(function ($) {
    "use strict";

    jQuery(document).ready(function () {


        //   magnific popup activation
        $('.video-play-btn, .play-video').magnificPopup({
            type: 'video'
        });

        $('.img-popup').magnificPopup({
            type: 'image'
        });

        // Product deal countdown
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<span>%DD : </span> <span>%HH : </span>  <span>%MM : </span> <span>%SS</span>'));
            });
        });


        // Game Slider
        var $game_slider = $('.game-slider');
        $game_slider.owlCarousel({
            loop: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplay: false,
            margin: 0,
            autoplayTimeout: 6000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                },
                1920: {
                    items: 3
                }
            }
        });

        // payment Slider
        var $method_slider = $('.method-slider');
        $method_slider.owlCarousel({
            loop: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: false,
            dots: false,
            autoplay: 100,
            margin: 0,
            autoplayTimeout: 1000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 2
                },
                500: {
                    items: 3
                },
                768: {
                    items: 5
                },
                992: {
                    items: 6
                },
                1200: {
                    items: 7
                },
                1920: {
                    items: 7
                }
            }
        });

        // testimonial-slider
        var $testimonial_slider = $('.testimonial-slider');
        $testimonial_slider.owlCarousel({
            loop: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplay: false,
            margin: 30,
            autoplayTimeout: 6000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });

        $('[data-toggle="tooltip"]').tooltip()
    });


    /*-------------------------------
        back to top
    ------------------------------*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        if ($window.scrollTop() > 0) {
            $(".header").addClass('nav-fixed');
        } else {
            $(".header").removeClass('nav-fixed');
        }

        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {

        /*---------------------
            Preloader
        -----------------------*/
        var preLoder = $("#preloader");
        preLoder.addClass('hide');
        var backtoTop = $('.back-to-top');
        /*-----------------------------
            back to top
        -----------------------------*/
        var backtoTop = $('.bottomtotop');
        backtoTop.fadeOut(50);

    });


    /*-----------------------------
        Cart Page Quantity
    -----------------------------*/
    $(document).on('click', '.qtminus', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.qttotal');
        total = $($tselector).text();
        if (total > 1) {
            total--;
        }
        $($tselector).text(total);
    });

    $(document).on('click', '.qtplus', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.qttotal');
        total = $($tselector).text();
        if (stock != "") {
            var stk = parseInt(stock);
            if (total < stk) {
                total++;
                $($tselector).text(total);
            }
        } else {
            total++;
        }

        $($tselector).text(total);
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }
    });

    $('.scroll-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 100);
        return false;
    });
    setTimeout(hideDiv, 5000);

    function hideDiv() {
        $("#video").fadeOut("slow");
    }

    $("input:checkbox").on('click', function () {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    $("#novice").click(function () {
        $("#novicedetails").toggle();
        $("#elitedetails").hide();
        $("#goddetails").hide();
    });
    $("#elite").click(function () {
        $("#elitedetails").toggle();
        $("#novicedetails").hide();
        $("#goddetails").hide();

    });
    $("#god").click(function () {
        $("#goddetails").toggle();
        $("#elitedetails").hide();
        $("#novicedetails").hide();

    });
    $("#gameslist").hide();
    $("#game").click(function () {

        $("#gameslist").toggle();
    });
    $("#gameslist-1").hide();
    $("#Game-1").click(function () {

        $("#gameslist-1").toggle();
    });

    /** */
    
    
    /***** */
    $("#rule-x-details").hide();
    $("#rules-x").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#rule-x-details").toggle();
        $("#leader-x-info").hide();
        $("#join-fight-list").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bt-role").hide();
        $("#tournamentlist").hide();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
    });
    $("#leader-x-info").hide();
    $("#leader-x").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#leader-x-info").toggle();
        $("#join-fight-list").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bt-role").hide();
        $("#tournamentlist").hide();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#rule-x-details").hide();
    });
    $("#join-fight-list").hide();
    $("#Join-fight").click(function () {
        $("._options_div").hide();
        $("#join-fight-list").toggle();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bt-role").hide();
        $("#tournamentlist").hide();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("._options_div").hide();
        $("._details").hide();
    });
    /**tournament */
    $("#bx-role").hide();
    $("#bx").click(function () {
        $("#tournament-x-details").hide();
        $("#bx-role").toggle();
        $("#bt-role").hide();
        $("#tournamentlist").hide();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("._options_div").hide();
        $("._details").hide();
    });

    $("#bt-role").hide();
    $("#bt").click(function () {
        $("#bt-role").toggle();
        $("._options_div").hide();
        $("._details").hide();
        $("#tournamentlist").hide();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#bx-role").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
    });
    $("#tournamentlist").hide();
    $("#tournament").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#tournament-x-details").hide();
        $("#tournamentlist").toggle();
        $("#leader-info").hide();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
    });

    $("#leader-info").hide();
    $("#leader").click(function () {
        $("._options_div").hide();
        $("#tournament-x-details").hide();
        $("#leader-info").toggle();
        $("#leader-details").hide();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#tournamentlist").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
        $("._options_div").hide();
        $("._details").hide();
    });
    $("#leader-details").hide();
    $("#leader").click(function () {

        $("#leader-details").toggle();
        $("#overview-details").hide();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#tournamentlist").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
        $("._options_div").hide();
        $("._details").hide();
    });
    $("#overview-details").hide();
    $("#overview").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#overview-details").toggle();
        $("#rule-details").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#leader-details").hide();
        $("#leader-info").hide();
        $("#tournamentlist").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
    });
    $("#rule-details").hide();
    $("#rules").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#rule-details").toggle();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#overview-details").hide();
        $("#leader-details").hide();
        $("#leader-info").hide();
        $("#tournamentlist").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
    });
    $("#daily-filter-details").hide();
    $("#daily").click(function () {
        $("._options_div").hide();
        $("._details").hide();
        $("#daily-filter-details").toggle();
        $("#weekly-filter-details").hide();
        $("#monthly-filter-details").hide();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#rule-details").hide();
        $("#overview-details").hide();
        $("#leader-details").hide();
        $("#leader-info").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        
    });
    $("#weekly-filter-details").hide();
    $("#weekly").click(function () {
        $("._options_div").hide();
        $("#weekly-filter-details").toggle();
        $("#monthly-filter-details").hide();
        
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#daily-filter-details").hide();
        $("#rule-details").hide();
        $("#overview-details").hide();
        $("#leader-details").hide();
        $("#leader-info").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
        $("._options_div").hide();
        $("._details").hide();
    });
    $("#monthly-filter-details").hide();
    $("#monthly").click(function () {
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overviewx-details").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#monthly-filter-details").toggle();
        $("#daily-filter-solo").hide();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
        $("#daily-filter-details").hide();
        $("#weekly-filter-details").hide();
        $("#rule-details").hide();
        $("#overview-details").hide();
        $("#leader-details").hide();
        $("#leader-info").hide();
        $("#bx-role").hide();
        $("#join-fight-list").hide();
        $("#leader-x-info").hide();
        $("#rule-x-details").hide();
        $("#tournament-x-details").hide();
        $("._options_div").hide();
        $("._details").hide();
    });
    $("#tournament-overview-details").hide();
    $("#tournament-overview").click(function () {
        $("#tournament-overview-details").toggle();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-x-details").hide();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
    });
    $("#tournament-x-details").hide();
    $("#tournament-type1").click(function () {
        $("#tournament-x-details").toggle();  
    });
    $("#tournament-overviewx-details").hide();
    $("#tournament-overviewx").click(function () {
        $("#tournament-overviewx-details").toggle();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-teams-list").hide();
        $("#tournament-overview-details").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-x-details").hide();
    });
    $("#tournament-overviewx-fight-details").hide();
    $("#tournament-overviewx-fight").click(function () {
        $("#tournament-overviewx-fight-details").toggle();
        $("#tournament-teams-list").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overview-details").hide();
        $("#tournament-x-details").hide();
    });
    $("#tournament-teams-list").hide();
    $("#tournament-teams").click(function () {
        $("#tournament-teams-list").toggle();
        $("#tournament-overviewx-fight-details").hide();
        $("#teams-bracket-details").hide();
        $("#match-details-list").hide();
        $("#tournament-overview-details").hide();
        $("#tournament-x-details").hide();
    });
    $("#teams-bracket-details").hide();
    $("#teams-bracket").click(function () {
        $("#tournament-teams-list").hide();
        $("#teams-bracket-details").toggle();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-x-details").hide();
        $("#tournament-overview-details").hide();
    });
    $("#match-details-list").hide();
    $("#tournament-match").click(function () {
        $("#tournament-teams-list").hide();
        $("#match-details-list").toggle();
        $("#tournament-overviewx-fight-details").hide();
        $("#tournament-x-details").hide();
        $("#tournament-overview-details").hide();
    });
/****filters */
    $("#daily-filter-solo").hide();
    $("#daily-solo").click(function () {    
        $("#daily-filter-solo").toggle();
        $("#daily-filter-duo").hide();
        $("#daily-filter-squads").hide();
    });
    $("#daily-filter-duo").hide();
    $("#daily-duo").click(function () {    
        $("#daily-filter-duo").toggle();
        $("#daily-filter-squads").hide();
        $("#daily-filter-solo").hide();
        
    });
    $("#daily-filter-squads").hide();
    $("#daily-squads").click(function () {    
        $("#daily-filter-squads").toggle();
        $("#daily-filter-duo").hide();
        $("#daily-filter-solo").hide();
    });
/**** */
$("#weekly-filter-solo").hide();
    $("#weekly-solo").click(function () {    
        $("#weekly-filter-solo").toggle();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-squads").hide();
    });
    $("#weekly-filter-duo").hide();
    $("#weekly-duo").click(function () {    
        $("#weekly-filter-duo").toggle();
        $("#weekly-filter-squads").hide();
        $("#weekly-filter-solo").hide();
        
    });
    $("#weekly-filter-squads").hide();
    $("#weekly-squads").click(function () {    
        $("#weekly-filter-squads").toggle();
        $("#weekly-filter-duo").hide();
        $("#weekly-filter-solo").hide();
    });
    /***** */

    $("#monthly-filter-solo").hide();
    $("#monthly-solo").click(function () {    
        $("#monthly-filter-solo").toggle();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-squads").hide();
    });
    $("#monthly-filter-duo").hide();
    $("#monthly-duo").click(function () {    
        $("#monthly-filter-duo").toggle();
        $("#monthly-filter-squads").hide();
        $("#monthly-filter-solo").hide();
        
    });
    $("#monthly-filter-squads").hide();
    $("#monthly-squads").click(function () {    
        $("#monthly-filter-squads").toggle();
        $("#monthly-filter-duo").hide();
        $("#monthly-filter-solo").hide();
    });
    /**** leaderboard*/
    $("#COD-details").hide();
        $("#COD").click(function(){          
            $("#COD-details").toggle();
            $("#top-month-details").hide();
        });

        $("#warefare-leader").hide();
        $("#Modern-Warfare").click(function(){          
            $("#warefare-leader").toggle();
            $("#warzone-leader").hide();
            $("#fortnite-leader").hide();
            $("#csgo-leader").hide();
            $("#top-month-details").hide();
        });
        $("#warzone-leader").hide();
        $("#warzone").click(function(){          
            $("#warzone-leader").toggle();
            $("#fortnite-leader").hide();
            $("#csgo-leader").hide();
            $("#warefare-leader").hide();
            $("#top-month-details").hide();
        });
        $("#fortnite-leader").hide();
        $("#Fortnite").click(function(){          
            $("#fortnite-leader").toggle();
            $("#csgo-leader").hide();
            $("#warzone-leader").hide();
            $("#warefare-leader").hide();
            $("#top-month-details").hide();
        });
        $("#csgo-leader").hide();
        $("#csgo").click(function(){          
            $("#csgo-leader").toggle();
            $("#fortnite-leader").hide();
            $("#warzone-leader").hide();
            $("#warefare-leader").hide();
            $("#top-month-details").hide();
        });
        $("#top-month-details").hide();
        $("#top-month").click(function(){          
            $("#top-month-details").toggle();
            $("#fortnite-leader").hide();
            $("#warzone-leader").hide();
            $("#warefare-leader").hide();
            $("#csgo-leader").hide();
        });
/**** */
/***user dashboard */
$("#dashboard-payments-datails").hide();
        $("#dashboard-payments").click(function(){          
            $("#dashboard-payments-datails").toggle();  
            $("#dashboard-tournaments-details").hide(); 
            $("#dashboard-profile-details").hide();
            $("#dashboard-cashwithdrawal-details").hide(); 
            $("#dashboard-teams-details").hide();
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-tournaments-history-details").hide();
            $("#dashboard-tournaments-active-details").hide();
        });
        $("#dashboard-tournaments-details").hide();
        $("#dashboard-tournaments").click(function(){          
            $("#dashboard-tournaments-details").toggle(); 
            $("#dashboard-payments-datails").hide();  
            $("#dashboard-profile-details").hide(); 
            $("#dashboard-cashwithdrawal-details").hide();
            $("#dashboard-teams-details").hide();
            $("#dashboard-payment-method-details").hide();
            $("#dashboard-payment-history-details").hide();
        });
        $("#dashboard-profile-details").hide();
        $("#dashboard-profile").click(function(){ 
            $("#dashboard-cashwithdrawal-details").hide();
            $("#dashboard-teams-details").hide();
            $("#dashboard-payments-datails").hide();  
            $("#dashboard-tournaments-details").hide(); 
            $("#dashboard-payment-history-details").hide(); 
            $("#dashboard-payment-method-details").hide(); 
            $("#dashboard-tournaments-history-details").hide(); 
            $("#dashboard-tournaments-active-details").hide();   
            $("#dashboard-profile-details").toggle(); 
               
        });
        $("#dashboard-cashwithdrawal-details").hide();
        $("#dashboard-cashwithdrawal").click(function(){ 
            $("#dashboard-payments-datails").hide();  
            $("#dashboard-tournaments-details").hide();  
            $("#dashboard-profile-details").hide(); 
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-payment-method-details").hide();
            $("#dashboard-tournaments-history-details").hide();
            $("#dashboard-tournaments-active-details").hide();
            $("#dashboard-teams-details").hide();    
            $("#dashboard-cashwithdrawal-details").toggle(); 
               
        });
        $("#dashboard-teams-details").hide();
        $("#dashboard-teams").click(function(){ 
            $("#dashboard-payments-datails").hide();  
            $("#dashboard-tournaments-details").hide();  
            $("#dashboard-profile-details").hide(); 
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-payment-method-details").hide();
            $("#dashboard-tournaments-history-details").hide();
            $("#dashboard-tournaments-active-details").hide(); 
            $("#dashboard-cashwithdrawal-details").hide();   
            $("#dashboard-teams-details").toggle(); 
               
        });
        $("#dashboard-payment-history-details").hide();
        $("#dashboard-payment-history").click(function(){ 
            $("#dashboard-payment-method-details").hide();
            $("#dashboard-tournaments-details").hide();  
            $("#dashboard-profile-details").hide();   
            $("#dashboard-tournaments-history-details").hide(); 
            $("#dashboard-tournaments-active-details").hide(); 
            $("#dashboard-payment-history-details").toggle(); 
               
        });
        $("#dashboard-payment-method-details").hide();
        $("#dashboard-payment-method").click(function(){ 
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-tournaments-details").hide();  
            $("#dashboard-profile-details").hide();
            $("#dashboard-cashwithdrawal-details").hide(); 
            $("#dashboard-teams-details").hide();
            $("#dashboard-tournaments-history-details").hide(); 
            $("#dashboard-tournaments-active-details").hide();   
            $("#dashboard-payment-method-details").toggle(); 
               
        });
        $("#dashboard-tournaments-history-details").hide();
        $("#dashboard-tournaments-history").click(function(){ 
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-teams-details").hide();
            $("#dashboard-profile-details").hide();
            $("#dashboard-cashwithdrawal-details").hide(); 
            $("#dashboard-payment-method-details").hide(); 
            $("#dashboard-tournaments-active-details").hide();   
            $("#dashboard-tournaments-history-details").toggle(); 
               
        });
        $("#dashboard-tournaments-active-details").hide();
        $("#dashboard-tournaments-active").click(function(){ 
            $("#dashboard-payment-history-details").hide();
            $("#dashboard-teams-details").hide();
            $("#dashboard-profile-details").hide();
            $("#dashboard-cashwithdrawal-details").hide(); 
            $("#dashboard-payment-method-details").hide();  
            $("#dashboard-tournaments-history-details").hide();  
            $("#dashboard-tournaments-active-details").toggle(); 
               
        });
        
/**** */
$(document).ready(function(){
    var windowSize = $(window).width();
    if (windowSize <= 767) {
        $('.carousel1').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 1.4,
            slidesToScroll: 1,
            });
            $('.carousel2').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 1.5,
                slidesToScroll: 1,
                });
    }
    else if (windowSize <= 991) {
        $('.carousel1').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 2.9,
            slidesToScroll: 1,
            });
            $('.carousel2').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 1.5,
                slidesToScroll: 1,
                });
    }
    else if (windowSize <= 1199) {
        $('.carousel1').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 2.8,
            slidesToScroll: 1,
            });
            $('.carousel2').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 2.5,
                slidesToScroll: 1,
                });
    }
    else if (windowSize <= 1499) {
        $('.carousel1').slick({
    
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3.2,
            slidesToScroll: 1,
            });
            $('.carousel2').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 2.5,
                slidesToScroll: 1,
                });
    }
    else if (windowSize <= 2000) {
        $('.carousel1').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3.9,
            slidesToScroll: 1,
            
            });
            $('.carousel2').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 3.5,
                slidesToScroll: 1,
                });
    }
    
  
});
$("#game-name").hide();
$("#games").click(function(){
    $("#game-name").toggle();
});
$('.mobile-ul').hide();
$('nav a#toggle').click(function() {
    $('ul').slideToggle(200, function() {
      // Animation complete.
    });
  });
/**inital bracket***/


//****** */

    $(document).ready(function(){
      $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 10) { // check if user scrolled more than 50 from top of the browser window
          $(".mainmenu-area").css("background-color", "transparent"); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
        } else {
          $(".mainmenu-area").css("background-color", "transparent"); // if not, change it back to transparent
        }
      });
    });

/**** */
    $("#c1").hover(function () { // Mouse over
        $(this).siblings().stop().fadeTo(300, 0.6);
        $(this).parent().siblings().stop().fadeTo(300, 0.3);
    }, function () { // Mouse out
        $(this).siblings().stop().fadeTo(300, 1);
        $(this).parent().siblings().stop().fadeTo(300, 1);
    })
    $("#c2").hover(function () { // Mouse over
        $(this).siblings().stop().fadeTo(300, 0.6);
        $(this).parent().siblings().stop().fadeTo(300, 0.3);
    }, function () { // Mouse out
        $(this).siblings().stop().fadeTo(300, 1);
        $(this).parent().siblings().stop().fadeTo(300, 1);
    })
    $("#c3").hover(function () { // Mouse over
        $(this).siblings().stop().fadeTo(300, 0.6);
        $(this).parent().siblings().stop().fadeTo(300, 0.3);
    }, function () { // Mouse out
        $(this).siblings().stop().fadeTo(300, 1);
        $(this).parent().siblings().stop().fadeTo(300, 1);
    })

    $('#vid').on('ended', function () {
        this.playedThrough = true;
    });

    // $(window).scroll(function () {
    //     var myVideo = document.getElementById("vid");
    //
    //     if ($(window).scrollTop() > 300 && $(window).scrollTop() < 975) {
    //         // only if we didn't reached the end yet
    //         if (!myVideo.playedThrough)
    //             myVideo.play();
    //     } else {
    //         myVideo.pause();
    //     }
    // })


    if ($(".index-timer").is(":visible")) {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        let countDown = new Date('Aug 30, 2020 00:00:00').getTime(),
            x = setInterval(function () {

                let now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById('days', ':').innerText = Math.floor(distance / (day)),
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute));
                // document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                //if (distance < 0) {
                //  clearInterval(x);
                //  'IT'S MY BIRTHDAY!;
                //}

            }, second)
    }



    $("#myCarousel").on("slide.bs.carousel", function (e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3;
        var totalItems = $(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });
});
