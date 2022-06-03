'use strict';

function LPApp() {
  this.$window = $(window);

  this.menu = new Menu();
  this.handleWindowScroll();
  this.handleWindowResize();

  this.team = new Team();

  this.heroBg= document.getElementById('js-img-height');
  if (this.heroBg) {
    this.heroHeight = new HeroHeight(this.heroBg);
  }

  if (document.getElementById('text-intro')) {
    this.textAnimate = new TextAnimate(NavAnimate);
  }
  this.accordions = new Accordions();
  this.preFooter = document.getElementById('js-pf-fadeUp');

  this.preFooterAnimation = new PreFooterAnimation(this.preFooter);

  this.stats = $('.stats');
  if (this.stats.length > 0) {
    this.statsAnimation = new StatsAnimation(this.stats, this.preFooterAnimation);
  }

  // this.$swiper = $('.swiper');
  // if($('.swiper').length > 0) {
  //   this.angleWidthAnimation = new AngleWidthAnimation(this.$swiper);
  // }

  this.selector = document.getElementById('feature-category-select');
  if(this.selector) {
    this.featureCategorySelect = new FeatureCategorySelect();
  }

  this.anim();

  this.confirmationMsgElem = document.getElementById('gform_confirmation_wrapper_1');
  this.emptySearchMsg = document.getElementsByClassName('search-results-empty-message');

  if(this.confirmationMsgElem || this.emptySearchMsg) {
    this.formSubmitScrollTo = new FormSubmitScrollTo(this.confirmationMsgElem, this.emptySearchMsg);
  }


  // if there is a hash link, scroll to it.
  if(window.location.hash) {
    $('html, body').animate({
       scrollTop: $(window.location.hash).offset().top - 225
     }, 400);
  }

}

LPApp.prototype.handleWindowScroll = function() {
  var _this = this;
  this.$window.on('scroll', function() {
    if(_this.$window.width() >= 832) {
      _this.menu.mobileNavBg();
      if(_this.preFooter) {
        _this.preFooterAnimation.slideIntoView();
      }
    } else {
      _this.menu.mobileNavBg();
    }

    // if(_this.$swiper.length > 0) {
    //   _this.angleWidthAnimation.fullWidth();
    // }

    if(_this.stats.length > 0) {
      _this.statsAnimation.slideUp();
    }

  });
}

LPApp.prototype.handleWindowResize = function() {
  var _this = this;
  this.$window.on('resize', function() {
    if(_this.$window.width() <= 1000) {
      _this.heroHeight.setHeroHeight();
    }
  })
}

// Page transitions: http://git.blivesta.com/animsition/
LPApp.prototype.anim = function() {
  $(".animsition").animsition({
    inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 350,
    outDuration: 350,
    linkElement: '.animsition-link',
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    // overlayClass : 'animsition-overlay-slide',
    // overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
}

$(function(){
  // skip to content button
  var $skipLink = $('.page-skipLink');
  $(window).on('keydown', function(e){
    var keyCode = e.keyCode || e.which;
    if (keyCode === 9) {
      e.preventDefault();
      $skipLink.css({top:0});
      setTimeout(function(){
        $skipLink.css({top: '-2em'});
      }, 3500);
    }
  });
});
