<div x-data="assignmentList()" @update-assignments.window="assignments = @this.assignments" wire:ignore>
  <div class="pt-4 pb-10">
    <h2 class="text-4xl font-bold sm:text-5xl">Assignments</h2>
  </div>
  <div class="flex flex-wrap md:space-x-3 md:flex-nowrap">
    <div class="mb-4 basis-full md:basis-1/2">
      <label class="w-full mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon">
        <span class="mdc-text-field__ripple"></span>
        <span class="mdc-floating-label" id="search-label">Search</span>
        <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button">search</i>
        <input class="mdc-text-field__input" type="text" x-model="query" aria-labelledby="search-label">
        <span class="mdc-line-ripple"></span>
      </label>
    </div>
    <div class="mb-4 sm:pr-3 basis-full sm:basis-1/2 md:basis-1/4 md:pr-0">
      <div class="w-full mdc-select mdc-select--filled">
        <div class="mdc-select__anchor"
             role="button"
             aria-haspopup="listbox"
             aria-expanded="false">
          <span class="mdc-select__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above">Class</span>
          <span class="mdc-select__selected-text-container">
            <span class="mdc-select__selected-text"></span>
          </span>
          <span class="mdc-select__dropdown-icon">
            <svg
                class="mdc-select__dropdown-icon-graphic"
                viewBox="7 10 10 5" focusable="false">
                <polygon
                    class="mdc-select__dropdown-icon-inactive"
                    stroke="none"
                    fill-rule="evenodd"
                    points="7 10 12 15 17 10">
                </polygon>
                <polygon
                    class="mdc-select__dropdown-icon-active"
                    stroke="none"
                    fill-rule="evenodd"
                    points="7 15 12 10 17 15">
                </polygon>
            </svg>
          </span>
          <span class="mdc-line-ripple"></span>
        </div>
        <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
          <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
            <li class="mdc-deprecated-list-item @if($class == -1) mdc-deprecated-list-item--selected @endif" @if($class == -1) aria-selected="true" @else aria-selected="false" @endif @click="setFilterClass(-1, '')" role="option" data-value="-1">
              <span class="mdc-deprecated-list-item__ripple"></span>
              <span class="mdc-deprecated-list-item__text">
                All Classes
              </span>
            </li>
            @foreach($classes as $each)
              <li class="mdc-deprecated-list-item @if($class == $each['id']) mdc-deprecated-list-item--selected @endif" @if($class == $each['id']) aria-selected="true" @else aria-selected="false" @endif @click="setFilterClass( {{$each['id']}}, '{{$each['name']}}')" role="option" data-value="{{$each['id']}}">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <span class="mdc-deprecated-list-item__text">
                  {{$each['name']}}
                </span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="mb-4 sm:pl-3 basis-full sm:basis-1/2 md:basis-1/4 md:pl-0">
      <x-ui.select title="Status" style="filled" :data="json_encode($filters)" bind="due" class="w-full"/>
    </div>
  </div>
  <div class="pt-2 pb-6 border-b border-gray-200">
    <p class="mb-1 font-medium"><span class="capitalize" x-text="due"></span> assignments <span x-text="getClassName()"></span></p>
    <p class="text-sm text-gray-700"><span x-text="filteredAssignments.length"></span> assignment<span x-text="filteredAssignments.length == 1 ? '' : 's'"></span></p>
  </div>
  <div class="">
    <template x-if="due != 'Completed'">
      <div>
        <template x-if="filteredAssignments.length > 0">
          <div>
            <div class="pt-2">
              <template x-for="assignment in filteredAssignments.filter(item => (new Date(item['due']).toDateString() == new Date().toDateString() && new Date(item['due']).getTime() >= new Date().getTime() ))">
                <div>
                  <x-assignments.assignment-card />
                </div>
              </template>
            </div>
            <div class="pt-4">
              <p class="px-4 assignment-filter-hl lg:px-0">Due This Week</p>
              <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']) > new Date(new Date().setHours(23,59,59,999)) && new Date(assignment['due']) <= new Date().setDate(new Date(new Date().setHours(23,59,59,999)).getDate() + 7) ) )">
                <div>
                  <x-assignments.assignment-card />
                </div>
              </template>
              <p class="px-4 assignment-filter-hl lg:px-0">Due Later</p>
              <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']) > new Date().setDate(new Date(new Date().setHours(23,59,59,999)).getDate() + 7) ) )">
                <div>
                  <x-assignments.assignment-card />
                </div>
              </template>
              <p class="px-4 assignment-filter-hl lg:px-0">Overdue</p>
              <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']).getTime() < new Date().getTime() || new Date(assignment['due']) < new Date() ))">
                <div>
                  <x-assignments.assignment-card />
                </div>
              </template>
            </div>
          </div>
        </template>
        <template x-if="filteredAssignments.length == 0">
          <div class="py-24 text-center">
            <h6 class="text-5xl font-bold">You're all caught up!</h6>
            <p class="mt-6 text-lg">No incomplete assignments here</p>
          </div>
        </template>
      </div>
    </template>
    <template x-if="due == 'Completed'">
      <div>
        <template x-for="assignment in filteredAssignments">
          <div>
            <x-assignments.assignment-card />
          </div>
        </template>
      </div>
    </template>
  </div>
</div>
@push('scripts')
  <script>
    function assignmentList(){
      return {
        assignments: @this.assignments,
        
        filterClass: @this.class,

        className: '',
        
        due: @this.due,
        
        query: '',
        
        selectedAssignment: -1,

        init: function() {
          this.$nextTick(() => { this.loadTooltips() }); 

          this.$watch('filteredAssignments', () => this.updateUrl());
          
          this.$watch('query', () => this.loadTooltips());

          this.$wire.getClassName(this.filterClass).then(result => {this.className = result});         
        },
        
        getStatus: function (el){
          let date = new Date();
          if (el['status'] == 1)
            return 'Marked complete';
          else if (new Date(el['due']).toDateString() == date.toDateString())
            return 'Due at ' + el['due_time'];
          else if (new Date(el['due']) < date)
            return 'Late, Due ' + el['due_date'];
          else
            return 'Due ' + el['due_date'] + ', ' + el['due_time'];
        },
        
        //Init the MDC tooltips for assignments
        loadTooltips: function(){
          setTimeout(() => {
            this.assignments.forEach(assignment => {
              initTooltip('assignmentLink' + assignment['id']);
              initTooltip('assignmentToggle' + assignment['id']);
            })
          }, 50);
        },
        
        updateUrl: function (){
          let url = window.location.href;
          url = url.split('/');
          url.splice(4);
          if (this.filterClass != -1)
            url[4] = this.filterClass;
          else if (this.filterClass == -1 && this.due.toLowerCase() == 'completed')
            url[4] = 'all';
          if (this.due != null && this.due.toLowerCase() == 'completed')
            url[5] = 'completed';
          url = url.join('/');
          window.history.pushState({}, 'Dashboard | Assignments' , url);
          this.loadTooltips();
        },

        setFilterClass: function (id, name) {
          this.filterClass = id;
          this.className = name;
        },

        getClassName() {
          if (this.filterClass == -1)
            return ''
          return 'for ' + this.className;
        },

        get filteredAssignments() { 
          const filterStatus = this.due == 'Completed' ? 1 : 0;

          return this.assignments.filter(item => 
              item['status'] == filterStatus &&
              (this.filterClass == item['class_id'] || this.filterClass == -1) &&
              (item['name'].toLowerCase().indexOf(this.query.toLowerCase()) > -1 || item['description'].toLowerCase().indexOf(this.query.toLowerCase()) > -1)
          ).sort((firstEl, secondEl) => new Date(secondEl['due']).getTime() - new Date(firstEl['due']).getTime());
        },
      }
    }
  </script>
@endpush
