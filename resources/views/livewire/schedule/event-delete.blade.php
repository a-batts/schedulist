<div class="mdc-dialog confirm-dialog" id="confirm-dialog" x-data="" wire:ignore>
  <div class="mdc-dialog__container">
    <div class="mdc-dialog__surface"
      role="alertdialog"
      aria-modal="true"
      aria-labelledby="my-dialog-title"
      aria-describedby="my-dialog-content">
      <div class="mdc-dialog__title">Really delete event?</div>
      <div class="mdc-dialog__content" id="my-dialog-content">
        It will be permanately deleted and other users who have access to it will no longer have access.
      </div>
      <div class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">Cancel</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel" wire:click="deleteEvent()">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">Delete</span>
        </button>
      </div>
    </div>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
