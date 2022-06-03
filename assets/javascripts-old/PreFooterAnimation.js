'use strict';

function PreFooterAnimation(preFooter) {
  this.preFooter = $(preFooter);
}

PreFooterAnimation.prototype.slideIntoView = function() {
  if(this.isInViewport(this.preFooter)) {
    this.preFooter.addClass('pf-fadeIn');
  }
}

PreFooterAnimation.prototype.isInViewport = function(el) {
  var elementTop = el.offset().top + 200;
  var elementBottom = elementTop + el.outerHeight();
  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
}