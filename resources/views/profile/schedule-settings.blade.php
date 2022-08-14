<x-app-layout title="Schedule Settings">
  @push('meta')
    <meta name="turbolinks-cache-control" content="no-cache">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  @push('fonts')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
    <div class="mdc-typography mt-10">
      @livewire('profile.schedule.manage-schedule')
      <x-jet-section-border />
      <div class="mt-10 sm:mt-0">
        @livewire('profile.schedule.year-dates')
      </div>
    </div>
  </div>
  @push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
    <script>
    var vueApp = new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data: () => ({
        stdate: new Date(Date.now()).toISOString().substr(0, 10),
        menu: false,
        modal: false,
        enddate: new Date(new Date().getFullYear() + 1, new Date().getMonth(), new Date().getDate()).toISOString().substr(0,10),
        menu2: false,
        modal2: false,
      }),
      methods: {
          disablePastDates(val) {
             return val >= new Date(Date.now()).toISOString().substr(0, 10)
          },
          disableFutureDates(val) {
             return val <= this.enddate
          },
          setStartDate(val) {
            this.stdate = val.toString();
          },
          emitStartDate() {
            Livewire.emit('updateStartDate', this.stdate);
          },
          setEndDate(val) {
            this.enddate = val.toString();
          },
          emitEndDate() {
            Livewire.emit('updateEndDate', this.enddate);
          },
      },
      computed: {
          stdate2: {
            get(){
              return this.stdate.substring(5,7)*1 + "/" + this.stdate.substring(8,10)*1 + "/" + this.stdate.substring(0,4);
            },
            set(newVal){
                this.value = newVal;
            }
          },
          enddate2: {
            get(){
              return this.enddate.substring(5,7)*1 + "/" + this.enddate.substring(8,10)*1 + "/" + this.enddate.substring(0,4);
            },
            set(newVal){
                this.value = newVal;
            }
          }
      }
    });
    Livewire.on('setStartDate', date => {
      vueApp.setStartDate(date);
    });
    Livewire.on('setEndDate', date => {
      vueApp.setEndDate(date);
    });
    </script>
  @endpush
</x-app-layout>
