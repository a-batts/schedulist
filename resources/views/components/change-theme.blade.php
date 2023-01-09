<div x-data="themer()" wire:ignore>
    <button class="mdc-icon-button material-icons float-right ml-4" aria-describedby="change-theme" @click="switchTheme()">
        <div class="mdc-icon-button__ripple"></div>
        <span class="mdc-icon-button__focus-ring"></span>
        <span x-text="themeIcon"></span>
    </button>
    <x-ui.tooltip tooltip-id="change-theme" text="Change theme" />
</div>

@push('scripts')
    <script data-swup-reload-script>
        function themer() {
            return {
                theme: '',

                init: function() {
                    this.theme = getCookieValue('theme') ?? 'auto';
                },

                switchTheme: function() {
                    switch (this.theme) {
                        case 'light':
                            this.setTheme('dark');
                            break;
                        case 'dark':
                            this.setTheme('auto');
                            break;
                        default:
                            this.setTheme('light');
                            break;
                    }
                },

                setTheme: function(theme) {
                    var themer = document.getElementById('theme-container');
                    this.theme = theme;
                    if (this.theme == 'auto') {
                        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            themer.classList.add('theme-dark');
                        } else {
                            themer.classList.remove('theme-dark');
                        }
                        setCookie('theme', 'auto');
                    } else if (this.theme == 'dark') {
                        themer.classList.add('theme-dark');
                        setCookie('theme', 'dark');
                    } else {
                        themer.classList.remove('theme-dark');
                        setCookie('theme', 'light');
                    }
                },

                get themeIcon() {
                    if (this.theme == 'dark')
                        return 'dark_mode'
                    else if (this.theme == 'light')
                        return 'light_mode'
                    return 'brightness_auto'
                }
            }
        }
    </script>
@endpush
