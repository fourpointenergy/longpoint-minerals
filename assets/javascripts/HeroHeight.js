'use strict';

function HeroHeight(heroBg) {
  this.heroBg = heroBg;
  this.heroImgHeight = this.heroBg.clientHeight;
  this.setHeroHeight();
}

HeroHeight.prototype.setHeroHeight = function() {
  this.containerHeight = document.getElementById('js-hero-height').clientHeight;
  if($('.less-height').length) {
    this.heroBg.style.height = this.containerHeight + 'px';
  }

  if($(window).width() <= 832) {
    this.heroBg.style.height = this.containerHeight + 120 + 'px';
  } else {
    this.heroBg.style.height = this.containerHeight + 50 + 'px';
  }
  
}