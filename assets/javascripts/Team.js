'use strict';

function Team() {
  this.$closeTeamBioBtn = $('.team-close');
  this.$openTeamBioBtn = $('.team-modal-open');
  this.$nav = $('.navbar');
  this.$body = $('body');
  this.$team = $('.team');
  
  // Team modal gets assigned on open
  this.openModal();
  this.closeModal();
}

Team.prototype.openModal = function() {
  var _this = this;
  this.$openTeamBioBtn.on('click', function(e) {
    e.preventDefault();
    var teamModal = $('#'+e.currentTarget.rel);
    _this.$body.addClass('overflow-hidden');
    _this.$teamModal = teamModal;
    _this.$teamModal.fadeIn(300);
    _this.$nav.addClass('nav-z');
    _this.$team.css('z-index', 5);
  });
};

Team.prototype.closeModal = function() {
  var _this = this;
  this.$closeTeamBioBtn.on('click', function(e) {
    e.preventDefault();
    _this.$body.removeClass('overflow-hidden');
    _this.$teamModal.fadeOut(300);
    _this.$nav.removeClass('nav-z');
    _this.$team.css('z-index', 1);
  });
};