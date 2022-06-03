'use strict';

function AngleWidthAnimation(angledSection) {
  this.$angledSection = $(angledSection);
  this.fullWidth();
  this.winMiddle = $(window).height() / 2;
}

AngleWidthAnimation.prototype.fullWidth = function() {
  var _this = this;
  if(this.isInViewport(this.$angledSection)) {
    this.$angledSection.addClass('width1');
    setTimeout(function() {
      _this.$angledSection.addClass('width2');
      $('.blockquote-copy').addClass('showing-bquote');
    }, 700);
  }
};

AngleWidthAnimation.prototype.isInViewport = function(el) {
  var elementTop = el.offset().top + this.winMiddle;
  var elementBottom = elementTop + el.outerHeight();
  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
}