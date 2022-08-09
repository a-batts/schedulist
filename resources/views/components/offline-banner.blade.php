<div class="mdc-typography" x-data="{
  showingBanner: ! navigator.onLine
}"
@offline.window="showingBanner = true"
@online.window="showingBanner = false"
>
  <div class="mdc-card mdc-card--outlined md:w-96 p-4 py-6 rounded-lg fixed bottom-4 md:right-3 z-50 mdc-elevation--z10" x-transition x-show="showingBanner" x-cloak>
    <div>
      <div class="font-bold text-xl float-left ml-2 mt-0.5"><i class="material-icons align-top mr-4">signal_wifi_connected_no_internet_4</i> You are offline.</div>
      <div class="float-right">
        <button type="button" class="mdc-icon-button material-icons -mt-2.5" @click="showingBanner = false">
          close
        </button>
      </div>
    </div>
    <div class="mt-3 text-gray-700 text-center">Parts of the website will be unavailable until you reconnect.</div>
  </div>
</div>
