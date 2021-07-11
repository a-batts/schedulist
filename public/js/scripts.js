function sleep(ms) {
  return new Promise(function (resolve) {
    return setTimeout(resolve, ms);
  });
}

function setCookie(name, value) {
  var d = new Date();
  d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookieValue(name) {
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

var currentTheme = getCookieValue('theme');
var themer = document.getElementById('themer');
if (currentTheme == "dark" && ! themer.classList.contains('theme-dark'))
  themer.classList.add('theme-dark');
else if (currentTheme == "light" && themer.classList.contains('theme-dark'))
  themer.classList.remove('theme-dark');

if (currentTheme == "auto"){
  if (window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches) {
        themer.classList.add('theme-dark');
  }
  else {
    themer.classList.remove('theme-dark');
  }
  window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', event => {
      if (event.matches) {
        themer.classList.add('theme-dark');
      } else {
        themer.classList.remove('theme-dark');
      };
      Turbo.clearCache();
  })
}

Livewire.on('navigate', function (url) {
  Turbo.visit(url);
});

Livewire.on('updateEditRef', function (ref) {
  fixEdit();
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

function fixEdit() {
  efieldTwoAct();
  efieldThreeAct();
}

window.addEventListener('popstate', function () {
  var url = window.location.href;
  if (url.indexOf('assignments/') != -1 && url.indexOf('assignments/assignment') == -1) Turbo.visit('');
});

Livewire.on('updateurl', function (newURL) {
  newURL = newURL.toString();

  if (newURL.indexOf("/") == -1) {
    var url = window.location.href;

    if (newURL == 0) {
      var segments = url.split("/");
      var finalurl = segments[0] + "/assignments";
      window.history.replaceState(0, 'Dashboard', finalurl);
    } else if (url.charAt(url.length - 1) == '/') {
      var segments = url.split("/");
      segments[segments.length - 1] = "" + newURL;
      var finalurl = segments.join("/");
      window.history.replaceState(newURL, 'Dashboard', finalurl);
    } else {
      window.history.replaceState(newURL, 'Dashboard', '/assignments/' + newURL);
    }
  } else {
    var newURLHolder = newURL;
    var splitup = newURL.split("/");
    newURL = splitup[0];
    due = splitup[1];
    var url = window.location.href;

    if (newURLHolder.indexOf("x") > -1) {
      var segments = url.split("/");
      var finalurl = segments[0] + "/assignments/all/" + splitup[1];
      window.history.replaceState(0, 'Dashboard', finalurl);
    } else {
      var segments = url.split("/");
      var finalurl = segments[0] + "/assignments/" + splitup[0] + "/" + splitup[1];
      window.history.replaceState(0, 'Dashboard', finalurl);
    }
  }
});

function efieldTwoAct() {
  if (!document.getElementById('elinkonename').value.length || !document.getElementById('elinkone').value.length) {
    document.getElementById("elinktwo").disabled = true;
    document.getElementById("elinktwoname").disabled = true;
    document.getElementById("elinktwolabel").classList.add("mdc-text-field--disabled");
    document.getElementById("elinktwonlabel").classList.add("mdc-text-field--disabled");
  } else {
    document.getElementById("elinktwoname").disabled = false;
    document.getElementById("elinktwo").disabled = false;
    document.getElementById("elinktwolabel").classList.remove("mdc-text-field--disabled");
    document.getElementById("elinktwonlabel").classList.remove("mdc-text-field--disabled");
  }
}

function efieldThreeAct() {
  if (!document.getElementById('elinktwoname').value.length || !document.getElementById('elinktwo').value.length) {
    document.getElementById("elinkthree").disabled = true;
    document.getElementById("elinkthreename").disabled = true;
    document.getElementById("elinkthreelabel").classList.add("mdc-text-field--disabled");
    document.getElementById("elinkthreenlabel").classList.add("mdc-text-field--disabled");
  } else {
    document.getElementById("elinkthreename").disabled = false;
    document.getElementById("elinkthree").disabled = false;
    document.getElementById("elinkthreelabel").classList.remove("mdc-text-field--disabled");
    document.getElementById("elinkthreenlabel").classList.remove("mdc-text-field--disabled");
  }
}

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
