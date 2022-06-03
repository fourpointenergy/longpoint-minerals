'use strict';

function Menu() {
  this.$window = $(window);
  this.$nav = $('.navbar-fixed-top');
  this.$mobileBar = this.$nav.find('.container-fluid');
  this.$shaded = $('.shaded');
  this.toggleMobileMenu();
}

Menu.prototype.toggleMobileMenu = function() {
  var sideslider = $('[data-toggle=collapse-side]');
  var sel = sideslider.attr('data-target');
  var sel2 = sideslider.attr('data-target-2');
  var _this = this;
  sideslider.click(function(event){
    $(sel).toggleClass('in');
    $(sel2).toggleClass('out');
    $('body').toggleClass('locked');
    _this.$shaded.toggleClass('hidden');
  });
};


Menu.prototype.mobileNavBg = function() {
  if(this.$window.scrollTop() > 50) {
    this.$shaded.css('opacity', 1);
    this.$mobileBar.css('background-color', 'transparent');
  } else {
    this.$shaded.css('opacity', 0);
    this.$mobileBar.css('background-color', 'transparent');
  }
}