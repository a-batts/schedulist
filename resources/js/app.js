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

import Swup from 'swup';
import SwupLivewirePlugin from '@swup/livewire-plugin';
import SwupProgressPlugin from '@swup/progress-plugin';
import SwupScriptsPlugin from '@swup/scripts-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';

import dayjs from 'dayjs';
import duration from 'dayjs/plugin/duration';
import isSameOrBefore from 'dayjs/plugin/isSameOrBefore';
import advancedFormat from 'dayjs/plugin/advancedFormat';
dayjs.extend(duration);
dayjs.extend(isSameOrBefore);
dayjs.extend(advancedFormat);

window.dayjs = dayjs;

/**
 * Import alpine.js and initialize
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
    const passwordField = document.getElementById(e);
    passwordField.type =
        passwordField.type === 'password' ? 'text' : 'password';
}
window.showLoginPassword = showLoginPassword;

const swup = new Swup({
    animationSelector: '[class*="swup-transition-"]',
    cache: false,
    plugins: [
        new SwupLivewirePlugin(),
        new SwupProgressPlugin({
            delay: 400,
        }),
        new SwupScriptsPlugin({
            optin: true,
        }),
        new SwupBodyClassPlugin(),
    ],
});

//Start Alpine after all functions are imported to prevent function issues
Alpine.start();
