<div x-data="theme()">
  <x-ui.settings-card title="Change theme"
  description="Switch between light and dark themes, or have Schedulist follow your system theme.">
    <div class="py-6">
      <img src="{{ asset('images/theme/auto.svg') }}" width="280px" style="margin:auto" class="no-theme auto-opt m-auto" x-bind:class="{'theme-border': theme == 'auto'}"></img>
        <div class="mx-auto mt-3 w-56">
          <div class="mdc-checkbox mdc-checkbox--touch" x-on:click="theme == 'auto' ? setTheme(getSystemTheme()) : setTheme('auto')">
            <input type="checkbox"
                   class="mdc-checkbox__native-control"
                   id="auto-theme" x-bind:checked="theme == 'auto'">
            <div class="mdc-checkbox__background">
              <svg class="mdc-checkbox__checkmark"
                   viewBox="0 0 24 24">
                <path class="mdc-checkbox__checkmark-path"
                      fill="none"
                      d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
              </svg>
              <div class="mdc-checkbox__mixedmark"></div>
            </div>
            <div class="mdc-checkbox__ripple"fi></div>
          </div>
          <label for="checkbox-1" class="agenda-filter-label mx-auto w-full">Follow System Theme</label>
      </div>
      <div class="mt-8 border-t border-gray-200"></div>
      <div class="mt-8">
        <div class="mdc-layout-grid">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-2-phone">
              <img src="{{ asset('images/theme/light.svg') }}" width="280px" class="no-theme light-opt m-auto" x-bind:class="{'theme-border': theme == 'light'}"></img>
              <div class="mx-auto mt-3 w-36">
                <div class="mdc-radio" x-bind:class="{'mdc-radio--disabled': theme == 'auto'}">
                  <input class="mdc-radio__native-control" type="radio" id="light-radio" name="radios" x-bind:checked="theme == 'light' || (theme == 'auto' && getSystemTheme() == 'light')" x-bind:disabled="theme == 'auto'" @click="setTheme('light')">
                  <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                  </div>
                  <div class="mdc-radio__ripple"></div>
                </div>
                <label for="light-radio" class="agenda-filter-label mt-3 w-full" style="vertical-align: 4px">Light Theme</label>
              </div>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-2-phone">
              <img src="{{ asset('images/theme/dark.svg') }}" width="280px" class="no-theme dark-opt m-auto" x-bind:class="{'theme-border': theme == 'dark'}"></img>
              <div class="mx-auto mt-3 w-36">
                <div class="mdc-radio" x-bind:class="{'mdc-radio--disabled': theme == 'auto'}">
                  <input class="mdc-radio__native-control" type="radio" id="dark-radio" name="radios" x-bind:checked="theme == 'dark' || (theme == 'auto' && getSystemTheme() == 'dark')" x-bind:disabled="theme == 'auto'" @click="setTheme('dark')">
                  <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                  </div>
                  <div class="mdc-radio__ripple"></div>
                </div>
                <label for="dark-radio" class="agenda-filter-label mt-3 w-full" style="vertical-align: 4px">Dark Theme</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-ui.settings-card>
</div>
@push('scripts')
  <script>
    function theme(){
      return {
        theme: getCookieValue('theme'),
        getSystemTheme: function () {
          if (window.matchMedia("(prefers-color-scheme: dark)").matches)
            return 'dark';
          return 'light';
        },
        setTheme: function (e) {
          var themer = document.getElementById('themer');
          this.theme = e;
          if (this.theme == 'auto') {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              themer.classList.add('theme-dark');
            } else {
              themer.classList.remove('theme-dark');
            }
            setCookie('theme', 'auto');
            Turbo.clearCache();
          } else if (this.theme == 'dark') {
            themer.classList.add('theme-dark');
            setCookie('theme', 'dark');
            Turbo.clearCache();
          } else {
            themer.classList.remove('theme-dark');
            setCookie('theme', 'light');
            Turbo.clearCache();
          }
        },
      };
    }
  </script>
@endpush
@push('fonts')
<style>
.theme-div, .class-card, .options_card {
  transition: background-color 0.6s ease, color 0.7s ease, border-color 0.6s ease;
}
</style>
@endpush
