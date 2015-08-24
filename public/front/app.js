var front = angular.module("front",['ngRoute','angular-loading-bar','ngAnimate','ui.bootstrap','ngMap','countTo']);

front.config(['$routeProvider','$locationProvider','cfpLoadingBarProvider',function($routeProvider,$locationProvider,cfpLoadingBarProvider){
    $routeProvider
        .when("/",{
            templateUrl:"/front/views/index/index.html",
            controller : "IndexController"
        }).when('/contactanos',{
            templateUrl:"/front/views/contact/contact.html",
            controller:"ContactController"
        })
        .otherwise({redirectTo:"/"});
    $locationProvider.html5Mode(true);
    cfpLoadingBarProvider.includeSpinner = true;
}]).directive('carouselS',function($timeout){
    return function($scope,$el,$attrs){
        $timeout((function(){
            $el.owlCarousel({
                loop:true,
                margin:0,
                nav:false,
                items:1
            })
        }),100)
    }
}).directive('carouselC',function($timeout){
    return function($scope,$el,$attrs){
        $timeout((function(){
            $el.owlCarousel({
                loop:true,
                responsiveClass:true,
                dots:false,
                nav:true,
                navText:['<i class="fa fa-angle-right"></i>','<i class="fa fa-angle-left"></i>'],
                responsive:{
                    0:{
                        items:2,
                        nav:true
                    },
                    500:{
                        items:3,
                        nav:true
                    },
                    992:{
                        items:4,
                        nav:false
                    },
                    1200:{
                        items:4,
                        nav:true,
                        loop:false
                    }
                }
            })
        }),100)
    }
}).directive('revolutionS',function($timeout){
    return function($scope,el,attrs){
        $timeout((function(){
            el.revolution({
                delay:5000,
                startwidth:960,
                startheight:660,
                startWithSlide:0,

                fullScreenAlignForce:"off",
                autoHeight:"off",
                minHeight:"off",

                shuffle:"off",

                onHoverStop:"on",
                lazyLoad:"on",

                thumbWidth:100,
                thumbHeight:50,
                thumbAmount:3,

                hideThumbsOnMobile:"off",
                hideNavDelayOnMobile:1500,
                hideBulletsOnMobile:"off",
                hideArrowsOnMobile:"off",
                hideThumbsUnderResoluition:0,

                hideThumbs:0,
                hideTimerBar:"off",

                keyboardNavigation:"on",

                navigationType:"none",
                navigationArrows:"none",
                navigationStyle:"round-old",

                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:30,
                navigationVOffset:30,

                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"bottom",
                soloArrowLeftHOffset:0,
                soloArrowLeftVOffset:0,

                soloArrowRightHalign:"right",
                soloArrowRightValign:"bottom",
                soloArrowRightHOffset:0,
                soloArrowRightVOffset:0,


                touchenabled:"on",
                swipe_velocity:"0.7",
                swipe_max_touches:"1",
                swipe_min_touches:"1",
                drag_block_vertical:"false",

                parallax:"mouse",
                parallaxBgFreeze:"on",
                parallaxLevels:[10,7,4,3,2,5,4,3,2,1],
                parallaxDisableOnMobile:"off",

                stopAtSlide:-1,
                stopAfterLoops:-1,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                hideSliderAtLimit:0,

                dottedOverlay:"none",

                spinned:"spinner4",

                fullWidth:"off",
                forceFullWidth:"off",
                fullScreen:"off",
                fullScreenOffsetContainer:"#topheader-to-offset",
                fullScreenOffset:"0px",
                panZoomDisableOnMobile:"off",

                simplifyAll:"off",

                shadow:0
            },100)
        }));
    }
})