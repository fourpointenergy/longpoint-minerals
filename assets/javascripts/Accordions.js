'use strict';

function Accordions() {
  this.imgPath = '/wp-content/themes/longpoint/assets/images/';
  this.$accordionTitle = $('.accordion-title');
  this.openFirst();
  this.toggleOpenClose();
}

Accordions.prototype.toggleOpenClose = function() {
  var _this = this;
  this.$accordionTitle.on('click', function(e) {
    var clicked = $(e.target);
    if(!clicked.hasClass('open')) {    
      clicked.addClass('open').siblings().slideDown(200);
      $(this).find('div').toggleClass('minus');
      if($('.accordion-plus-minus')) {
        $(this).find('.accordion-plus-minus').attr('src', _this.imgPath + "icon-minus-lightblue.svg");
      }
    }
    else {
      clicked.removeClass('open').siblings().slideUp(200);
      $(this).find('div').toggleClass('minus');
      if($('.accordion-plus-minus')) {
        $(this).find('.accordion-plus-minus').attr('src', _this.imgPath + 'icon-plus-lightblue.svg');
      }
    }
  });
};

Accordions.prototype.openFirst = function() {
  $('.accordion-container li:first').children().addClass('open').show().prev('a').addClass('open').find('div').addClass('minus');

  if($('.accordion-plus-minus')) {
    $('.accordion-container li:first').find('.accordion-plus-minus').attr('src', this.imgPath + 'icon-minus-lightblue.svg');
  }

  if($('.accordion-item')) {
    $('.accordion-item:first').find('.accordion-content').show().prev().addClass('open');
    $('.accordion-item:first').find('.accordion-plus-minus').attr('src', this.imgPath + 'icon-minus-lightblue.svg');
  }

};