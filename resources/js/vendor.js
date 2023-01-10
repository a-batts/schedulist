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
import { MDCList } from '@material/list';

function initMDC() {
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
    [].map.call(
        document.querySelectorAll('.mdc-select:not(.alpine-select)'),
        function (el) {
            return new MDCSelect(el);
        }
    );
    //Register MDCTextFields
    [].map.call(
        document.querySelectorAll('.mdc-text-field:not(.dummy-field)'),
        function (el) {
            return new MDCTextField(el);
        }
    );

    function initTextField(e) {
        if (document.getElementById(e) !== null)
            return new MDCTextField(document.getElementById(e));
    }
    window.initTextField = initTextField;
    //Register icon buttons and ripples
    [].map.call(document.querySelectorAll('.icontoggle'), function (el) {
        return new MDCIconButtonToggle(el);
    });
    [].map.call(
        document.querySelectorAll('.mdc-ripple-surface'),
        function (el) {
            return new MDCRipple(el);
        }
    );
    [].map.call(document.querySelectorAll('.mdc-radio'), function (el) {
        return new MDCRadio(el);
    });
    //Dialog boxes to add/remove classes
    if (document.getElementById('confirm-dialog') !== null) {
        const confDialog = new MDCDialog(
            document.querySelector('.confirm-dialog')
        );
        function delDialog() {
            confDialog.open();
        }
        window.delDialog = delDialog;
        window.confDialog = confDialog;
    }
    if (document.getElementById('unsub-dialog') !== null) {
        const unsubscribeDialog = new MDCDialog(
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

    [].map.call(
        document.querySelectorAll('.mdc-deprecated-list'),
        function (el) {
            let list = new MDCList(el);
            list.listElements.map((listItemEl) => new MDCRipple(listItemEl));
            return list;
        }
    );

    [].map.call(document.querySelectorAll('.mdc-data-table'), function (el) {
        return new MDCDataTable(el);
    });

    //Snackbar Inits
    if (document.getElementById('snackbar') !== null) {
        const snackbar = new MDCSnackbar(document.querySelector('.snackbar'));
        function snack(msg) {
            snackbar.labelText = msg;
            snackbar.open();
        }
        window.snack = snack;
        window.snackbar = snackbar;
    }

    if (document.getElementById('refreshpwa') !== null) {
        const pwaSnackbar = new MDCSnackbar(
            document.querySelector('.refreshpwa')
        );
        function showRefresh() {
            pwaSnackbar.open();
        }
        window.showRefresh = showRefresh;
        window.pwaSnackbar = pwaSnackbar;
    }

    if (document.querySelector('.edit-more-menu') !== null) {
        const moreMenu = new MDCMenu(document.querySelector('.edit-more-menu'));
        window.moreMenu = moreMenu;
    }

    if (document.querySelector('.delete-item-confirmation') !== null) {
        const deleteAssignmentDialog = new MDCDialog(
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
        const deleteDialog = new MDCDialog(scheduleDeleteConfirmation);

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
        const suggestionsMenu = new MDCMenu(
            document.querySelector('.suggestions-menu')
        );
        window.suggestionsMenu = suggestionsMenu;
    }

    if (document.querySelector('.manage-reminders-dialog') !== null) {
        const reminderDiag = new MDCDialog(
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
}

//Initialize MDC components when the document is loaded
document.addEventListener('DOMContentLoaded', initMDC);
//Reinitialize MDC components when swup replaces content between page loads
document.addEventListener('swup:contentReplaced', () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    //Unfix the body if scrolling has been disabled
    document.documentElement.style.overflow = '';
    document.documentElement.style.paddingRight = '';

    //Initialize MDC components
    initMDC();
});

//Regenerate MDC selects on page - useful if being used inside an Alpine x-if
function regenSelects(elem = undefined) {
    setTimeout(() => {
        if (elem != undefined) {
            document.querySelectorAll(`.mdc-select.${elem}`).forEach((el) => {
                return new MDCSelect(el);
            });
        } else {
            document.querySelectorAll('.mdc-select').forEach((el) => {
                return new MDCSelect(el);
            });
        }
    }, 75);
}
window.regenSelects = regenSelects;

//Generate a tooltip dynamically
function initTooltip(e) {
    if (document.getElementById(e) !== null)
        return new MDCTooltip(document.getElementById(e));
}
window.initTooltip = initTooltip;
