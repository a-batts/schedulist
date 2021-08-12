function sleep(ms) {
  return new Promise(function (resolve) {
    return setTimeout(resolve, ms);
  });
}

Livewire.on('navigate', function (url) {
  Turbo.visit(url);
});

function startLoading(){
  Turbo.controller.adapter.progressBar.setValue(0);
  Turbo.controller.adapter.progressBar.show();
}

Livewire.on('startloading', function (start) {
  startLoading();
});

function stopLoading(){
  Turbo.controller.adapter.progressBar.setValue(100);
  Turbo.controller.adapter.progressBar.hide();
}

Livewire.on('stoploading', function (stop) {
  setTimeout(function () {
    stopLoading();
  }, 150);
});

function fixBody() {
  var element = document.getElementById("makefixed");
  element.classList.add("noscroll");
  document.getElementById("footer").style.display = "none";
}

window.fixBody = fixBody;

function undoFixBody() {
  var element = document.getElementById("makefixed");
  element.classList.remove("noscroll");
  document.getElementById("footer").style.display = "block";
}

window.undoFixBody = undoFixBody;

function showLoginPassword(e) {
  var passwordfield = document.getElementById(e);
  passwordfield.type === "password" ? passwordfield.type = "text" : passwordfield.type = "password";
}

function countdownClock(e) {
  var countdownText = document.getElementById('countdown-time');
  countdownText.innerHTML = ' (' + e + ')';

  if (e > 0) {
    sleep(1000).then(function () {
      countdownClock(e - 1);
    });
  }

  if (e == 0) {
    countdownText.innerHTML = '';
    document.getElementById('countdown-button').disabled = false;
  }
}

Livewire.on('countdownFunction', function (e) {
  var countdownText = document.getElementById('countdown-time');
  countdownText.innerHTML = ' (90)';
  document.getElementById('countdown-button').disabled = true;
  sleep(1000).then(function () {
    countdownClock(90);
  });
});

//Disable scroll

function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
}
var supportsPassive = false;
try {
  window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
    get: function () { supportsPassive = true; }
  }));
} catch(e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false);
  window.addEventListener(wheelEvent, preventDefault, wheelOpt);
  window.addEventListener('touchmove', preventDefault, wheelOpt);
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

function enableScroll() {
  window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
  window.removeEventListener('touchmove', preventDefault, wheelOpt);
  window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}

window.enableScroll = enableScroll;
