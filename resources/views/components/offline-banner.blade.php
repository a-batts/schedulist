<div class="mdc-card mdc-card--outlined mdc-elevation--z10 fixed z-50 p-4 py-6 rounded-lg bottom-4 md:right-3 md:w-96"
    @offline.window="showingPopup = true" @online.window="showingPopup = false" x-transition x-data="{ showingPopup: offline }"
    x-show="showingPopup" x-cloak>
    <div>
        <div class="float-left ml-2 mt-0.5 text-xl font-bold"><i
                class="material-icons mr-4 align-top">signal_wifi_connected_no_internet_4</i> You are offline.</div>
        <div class="float-right">
            <button class="mdc-icon-button material-icons -mt-2.5" type="button" @click="showingPopup = false">
                close
            </button>
        </div>
    </div>
    <div class="mt-3 text-center text-gray-700">Parts of the website will be unavailable until you reconnect.</div>
</div>
