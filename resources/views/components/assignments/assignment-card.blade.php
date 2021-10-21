<div>
  <div class="mx-2 mt-3 mdc-card mdc-card--outlined roboto md:mx-auto" :class="{'md:-mx-3': selectedAssignment == assignment['id']}">
    <div class="px-6 mdc-card__primary-action assignment-card-top md:px-8" tabindex="0" @click="selectedAssignment == assignment['id'] ? selectedAssignment = -1 : selectedAssignment = assignment['id']"
     :class="{'assignment-selected-card': selectedAssignment == assignment['id']}">
      <div class="float-left">
        <p class="w-full mr-5 -mt-2 text-base font-medium truncate sm:mt-0 sm:text-lg"
        x-text="assignment['assignment_name']"></p>
        <p class="mdc-typography text-sm -mt-0.5 text-gray-600 truncate"
        x-text="assignment['class_name']"></p>
      </div>
      <div class="float-right">
        <button class="z-20 float-right mdc-icon-button material-icons" type="button" @click="event.stopPropagation(); @this.updateStatus(assignment['id'])" :aria-describedby="`assignmentToggle${assignment['id']}`"><div class="mdc-icon-button__ripple"></div><span x-text="assignment['status'] == 'inc' ? 'check_circle' : 'unpublished'"></span></button>
        <template x-if="assignment['assignment_link'] != null && assignment['assignment_link'].match('.*[a-zA-Z].*')">
          <div class="float-right">
            <a :href="assignment['assignment_link']" target="_blank"><button class="z-20 mdc-icon-button material-icons" type="button" @click="event.stopPropagation();" :aria-describedby="`assignmentLink${assignment['id']}`"><div class="mdc-icon-button__ripple"></div>launch</button></a>
          </div>
        </template>
      </div>
      <br class="block sm:hidden" />
      <br class="block sm:hidden" />
      <div class="float-left ml-0 mr-4 -mt-4 text-sm sm:float-right sm:mt-4">
        <span
        :class="{'text-green': new Date(assignment['due']).getTime() >= new Date().getTime() && assignment['status'] == 'inc', 'text-red': new Date(assignment['due']).getTime() < new Date().getTime() && assignment['status'] == 'inc' }"
        x-text="getStatus(assignment)"></span>
      </div>
    </div>
    <div x-show.transition.origin.top.center.duration.50ms="selectedAssignment == assignment['id']" class="w-auto pb-5" x-cloak>
      <div class="border-t border-gray-100"></div>
      <div class="assignment_card_content_div">
        <div class="px-2 pt-2">
          <p class="w-full text-gray-500" :class="{'mb-2': assignment['status'] == 'done'}" x-text="assignment['status'] == 'done' ? `Originally Due ${assignment['due_date']}` : ''"></p>
          <p class="w-full text-gray-600" x-text="assignment['description']"></p>
        </div>
        <br>
        <div class="w-full pt-3s">
          <button class="float-left mdc-button mdc-button-ripple" type="button" aria-label="Open Assignment" tabindex="12">
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
