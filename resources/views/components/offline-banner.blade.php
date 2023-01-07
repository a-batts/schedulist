<div class="mdc-typography" x-data="{
    showingBanner: !navigator.onLine
}" @offline.window="showingBanner = true"
    @online.window="showingBanner = false">
    <div class="mdc-card mdc-card--outlined mdc-elevation--z10 fixed bottom-4 z-50 rounded-lg p-4 py-6 md:right-3 md:w-96"
        x-transition x-show="showingBanner" x-cloak>
        <div>
            <div class="float-left ml-2 mt-0.5 text-xl font-bold"><i
                    class="material-icons mr-4 align-top">signal_wifi_connected_no_internet_4</i> You are offline.</div>
            <div class="float-right">
                <button class="mdc-icon-button material-icons -mt-2.5" type="button" @click="showingBanner = false">
                    close
                </button>
            </div>
        </div>
        <div class="mt-3 text-center text-gray-700">Parts of the website will be unavailable until you reconnect.</div>
    </div>
</div>
