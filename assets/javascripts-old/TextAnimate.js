// this is the intro text animation

'use strict';

function TextAnimate(NavAnimate) {
  var _this = this;
  this.textToAnimate = document.getElementById('text-intro');
  this.secondary = document.querySelector('.hero-secondary');
  this.splitIntoWords();
  setTimeout(function() {
    _this.fadeIn(_this.secondaryFade);
  }, 500);

  // importing the NavAnimate file.
  this.navAnimate = new NavAnimate();

}

// takes the elements generated below
// loops through, adds the text-show class to each
// text-show fades in the words
TextAnimate.prototype.fadeIn = function(callback) {
  var _this = this;
  var textElems = document.querySelectorAll('.text-elem');
  var counter = textElems.length;

  for(var i = 0; i < textElems.length; i++) {
    (function(i) {
      setTimeout(function() {
        textElems[i].classList.add('text-show');
        counter--;
        if(counter === 0 && _this.secondary) {
          callback(_this.secondary);
        }
      }, i * 120);
    }(i));

  }

};


// gets the hero text, splits it into an array of words
// then wraps each word with a span element
TextAnimate.prototype.splitIntoWords = function() {
  var sentence = this.textToAnimate.innerHTML;
  var words = sentence.split(' ');
  this.textToAnimate.innerHTML = ' ';
  $.each(words, function(i, word) {
    $('#text-intro').append($('<span class="text-elem">').text(word + '\xa0'));
  });
}


// fade in the second section of the nav
TextAnimate.prototype.secondaryFade = function(el) {
  el.classList.add('secondary-show');
};