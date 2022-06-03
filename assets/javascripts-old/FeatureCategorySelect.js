'use strict';

function FeatureCategorySelect() {
  this.featureCategorySelectDropdown = document.getElementById('feature-category-select');
  this.onCategoryChange();
  this.setDropdownValue(window.location.href.split('=')[1]);
}

FeatureCategorySelect.prototype.onCategoryChange = function() {
  var _this = this;
  this.featureCategorySelectDropdown.addEventListener('change', function() {

    // if someone selects "select a category" when they are 
    // in a filtered state
    if(this.options[this.selectedIndex].value === 'category') {
      window.location.href = window.location.protocol + "//" + window.location.hostname + window.location.pathname ;
      this.selectedIndex = 0;
    } else {

      // if it's an initial selection, get the value, no redirect necessary right now.
      var selectedCategory = this.options[this.selectedIndex].value;
      _this.buildUrlAndRedirect(selectedCategory);
    }
  });

};

FeatureCategorySelect.prototype.buildUrlAndRedirect = function(selectedCategory) {

  // build the url, append the selected category value
  var url = window.location.protocol + "//" + window.location.hostname + window.location.pathname + "?filter=" + selectedCategory;
  this.redirectOnChange(url);
};

FeatureCategorySelect.prototype.redirectOnChange = function(url) {

  // redirect to the built url
  window.location.href = url;
};

FeatureCategorySelect.prototype.setDropdownValue = function(urlPart) {

  // this sets the dropdown value based on the url.

  // if dropdown value is undefined or "select a category", set the dropdown to the first option
  // which will be "select a category"
  if(urlPart == 'category' || urlPart == undefined) {
    this.featureCategorySelectDropdown.selectedIndex = 0;
  } else {
    // if it's an actual selection, set the dropdown value to that selection based on the url
    this.featureCategorySelectDropdown.value = urlPart;
  }
}