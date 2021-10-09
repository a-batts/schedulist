function sleep(ms) {
  return new Promise(function (resolve) {
    return setTimeout(resolve, ms);
  });
}

Livewire.on('navigate', function (url) {
  Turbo.visit(url);
});

function startLoading() {
  Turbo.controller.adapter.progressBar.setValue(0);
  Turbo.controller.adapter.progressBar.show();
}

Livewire.on('startloading', function (start) {
  startLoading();
});

function stopLoading() {
  Turbo.controller.adapter.progressBar.setValue(100);
  Turbo.controller.adapter.progressBar.hide();
}

Livewire.on('stoploading', function (stop) {
  setTimeout(function () {
    stopLoading();
  }, 150);
});

function fixBody() {
  pos = window.scrollY;
  window.pos = pos;
  document.body.style.position = 'fixed';
  document.getElementById('main').style.top = `-${pos}px`;
}

window.fixBody = fixBody;

function undoFixBody() {
  document.body.style.position = '';
  document.getElementById('main').style.top = '';
  window.scrollTo(0, window.pos);
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
} catch (e) { }

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
