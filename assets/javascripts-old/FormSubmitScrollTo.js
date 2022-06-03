'use strict';

function FormSubmitScrollTo(confirmationMsgElem, emptySearchMsg) {
  this.confirmationMsgElem = confirmationMsgElem;
  this.emptySearchMsg = emptySearchMsg;
  var url = window.location.pathname;
  var _this = this;

  if(url === '/contact-us/' && this.confirmationMsgElem) {
    setTimeout(function() {
      _this.scrollToTop();
    }, 200);
  }

  if(url === '/contact-us/' && $('.validation_error')) {
    setTimeout(function() {
      _this.validationErrorScroll();
    }, 200);
  }


  if(this.emptySearchMsg.length > 0) {
    this.emptySearchScroll();
  }
  
}


FormSubmitScrollTo.prototype.scrollToTop = function() {
  if(this.confirmationMsgElem) {
    $('html, body').animate({
      scrollTop: $(this.confirmationMsgElem).offset().top - 200
    });
  }
};

FormSubmitScrollTo.prototype.validationErrorScroll = function() {
  $('html, body').animate({
    scrollTop: $('.validation_error').offset().top - 200
  });
};


FormSubmitScrollTo.prototype.emptySearchScroll = function() {
  $('html, body').animate({
    scrollTop: $(this.emptySearchMsg).offset().top - 300
  });
};