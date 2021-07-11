<div class="mdc-dialog confirm-dialog" id="confirm-dialog" wire:ignore>
  <div class="mdc-dialog__container">
    <div class="mdc-dialog__surface"
      role="alertdialog"
      aria-modal="true"
      aria-labelledby="my-dialog-title"
      aria-describedby="my-dialog-content">
      <div class="mdc-dialog__title">Really delete class?</div>
      <div class="mdc-dialog__content" id="my-dialog-content">
        This class and all its assigments will be deleted and won't be recoverable.
      </div>
      <div class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">Cancel</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="delete" wire:click="deleteClass">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">Delete</span>
        </button>
      </div>
    </div>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
