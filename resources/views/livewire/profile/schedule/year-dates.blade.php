<div class="mdc-card mdc-card--outlined options_card"
x-data="{
  setTimes(){
    vueApp.setStartDate(@this.termStartDate);
    vueApp.setEndDate(@this.termEndDate);
  }
}"
x-init="setTimes()">
  <h4 class="mdc-typography mdc-typography--headline5 nunito mt-2">Manage term</h4>
  <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Set the start and end dates for this school year</p>
  <div class="border-t border-gray-200 mt-5"></div>
  <v-app class="pickers menu_date_picker" wire:ignore id="app">
    <v-row class="mt-0" wire:ignore>
      <v-col>
        <v-menu
          v-model="menu"
          :close-on-content-click="false"
          :nudge-right="0"
          :nudge-left="390"
          :top="-500"
          transition="scale-transition"
          origin="bottom right"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="stdate2"
              label="Year Start Date"
              prepend-inner-icon="event"
              readonly
              v-bind="attrs"
              v-on="on"
              class="ml-1"
              filled
              required
              attach
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="stdate"
            v-on:input="emitStartDate()"
            :allowed-dates="disableFutureDates"
            @input="menu = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
      <v-col
      >
        <v-menu
          v-model="menu2"
          v-bind:close-on-content-click="false"
          v-bind:nudge-right="0"
          v-bind:nudge-left="390"
          transition="scale-transition"
          origin="bottom right"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="enddate2"
              label="Year End Date"
              prepend-inner-icon="event"
              readonly
              v-bind="attrs"
              v-on="on"
              class="mr-1"
              filled
              required
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="enddate"
            v-on:input="emitEndDate"
            :allowed-dates="disablePastDates"
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
  </v-app>
  <div class="">
    <button class="float-right mdc-button mdc-button--raised mdc-button-ripple ml-2 mt-4 mb-2 mr-4" type="button" wire:click="saveTermDates()" wire:ignore>
      <span class="mdc-button__ripple"></span>Save dates
    </button>
  </div>
</div>
