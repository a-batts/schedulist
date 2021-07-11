<x-app-layout title="Agenda">
  @push('meta')
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  @push('fonts')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush

  <div class="mx-auto pt-10">
    <div class="mt-10"></div>
    <div>
      @livewire('schedule.agenda-widget', ['initDate' => $initDate])
    </div>
    @livewire('schedule.agenda-color-picker')
    <div id="app">
      <v-app>
        @livewire('schedule.event-create')
        @livewire('schedule.event-edit')
      </v-app>
    </div>
    @livewire('schedule.event-share')
    @livewire('schedule.event-delete')
    @livewire('schedule.event-invite', ['sharedEvent' => $sharedEvent ?? null, 'invalidEvent' => $invalidEvent ?? false])

    <x-offline-banner/>
  </div>
  @push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
    <script>
          var vueApp = new Vue({
            el: '#app',
            vuetify: new Vuetify({
                icons: {
                  iconfont: 'md',
                },
              }),
            data: () => ({
              menu: false,
              menu2: false,
              menu3: false,
              editMenu: false,
              editMenu2: false,
              editMenu3: false,
              startTime: new Date().getHours() + ":" + (new Date().getMinutes() < 10 ? '0' : '') + new Date().getMinutes(),
              endTime: '23:59',
              date: new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10),
            }),
            methods: {
                disablePastDates(val) {
                   return val >= new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10);
                },
                emitStartTime() {
                  Livewire.emit('setStartTime', this.startTime);
                },
                emitEndTime() {
                  Livewire.emit('setEndTime', this.endTime);
                },
                emitDate() {
                  Livewire.emit('setEventDate', this.date);
                },
                resetInputs() {
                  this.startTime = new Date().getHours() + ":" + (new Date().getMinutes() < 10 ? '0' : '') + new Date().getMinutes();
                  this.endTime = '23:59';
                  this.date = new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10);
                }
            },
            watch: {

            },
            computed: {
                startTime2: {
                    get(){
                        var split = this.startTime.split(":");
                        split[0] = split[0] * 1;
                        if (split[0] == 12){
                          split = split.join(":");
                          return split + " PM";
                        }
                        if (split[0] > 12){
                          split[0] -= 12;
                          split = split.join(":");
                          return split + " PM";
                        }
                        if (split[0] == 0)
                          split[0] +=12;
                        split = split.join(":");
                        return split + " AM";
                    },
                    set(newVal){
                        this.value = newVal;
                    }
                },
                minEndTime: {
                    get(){
                      var time = this.startTime;
                      var totalMins = parseInt(time.substr(0,time.indexOf(':')) * 60) + parseInt(time.substr(time.indexOf(':') + 1));
                      totalMins = parseInt(totalMins) + 5;
                      var hrs = Math.floor(totalMins/60);
                      var mins = totalMins%60;
                      return hrs + ':' + mins;
                    },
                    set(newVal){
                      this.value = newVal;
                    }
                },
                endTime2: {
                    get(){
                        var split = this.endTime.split(":");
                        split[0] = split[0] * 1;
                        if (split[0] == 12){
                          split = split.join(":");
                          return split + " PM";
                        }
                        if (split[0] > 12){
                          split[0] -= 12;
                          split = split.join(":");
                          return split + " PM";
                        }
                        if (split[0] == 0)
                          split[0] +=12;
                        split = split.join(":");
                        return split + " AM";
                    },
                    set(newVal){
                        this.value = newVal;
                    }
                },
                date2: {
                  get(){
                    return this.date.substring(5,7)*1 + "/" + this.date.substring(8,10)*1 + "/" + this.date.substring(0,4);
                  },
                  set(newVal){
                      this.value = newVal;
                  }
                },

            }
          })
    </script>
  @endpush

</x-app-layout>
