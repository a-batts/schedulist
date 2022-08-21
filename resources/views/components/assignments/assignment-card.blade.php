<div>
  <div class="mx-2 mt-3 mdc-card mdc-card--outlined md:mx-auto" :class="{'md:-mx-3': selectedAssignment == assignment['id']}">
    <div class="px-6 mdc-card__primary-action assignment-card-top md:px-8" tabindex="0" @click="selectedAssignment == assignment['id'] ? selectedAssignment = -1 : selectedAssignment = assignment['id']"
     :class="{'assignment-selected-card': selectedAssignment == assignment['id']}">
      <div class="flex">
        <div class="flex-grow">
          <p class="w-full mr-5 text-base font-medium truncate sm:mt-0 sm:text-lg"
          x-text="assignment['assignment_name']"></p>
          <p class="text-sm text-gray-600 truncate mdc-typography"
          x-text="assignment['class_name']"></p>
        </div>
        <div class="flex">
          <div class="self-center justify-center mr-2 text-sm align-middle">
            <span
            :class="{'text-green': new Date(assignment['due']).getTime() >= new Date().getTime() && assignment['status'] == 'inc', 'text-red': new Date(assignment['due']).getTime() < new Date().getTime() && assignment['status'] == 'inc' }"
            x-text="getStatus(assignment)"></span>
          </div>
          <button class="z-20 text-gray-600 t mdc-icon-button material-icons" type="button" @click.stop="@this.updateStatus(assignment['id'])" :aria-describedby="`assignmentToggle${assignment['id']}`">
            <div class="mdc-icon-button__ripple"></div>
            <span x-text="assignment['status'] == 'inc' ? 'check_circle' : 'unpublished'"></span>
          </button>
          <template x-if="assignment['assignment_link'] != null && assignment['assignment_link'].match('.*[a-zA-Z].*')">
            <div>
              <a :href="assignment['assignment_link']" target="_blank">
                <button class="z-20 mdc-icon-button material-icons" type="button" @click.stop :aria-describedby="`assignmentLink${assignment['id']}`">
                  <div class="mdc-icon-button__ripple"></div>
                  launch
                </button>
              </a>
            </div>
          </template>
        </div>
      </div>
    </div>
    <div x-show="selectedAssignment == assignment['id']" x-transition.origin.top.center.duration.50ms class="w-auto pb-5" x-cloak>
      <div class="border-t border-gray-100"></div>
      <div class="px-6 pt-4">
        <div class="px-2">
          <p class="w-full text-sm text-gray-500" :class="{'pb-3 mb-3': assignment['status'] == 'done'}" x-text="assignment['status'] == 'done' ? `Originally due on ${assignment['due_date']}` : ''"></p>
          <p class="w-full text-gray-600" x-text="assignment['description']"></p>
        </div>
        <div class="w-full pt-5">
          <button class="mdc-button mdc-button-ripple" type="button" aria-label="Open Assignment" tabindex="12">
            <a x-bind:href="`/assignments/assignment/${assignment['url_string']}`">
              <span class="mdc-button__ripple"></span>More details
              <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
            </a>
          </button>
        </div>
      </div>
    </div>
  </div>

  @php /* Tooltips */ @endphp
  
  <template x-if="assignment['assignment_link'] != null">
    <div :id="`assignmentLink${assignment['id']}`" class="mdc-tooltip" role="tooltip" aria-hidden="true">
      <div class="mdc-tooltip__surface mdc-tooltip__surface-animation">
        Open assignment link
      </div>
    </div>
  </template>
  <div :id="`assignmentToggle${assignment['id']}`" class="mdc-tooltip" role="tooltip" aria-hidden="true">
    <div class="mdc-tooltip__surface mdc-tooltip__surface-animation" x-text="assignment['status'] == 'inc' ? 'Mark assignment complete' : 'Mark assignment incomplete'">
    </div>
  </div>

</div>
