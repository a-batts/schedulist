<div class="h-20" id="app" wire:ignore>
  <v-app class="mt-0">
    <v-row class="-mt-2">
      <v-col>
        <v-menu
          v-model="menu"
          :close-on-content-click="false"
          :nudge-right="40"
          transition="scale-transition"
          offset-y
          min-width="290px"
          class="float-left"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="formattedDate"
              name="duedate"
              label="Due Date"
              prepend-inner-icon="event"
              readonly
              v-bind="attrs"
              class="due-textfield"
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

      <v-col class="v-second-col">
        <v-menu
          ref="menu"
          v-model="menu2"
          :close-on-content-click="false"
          :nudge-right="40"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="290px"
          class="float-right"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="formattedTime"
              name="duetime"
              label="Due Time"
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
            v-on:input="emitTime"
            v-model="time"
            format="ampm"
            ampm-in-title
            full-width
            @click:minute="$refs.menu.save(time)"
          ></v-time-picker>
        </v-menu>
      </v-col>
    </v-row>
  </v-app>
</div>
