<div>
  <div class="mdc-card mdc-card--outlined mt-3 roboto mx-2 md:mx-auto" :class="{'md:-mx-3': selectedAssignment == assignment['id']}">
    <div class="mdc-card__primary-action assignment-card-top px-6 md:px-8" tabindex="0" @click="selectedAssignment == assignment['id'] ? selectedAssignment = -1 : selectedAssignment = assignment['id']"
     :class="{'assignment-selected-card': selectedAssignment == assignment['id']}">
      <div class="float-left">
        <p class="font-medium text-base -mt-2 sm:mt-0 sm:text-lg mr-5 w-full truncate"
        x-text="assignment['assignment_name']"></p>
        <p class="mdc-typography text-sm -mt-0.5 text-gray-600 truncate"
        x-text="assignment['class_name']"></p>
      </div>
      <div class="float-right">
        <button class="mdc-icon-button material-icons z-20 float-right" type="button" x-text="assignment['status'] == 'inc' ? 'check_circle' : 'unpublished'" @click="event.stopPropagation(); @this.updateStatus(assignment['id'])" :aria-describedby="`assignmentToggle${assignment['id']}`"></button>
        <template x-if="assignment['assignment_link'] != null && assignment['assignment_link'].match('.*[a-zA-Z].*')">
          <div class="float-right">
            <a :href="assignment['assignment_link']" target="_blank"><button class="mdc-icon-button material-icons z-20" type="button" @click="event.stopPropagation();" :aria-describedby="`assignmentLink${assignment['id']}`">launch</button></a>
          </div>
        </template>
      </div>
      <br class="block sm:hidden" />
      <br class="block sm:hidden" />
      <div class="sm:float-right ml-0 float-left text-sm -mt-4 sm:mt-4 mr-4">
        <span
        :class="{'text-green': new Date(assignment['due']).getTime() >= new Date().getTime() && assignment['status'] == 'inc', 'text-red': new Date(assignment['due']).getTime() < new Date().getTime() && assignment['status'] == 'inc' }"
        x-text="getStatus(assignment)"></span>
      </div>
    </div>
    <div x-show.transition.origin.top.center.duration.50ms="selectedAssignment == assignment['id']" class="w-auto pb-5" x-cloak>
      <div class="border-t border-gray-100"></div>
      <div class="assignment_card_content_div">
        <div class="pt-2 px-2">
          <p class="w-full text-gray-500" :class="{'mb-2': assignment['status'] == 'done'}" x-text="assignment['status'] == 'done' ? `Originally Due ${assignment['due_date']}` : ''"></p>
          <p class="w-full text-gray-600" x-text="assignment['description']"></p>
        </div>
        <br>
        <div class="w-full pt-3s">
          <button class="mdc-button mdc-button mdc-button-ripple float-left" type="button" aria-label="Open Assignment" tabindex="12">
            <a x-bind:href="`/assignments/assignment/${assignment['url_string']}`">
              <span class="mdc-button__ripple"></span>Open Assignment
              <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
            </a>
          </button>
        </div>
      </div>
    </div>
  </div>
  <template x-if="assignment['assignment_link'] != null">
    <div :id="`assignmentLink${assignment['id']}`" class="mdc-tooltip" role="tooltip" aria-hidden="true">
      <div class="mdc-tooltip__surface">
        Open assignment link
      </div>
    </div>
  </template>
  <div :id="`assignmentToggle${assignment['id']}`" class="mdc-tooltip" role="tooltip" aria-hidden="true">
    <div class="mdc-tooltip__surface" x-text="assignment['status'] == 'inc' ? 'Mark assignment as completed' : 'Mark assignment as incomplete'">
    </div>
  </div>
</div>
