'use strict';

function NavAnimate() {
  this.nav = document.getElementById('nav');
  this.slideInNav();
}

NavAnimate.prototype.slideInNav = function() {
  this.nav.classList.add('nav-show');
}