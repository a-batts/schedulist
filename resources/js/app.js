//require('./bootstrap');

import * as FilePond from "filepond";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageTransform from "filepond-plugin-image-transform";
import FilePondPluginImageOverlay from 'filepond-plugin-image-overlay';
window.FilePond = FilePond;
window.FilePondPluginImageCrop = FilePondPluginImageCrop;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImageTransform = FilePondPluginImageTransform;
window.FilePondPluginImageOverlay = FilePondPluginImageOverlay;

import { MDCRipple } from '@material/ripple';
import { MDCTextField } from '@material/textfield';
import { MDCIconButtonToggle } from '@material/icon-button';
import { MDCCheckbox } from '@material/checkbox';
import { MDCSnackbar } from '@material/snackbar';
import { MDCMenu } from '@material/menu';
import { MDCSwitch } from '@material/switch';
import { MDCDialog } from '@material/dialog';
import { MDCSelect } from '@material/select';
import { MDCTooltip } from '@material/tooltip';
import { MDCRadio } from '@material/radio';
import { MDCDataTable } from '@material/data-table';
import { MDCBanner } from '@material/banner';
import { MDCList } from '@material/list';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  forceTLS: true
});

const bodyScroll = require('body-scroll-toggle');
window.bodyScroll = bodyScroll;

var tooltips = [];

for (const el of document.querySelectorAll('.mdc-switch')) {
  const switchControl = new MDCSwitch(el);
}

//Register regular button ripples
var buttonRipple = [].map.call(document.querySelectorAll('.mdc-button'), function (el) {
  return new MDCRipple(el);
});
var buttonRippleTwo = [].map.call(document.querySelectorAll('.mdc-button-ripple'), function (el) {
  return new MDCRipple(el);
});
//Register MDCTextFields
var textFields = [].map.call(document.querySelectorAll('.mdc-text-field'), function (el) {
  return new MDCTextField(el);
});

function initTextField(e) {
  if (document.getElementById(e) !== null)
    tooltips[e] = new MDCTextField(document.getElementById(e));
}
window.initTextField = initTextField;
//Select menus
var selectElements = [].map.call(document.querySelectorAll('.mdc-select'), function (el) {
  return new MDCSelect(el);
});
//Register icon buttons and ripples
var buttonToggle = [].map.call(document.querySelectorAll('.icontoggle'), function (el) {
  return new MDCIconButtonToggle(el);
});
var customripples = [].map.call(document.querySelectorAll('.mdc-ripple-surface'), function (el) {
  return new MDCRipple(el);
});
var radioripple = [].map.call(document.querySelectorAll('.mdc-radio'), function (el) {
  return new MDCRadio(el);
});
//Dialog boxes to add/remove classes
if (document.getElementById("confirm-dialog") !== null) {
  var confDialog = new MDCDialog(document.querySelector('.confirm-dialog'));
  function delDialog() {
    confDialog.open();
  }
  window.delDialog = delDialog;
  window.confDialog = confDialog;
};
if (document.getElementById("unsub-dialog") !== null) {
  var unsubscribeDialog = new MDCDialog(document.querySelector('.unsub-dialog'));
  function unsubDialog() {
    unsubscribeDialog.open();
  }
  window.unsubDialog = unsubDialog;
}

//Icon Buttons Init
var iconButtonRipples = [].map.call(document.querySelectorAll('.mdc-icon-button'), function (el) {
  let btn = new MDCRipple(el);
  btn.unbounded = true;
  return btn;
});
//Checkbox Init
var checkbox = [].map.call(document.querySelectorAll('.mdc-checkbox'), function (el) {
  let check = new MDCCheckbox(el);
});
//Tooltips Init
var tooltips = [].map.call(document.querySelectorAll('.mdc-tooltip'), function (el) {
  return new MDCTooltip(el);
});

var lists = [].map.call(document.querySelectorAll('.mdc-deprecated-list'), function (el) {
  var list = new MDCList(el);
  const listItemRipples = list.listElements.map((listItemEl) => new MDCRipple(listItemEl));
  return list;
})


function initTooltip(e) {
  if (document.getElementById(e) !== null)
    tooltips[e] = new MDCTooltip(document.getElementById(e));
}
window.initTooltip = initTooltip;

if (document.querySelector('.mdc-banner') !== null) {
  var offlineBanner = new MDCBanner(document.querySelector('.mdc-banner'));
  window.offlineBanner = offlineBanner;
}

var datatables = [].map.call(document.querySelectorAll('.mdc-data-table'), function (el) {
  return new MDCDataTable(el);
});

//Snackbar Inits
if (document.getElementById("snackbar") !== null) {
  var snackbar = new MDCSnackbar(document.querySelector('.snackbar'));
  function snack(msg) {
    snackbar.labelText = msg;
    snackbar.open();
  }
  window.snack = snack;
  window.snackbar = snackbar;
};

if (document.getElementById("refreshpwa") !== null) {
  var pwaSnackbar = new MDCSnackbar(document.querySelector('.refreshpwa'));
  function showRefresh() {
    pwaSnackbar.open();
  }
  window.showRefresh = showRefresh;
  window.pwaSnackbar = pwaSnackbar;
};

if (document.querySelector(".edit-more-menu") !== null) {
  var moreMenu = new MDCMenu(document.querySelector('.edit-more-menu'));
  window.moreMenu = moreMenu;
};

if (document.querySelector('.delete-assignment-conf') !== null) {
  var deleteAssignmentDialog = new MDCDialog(document.querySelector('.delete-assignment-conf'));
  function openAssignmentDialog() {
    deleteAssignmentDialog.open();
  }
  window.deleteAssignmentDialog = deleteAssignmentDialog;
  window.openAssignmentDialog = openAssignmentDialog;
}

if (document.querySelector('.suggestions-menu') !== null) {
  var suggestionsMenu = new MDCMenu(document.querySelector('.suggestions-menu'));
  window.suggestionsMenu = suggestionsMenu;
}

if (document.querySelector('.manage-reminders-dialog') !== null) {
  var reminderDiag = new MDCDialog(document.querySelector('.manage-reminders-dialog'));
  reminderDiag.scrimClickAction = '';
  let button = document.getElementById('reminder-button');
  button.addEventListener('click', () => {
    reminderDiag.open()
  });
}
