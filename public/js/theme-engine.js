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

document.addEventListener('turbolinks:load', function () {
  var currentTheme = getCookieValue('theme');
  var themer = document.getElementById('themer');
  if (currentTheme == 'auto'){
    if (window.matchMedia('(prefers-color-scheme: dark)').matches)
      themer.classList.add('theme-dark');
    else
      themer.classList.remove('theme-dark');

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
      if (event.matches)
        themer.classList.add('theme-dark');
      else
        themer.classList.remove('theme-dark');
    })
  }

})
