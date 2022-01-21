<div x-data="theme()">
  <x-ui.settings-card title="Change theme"
  description="Set the website theme to dark, light or to match your device's theme.">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-2-phone">
          <img src="{{ asset('images/theme/light.svg') }}" width="150px" class="m-auto no-theme light-opt" x-bind:class="{'theme-border': theme == 'light'}"></img>
          <div class="mdc-form-field">
            <div class="mdc-radio">
              <input class="mdc-radio__native-control" type="radio" id="radio-1" name="radios" x-bind:checked="theme == 'light'" @click="setTheme('light')">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-1">Light</label>
          </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-2-phone">
          <img src="{{ asset('images/theme/dark.svg') }}" width="150px" class="m-auto no-theme dark-opt" x-bind:class="{'theme-border': theme == 'dark'}"></img>
          <div class="mdc-form-field">
            <div class="mdc-radio">
              <input class="mdc-radio__native-control" type="radio" id="radio-2" name="radios" x-bind:checked="theme == 'dark'" @click="setTheme('dark')">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-2">Dark</label>
          </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-2-phone">
          <img src="{{ asset('images/theme/auto.svg') }}" width="150px" style="margin:auto" class="m-auto no-theme auto-opt" x-bind:class="{'theme-border': theme == 'auto'}"></img>
          <div class="mdc-form-field">
            <div class="mdc-radio">
              <input class="mdc-radio__native-control" type="radio" id="radio-3" name="radios" x-bind:checked="theme == 'auto'" @click="setTheme('auto')">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-3">Use system theme</label>
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
