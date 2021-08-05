<x-app-layout :title="$assignmentTitle">
  @push('meta')
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  @push('fonts')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="mt-10 mdc-typography">
      @livewire('assignments.assignment-content', ['assignment_string' => $assignmentString])
    </div>
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
              date: new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10),
              menu: false,
              modal: false,
              time: '23:59',
              menu2: false,
              modal2: false,
            }),
            methods: {
                disablePastDates(val) {
                   return val >= new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10)
                },
                methodThatForcesUpdate: function() {
                  this.$forceUpdate();
                },
                resetFormElements: function(){
                  this.time = '23:59';
                  this.date = new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10);
                },
                setTime(val) {
                  this.time = val;
                },
                setDate(val) {
                  this.date = val;
                },
                emitTime() {
                  Livewire.emit('setTime', this.time);
                },
                emitDate() {
                  Livewire.emit('setDate', this.date);
                }
            },
            watch: {

            },
            computed: {
                time2: {
                    get(){
                        var split = this.time.split(":");
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
                }
            }
          })
          Livewire.on('setTime', time => {
            vueApp.setTime(time);
          });
          Livewire.on('setDate', date => {
            vueApp.setDate(date);
          });
    </script>
  @endpush
</x-app-layout>
