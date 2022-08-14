<div class="mdc-typograpy pt-8" x-data="assignmentList()" x-init="$nextTick(() => { loadTooltips() }); $watch('due', value => updateUrl()); $watch('query', value => loadTooltips());"
  @update-assignments.window="assignments = @this.assignments" wire:ignore>
  <div class="mb-5 w-full px-3 lg:float-left lg:mr-5 lg:w-2/5 lg:px-0">
    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon w-full">
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="search-label">Search Assignments</span>
      <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button">search</i>
      <input class="mdc-text-field__input" type="text" x-model="query" aria-labelledby="search-label">
      <span class="mdc-line-ripple"></span>
    </label>
  </div>
  <div class="mb-5 w-full px-3 lg:px-0">
    <div class="float-left w-1/2 pr-2 lg:mr-5 lg:w-1/4 lg:pr-0">
      <div class="mdc-select mdc-select--filled mr-5 w-full">
        <div class="mdc-select__anchor"
             role="button"
             aria-haspopup="listbox"
             aria-expanded="false">
          <span class="mdc-select__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" style="transform: translateY(-106%) scale(0.75)">Class</span>
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
            <li class="mdc-deprecated-list-item @if($class == -1) mdc-deprecated-list-item--selected @endif" @if($class == -1) aria-selected="true" @else aria-selected="false" @endif @click="filterClass = -1; updateUrl()" role="option" data-value="-1">
              <span class="mdc-deprecated-list-item__ripple"></span>
              <span class="mdc-deprecated-list-item__text">
                All Classes
              </span>
            </li>
            @foreach($classes as $x)
              <li class="mdc-deprecated-list-item @if($class == $x['id']) mdc-deprecated-list-item--selected @endif" @if($class == $x['id']) aria-selected="true" @else aria-selected="false" @endif @click="filterClass = {{$x['id']}}; updateUrl()" role="option" data-value="{{$x['id']}}">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <span class="mdc-deprecated-list-item__text">
                  {{$x['name']}}
                </span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="float-left w-1/2 pl-2 lg:w-1/5 lg:pl-0">
      <x-ui.select text="Status" alpine="due" type="filled" :data="$filters" default="{{$due}}" class="w-full"/>
    </div>
  </div>
  <div class="pt-16 lg:pt-12">
    <template x-if="due != 'Completed'">
      <div>
        <p class="assignment-filter-hl px-4 lg:px-0">Overdue</p>
        <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']).getTime() < new Date().getTime() || new Date(assignment['due']) < new Date() ))">
          <div>
            <template x-if="assignment['status'] == 'inc' && (filterClass == assignment['classid'] || filterClass == -1)">
              <div>
                <x-assignments.assignment-card />
              </div>
            </template>
          </div>
        </template>
        <p class="assignment-filter-hl px-4 lg:px-0">Due Today</p>
        <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']).toDateString() == new Date().toDateString() && new Date(assignment['due']).getTime() >= new Date().getTime() ))">
          <div>
            <template x-if="assignment['status'] == 'inc' && (filterClass == assignment['classid'] || filterClass == -1)">
              <div>
                <x-assignments.assignment-card />
              </div>
            </template>
          </div>
        </template>
        <p class="assignment-filter-hl px-4 lg:px-0">Due This Week</p>
        <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']) > new Date(new Date().setUTCHours(23,59,59,999)) && new Date(assignment['due']) <= new Date().setDate(new Date(new Date().setUTCHours(23,59,59,999)).getDate() + 7) ) )">
          <div>
            <template x-if="assignment['status'] == 'inc' && (filterClass == assignment['classid'] || filterClass == -1)">
              <div>
                <x-assignments.assignment-card />
              </div>
            </template>
          </div>
        </template>
        <p class="assignment-filter-hl px-4 lg:px-0">Due Later</p>
        <template x-for="assignment in filteredAssignments.filter(assignment => (new Date(assignment['due']) > new Date().setDate(new Date(new Date().setUTCHours(23,59,59,999)).getDate() + 7) ) )">
          <div>
            <template x-if="assignment['status'] == 'inc' && (filterClass == assignment['classid'] || filterClass == -1)">
              <div>
                <x-assignments.assignment-card />
              </div>
            </template>
          </div>
        </template>
      </div>
    </template>
    <template x-if="due == 'Completed'">
      <div>
        <p class="assignment-filter-hl lg:px- px-4">All completed assignments</p>
        <template x-for="assignment in filteredAssignments.sort((firstEl, secondEl) => new Date(secondEl['due']).getTime() - new Date(firstEl['due']).getTime())">
          <div>
            <template x-if="assignment['status'] == 'done' && (filterClass == assignment['classid'] || filterClass == '-1')">
              <div>
                <x-assignments.assignment-card />
              </div>
            </template>
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
        due: @this.due,
        query: '',
        selectedAssignment: -1,
        get filteredAssignments() { return this.assignments.filter(assignment => assignment['assignment_name'].toLowerCase().indexOf(this.query.toLowerCase()) > -1 || assignment['description'].toLowerCase().indexOf(this.query.toLowerCase()) > -1) },
        getStatus: function (e){
          let date = new Date();
          if (e['status'] == 'done')
            return 'Marked as completed';
          else if (new Date(e['due']).toDateString() == date.toDateString())
            return 'Due at ' + e['due_time'];
          else if (new Date(e['due']) < date)
            return 'Late, Due ' + e['due_date'];
          else
            return 'Due ' + e['due_date'] + ', ' + e['due_time'];
        },
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
      }
    }
  </script>
@endpush
