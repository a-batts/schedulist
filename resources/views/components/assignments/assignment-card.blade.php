<div>
    <div class="mdc-card mdc-card--outlined mx-2 mt-3 md:mx-auto"
        :class="{ 'md:-mx-3': selectedAssignment == assignment['id'] }">
        <div class="mdc-card__primary-action assignment-card-top px-6 md:px-8" tabindex="0"
            @click="selectedAssignment == assignment['id'] ? selectedAssignment = -1 : selectedAssignment = assignment['id']"
            :class="{ 'assignment-selected-card': selectedAssignment == assignment['id'] }">
            <div class="flex">
                <div class="flex-grow">
                    <p class="w-full mr-5 text-base font-medium truncate sm:mt-0 sm:text-lg" x-text="assignment['name']">
                    </p>
                    <p class="mdc-typography text-sm text-gray-600 truncate" x-text="assignment['class_name']"></p>
                </div>
                <div class="flex">
                    <div class="self-center justify-center mr-2 text-sm align-middle">
                        <span
                            :class="{
                                'text-green': new Date(assignment['due']).getTime() >= new Date().getTime() &&
                                    assignment[
                                        'status'] == 0,
                                'text-red': new Date(assignment['due']).getTime() < new Date()
                                    .getTime() && assignment['status'] == 0
                            }"
                            x-text="getStatus(assignment)"></span>
                    </div>
                    <button class="t mdc-icon-button material-icons z-20 text-gray-600" type="button"
                        @click.stop="$wire.toggleCompletion(assignment['id'])"
                        :aria-describedby="`assignmentToggle${assignment['id']}`" :disabled="offline">
                        <div class="mdc-icon-button__ripple"></div>
                        <span x-text="assignment['status'] == 0 ? 'check_circle' : 'unpublished'"></span>
                    </button>
                    <template x-if="assignment['link'] != null && assignment['link'].match('.*[a-zA-Z].*')">
                        <div>
                            <a :href="assignment['link']" target="_blank" rel="noopener">
                                <button class="mdc-icon-button material-icons z-20" type="button" @click.stop
                                    :aria-describedby="`assignmentLink${assignment['id']}`">
                                    <div class="mdc-icon-button__ripple"></div>
                                    launch
                                </button>
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="w-auto pb-5" x-show="selectedAssignment == assignment['id']"
            x-transition.origin.top.center.duration.50ms x-cloak>
            <div class="border-t border-gray-100"></div>
            <div class="px-6 pt-4">
                <div class="px-2">
                    <p class="w-full text-sm text-gray-500" :class="{ 'pb-3 mb-3': assignment['status'] == 1 }"
                        x-text="assignment['status'] == 1 ? `Originally due on ${assignment['due_date']}` : ''"></p>
                    <p class="w-full text-gray-600" x-text="assignment['description']"></p>
                </div>
                <div class="w-full pt-5">
                    <button class="mdc-button mdc-button-ripple" type="button" aria-label="Open Assignment"
                        tabindex="12">
                        <a x-bind:href="`/assignments/assignment/${assignment['url_string']}`">
                            <span class="mdc-button__ripple"></span>
                            More details
                            <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @php
        /* Tooltips */
    @endphp

    <template x-if="assignment['link'] != null">
        <div class="mdc-tooltip" role="tooltip" aria-hidden="true" :id="`assignmentLink${assignment['id']}`">
            <div class="mdc-tooltip__surface mdc-tooltip__surface-animation">
                Open assignment link
            </div>
        </div>
    </template>
    <div class="mdc-tooltip" role="tooltip" aria-hidden="true" :id="`assignmentToggle${assignment['id']}`">
        <div class="mdc-tooltip__surface mdc-tooltip__surface-animation"
            x-text="assignment['status'] == 0 ? 'Mark assignment complete' : 'Mark assignment incomplete'">
        </div>
    </div>

</div>
