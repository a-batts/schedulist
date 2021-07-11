<div class="pickers" style="height: 10rem" wire:ignore>
    <v-row class="mt-0 h-20">
      <v-col class="v-first-col pt-1">
        <v-menu
          ref="menu2"
          v-model="menu2"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
          class="float-left"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="startTime2"
              name="starttime"
              label="Start Time"
              class="time-textfield"
              prepend-inner-icon="schedule"
              readonly
              v-bind="attrs"
              v-on="on"
              filled
              required
            ></v-text-field>
          </template>
          <v-time-picker
            v-if="menu2"
            v-on:input="emitStartTime"
            v-model="startTime"
            format="ampm"
            ampm-in-title
            full-width
            v-on:click:minute="$refs.menu2.save(startTime)"
          ></v-time-picker>
        </v-menu>
      </v-col>
      <v-col class="v-second-col pt-1">
        <v-menu
          ref="menu3"
          v-model="menu3"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
          class="float-left"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="endTime2"
              name="endtime"
              label="End Time"
              class="time-textfield"
              prepend-inner-icon="schedule"
              readonly
              v-bind="attrs"
              v-on="on"
              filled
              required
            ></v-text-field>
          </template>
          <v-time-picker
            v-if="menu3"
            v-on:input="emitEndTime"
            v-model="endTime"
            format="ampm"
            v-bind:min="minEndTime"
            ampm-in-title
            full-width
            v-on:click:minute="$refs.menu3.save(endTime)"
          ></v-time-picker>
        </v-menu>
      </v-col>
    </v-row>
    <v-row class="-mt-12">
      <v-col class="pt-1">
        <v-menu
          v-model="menu"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="date2"
              name="duedate"
              label="Date"
              prepend-inner-icon="event"
              readonly
              v-bind="attrs"
              class=""
              v-on="on"
              filled
              required
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="date"
            v-on:input="emitDate"
            v-bind:allowed-dates="disablePastDates"
            @input="menu = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
</div>
