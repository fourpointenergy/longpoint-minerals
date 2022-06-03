'use strict';

function StatsAnimation(statsContainer, preFooterAnim) {
  var _this = this;
  this.statsContainer = statsContainer;
  this.singleStatItemWrapper = this.statsContainer.find('li');
  this.preFooterAnim = preFooterAnim;
}


StatsAnimation.prototype.slideUp = function() {
  if(this.preFooterAnim.isInViewport(this.statsContainer)) {
    this.singleStatItemWrapper.each(function(index) {
      var $item = $(this);
      setTimeout(function() {
        $item.children('.big-num').addClass('stats-in-up');
        $item.children('p').addClass('stats-in-up2').addClass('stats-in-up');
      }, 500 * index);
    });
  }
};