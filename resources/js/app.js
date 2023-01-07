require('./bootstrap');

import Alpine from 'alpinejs';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import focus from '@alpinejs/focus';
import Parent from '@ryangjchandler/alpine-parent';

import datePicker from './alpine/ui/date-picker';
import timePicker from './alpine/ui/time-picker';
import miniCalendar from './alpine/agenda/mini-calendar';

import autosize from 'autosize';

import * as FilePond from 'filepond';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
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
import { MDCLinearProgress } from '@material/linear-progress';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/*
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  forceTLS: true
});

*/

/**
 * Import alpine.js and initalize
 */
window.Alpine = Alpine;

Alpine.plugin(Clipboard);
Alpine.plugin(focus);
Alpine.plugin(Parent);
Alpine.data('miniCalendar', miniCalendar);
Alpine.data('datePicker', datePicker);
Alpine.data('timePicker', timePicker);

Alpine.start();

//Automatically autosize all <textarea>s with the autosize class on it
autosize(document.querySelectorAll('textarea.autosize'));

[].map.call(document.querySelectorAll('.mdc-switch'), function (el) {
    return new MDCSwitch(el);
});

//Register regular button ripples
[].map.call(document.querySelectorAll('.mdc-button'), function (el) {
    return new MDCRipple(el);
});

[].map.call(document.querySelectorAll('.mdc-button-ripple'), function (el) {
    return new MDCRipple(el);
});
//Select menus
[].map.call(document.querySelectorAll('.mdc-select'), function (el) {
    return new MDCSelect(el);
});
//Register MDCTextFields
[].map.call(
    document.querySelectorAll('.mdc-text-field:not(.dummy-field)'),
    function (el) {
        return new MDCTextField(el);
    }
);

var tooltips = [];

function initTextField(e) {
    if (document.getElementById(e) !== null)
        tooltips[e] = new MDCTextField(document.getElementById(e));
}
window.initTextField = initTextField;
//Register icon buttons and ripples
[].map.call(document.querySelectorAll('.icontoggle'), function (el) {
    return new MDCIconButtonToggle(el);
});
[].map.call(document.querySelectorAll('.mdc-ripple-surface'), function (el) {
    return new MDCRipple(el);
});
[].map.call(document.querySelectorAll('.mdc-radio'), function (el) {
    return new MDCRadio(el);
});
//Dialog boxes to add/remove classes
if (document.getElementById('confirm-dialog') !== null) {
    var confDialog = new MDCDialog(document.querySelector('.confirm-dialog'));
    function delDialog() {
        confDialog.open();
    }
    window.delDialog = delDialog;
    window.confDialog = confDialog;
}
if (document.getElementById('unsub-dialog') !== null) {
    var unsubscribeDialog = new MDCDialog(
        document.querySelector('.unsub-dialog')
    );
    function unsubDialog() {
        unsubscribeDialog.open();
    }
    window.unsubDialog = unsubDialog;
}

//Icon Buttons Init
[].map.call(document.querySelectorAll('.mdc-icon-button'), function (el) {
    let btn = new MDCRipple(el);
    btn.unbounded = true;
    return btn;
});
//Checkbox Init
[].map.call(document.querySelectorAll('.mdc-checkbox'), function (el) {
    return new MDCCheckbox(el);
});

[].map.call(document.querySelectorAll('.mdc-deprecated-list'), function (el) {
    var list = new MDCList(el);
    list.listElements.map((listItemEl) => new MDCRipple(listItemEl));
    return list;
});

document.querySelectorAll('.mdc-linear-progress').forEach((el) => {
    return new MDCLinearProgress(el);
});

function initTooltip(e) {
    if (document.getElementById(e) !== null)
        tooltips[e] = new MDCTooltip(document.getElementById(e));
}
window.initTooltip = initTooltip;

//Regenerate MDC selects on page - useful if being used inside an Alpine x-if
function regenSelects() {
    setTimeout(() => {
        document.querySelectorAll('.mdc-select').forEach((el) => {
            return new MDCSelect(el);
        });
    }, 75);
}
window.regenSelects = regenSelects;

if (document.querySelector('.mdc-banner') !== null) {
    var offlineBanner = new MDCBanner(document.querySelector('.mdc-banner'));
    window.offlineBanner = offlineBanner;
}

[].map.call(document.querySelectorAll('.mdc-data-table'), function (el) {
    return new MDCDataTable(el);
});

//Snackbar Inits
if (document.getElementById('snackbar') !== null) {
    var snackbar = new MDCSnackbar(document.querySelector('.snackbar'));
    function snack(msg) {
        snackbar.labelText = msg;
        snackbar.open();
    }
    window.snack = snack;
    window.snackbar = snackbar;
}

if (document.getElementById('refreshpwa') !== null) {
    var pwaSnackbar = new MDCSnackbar(document.querySelector('.refreshpwa'));
    function showRefresh() {
        pwaSnackbar.open();
    }
    window.showRefresh = showRefresh;
    window.pwaSnackbar = pwaSnackbar;
}

if (document.querySelector('.edit-more-menu') !== null) {
    var moreMenu = new MDCMenu(document.querySelector('.edit-more-menu'));
    window.moreMenu = moreMenu;
}

if (document.querySelector('.delete-item-confirmation') !== null) {
    var deleteAssignmentDialog = new MDCDialog(
        document.querySelector('.delete-item-confirmation')
    );
    function openAssignmentDialog() {
        deleteAssignmentDialog.open();
    }
    window.deleteAssignmentDialog = deleteAssignmentDialog;
    window.openAssignmentDialog = openAssignmentDialog;
}

const scheduleDeleteConfirmation = document.querySelector(
    '.delete-schedule-confirmation'
);

if (scheduleDeleteConfirmation !== null) {
    var deleteDialog = new MDCDialog(scheduleDeleteConfirmation);

    window['scheduleDeleteDialog'] = async function () {
        deleteDialog.open();
        const cancelButton =
            scheduleDeleteConfirmation.querySelector('.cancel');
        const confirmButton =
            scheduleDeleteConfirmation.querySelector('.confirm');

        return new Promise((resolve, reject) => {
            cancelButton.onclick = reject;
            confirmButton.onclick = resolve;
        });
    };
}

if (document.querySelector('.suggestions-menu') !== null) {
    var suggestionsMenu = new MDCMenu(
        document.querySelector('.suggestions-menu')
    );
    window.suggestionsMenu = suggestionsMenu;
}

if (document.querySelector('.manage-reminders-dialog') !== null) {
    var reminderDiag = new MDCDialog(
        document.querySelector('.manage-reminders-dialog')
    );
    reminderDiag.scrimClickAction = '';
    let button = document.getElementById('reminder-button');
    button.addEventListener('click', () => {
        reminderDiag.open();
    });
}

//Tooltips Init
[].map.call(document.querySelectorAll('.mdc-tooltip'), function (el) {
    try {
        return new MDCTooltip(el);
    } catch (e) {}
});
