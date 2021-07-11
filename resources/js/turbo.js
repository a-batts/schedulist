var Turbolinks = require("turbolinks")

Turbolinks.start()

window.Turbo = Turbolinks;

Turbo.setProgressBarDelay(700);

document.addEventListener("turbolinks:before-cache", function () {
  var hide = [].map.call(document.querySelectorAll('.mdc-button__ripple'), function(el) {
    el.style.display = 'none';
  });
  var hide = [].map.call(document.querySelectorAll('.modalCreate'), function(el) {
    el.style.display = 'none';
  });
  var hide = [].map.call(document.querySelectorAll('.add_class_div'), function(el) {
    el.style.display = 'none';
  });
  var hide = [].map.call(document.querySelectorAll('.profile_menu'), function(el) {
    el.style.display = 'none';
  });
  enableScroll();
});

document.addEventListener("turbolinks:load", function () {
  document.documentElement.style.overflow = 'initial';
});
