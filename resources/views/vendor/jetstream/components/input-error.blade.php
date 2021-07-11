@props(['for'])

@error($for)
    <div class="livewire-helper mdc-text-field-helper-line">
      <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
    </div>
@enderror
