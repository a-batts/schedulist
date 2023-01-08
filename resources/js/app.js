import './bootstrap';

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

import Alpine from 'alpinejs';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import focus from '@alpinejs/focus';
import Parent from '@ryangjchandler/alpine-parent';

import datePicker from './alpine/ui/date-picker';
import timePicker from './alpine/ui/time-picker';
import miniCalendar from './alpine/agenda/mini-calendar';

import autosize from 'autosize';

import { registerSW } from 'virtual:pwa-register';

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

//Automatically autosize all <textarea>s with the autosize class on it
autosize(document.querySelectorAll('textarea.autosize'));

function setCookie(name, value) {
    const d = new Date();
    d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
    let expires = 'expires=' + d.toUTCString();
    document.cookie = name + '=' + value + ';' + expires + ';path=/';
}
window.setCookie = setCookie;

function getCookieValue(cookie_name) {
    return ('; ' + document.cookie)
        .split(`; ${cookie_name}=`)
        .pop()
        .split(';')[0];
}
window.getCookieValue = getCookieValue;

const updateSW = registerSW({
    onNeedRefresh() {
        //Show a prompt to update the service worker when a new one is ready
        showRefresh();
        window.updateSW = updateSW;
    },
    onOfflineReady() {},
});

function showLoginPassword(e) {
    const passwordfield = document.getElementById(e);
    passwordfield.type =
        passwordfield.type === 'password' ? 'text' : 'password';
}
window.showLoginPassword = showLoginPassword;

//Start Alpine after all functions are imported to prevent function issues
Alpine.start();
