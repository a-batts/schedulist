<div @close-{{ $bind }}.window="{{ $bind }} = false" x-data="{
    loading: false
}">
    <div class="modal-skim inset-0 bg-gray-500 opacity-75" style="display: none" x-show="{{ $bind }}" x-cloak>
    </div>
    <div class="modal-container fixed top-0 w-screen h-screen overflow-y-auto" style="display: none"
        x-show.important="{{ $bind }}" x-trap.noscroll="{{ $bind }}" x-transition x-cloak>
        <form {{ $attributes->whereStartsWith('wire:submit') }}>
            <div {{ $attributes->class(['mdc-card mdc-card--outlined modal-card']) }}>
                <div>
                    <div class="flex w-full">
                        <div class="flex items-center flex-grow space-x-3">
                            <button class="mdc-icon-button material-icons" type="button" aria-describedby="close-modal"
                                aria-label="close" @click.prevent="{{ $bind }} = false">
                                <div class="mdc-icon-button__ripple"></div>
                                close
                            </button>
                            <h1 class="text-lg font-medium">{{ $title }}</h1>
                        </div>
                        <div class="flex items-center space-x-3">
                            {{ $actions ?? '' }}
                        </div>
                    </div>
                    <div class="mdc-linear-progress mdc-linear-progress--indeterminate mt-4" role="progressbar"
                        aria-label="progress bar" aria-valuemin="0" aria-valuemax="1" aria-valuenow="0"
                        x-show="loading">
                        <div class="mdc-linear-progress__buffer">
                            <div class="mdc-linear-progress__buffer-bar"></div>
                            <div class="mdc-linear-progress__buffer-dots"></div>
                        </div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                        <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                            <span class="mdc-linear-progress__bar-inner"></span>
                        </div>
                    </div>
                </div>
                <div class="pt-7">
                    {{ $slot }}
                </div>
            </div>
        </form>
    </div>
    <x-ui.tooltip tooltip-id="close-modal" text="Close" />
</div>
