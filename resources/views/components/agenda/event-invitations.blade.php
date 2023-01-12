<div class="md:relative" x-data="eventInvitationList()">
    <button class="mdc-icon-button material-icons relative" aria-describedby="inbox" @click="showingInbox = !showingInbox">
        <div class="mdc-icon-button__ripple"></div>
        inbox
        <div class="mdc-typography absolute flex items-center justify-center transition-colors rounded-full right-2 top-2"
            :class="{ 'background-red w-4 h-4': invitations.length > 0 }">
            <p class="text-xs font-bold" x-text="invitations.length > 0 ? invitations.length : ''"></p>
        </div>
    </button>
    <div class="mdc-card mdc-card--outlined absolute left-0 z-40 mt-2 w-[30rem] max-w-[100vw] px-8 py-6 md:left-auto md:right-0"
        style="max-height: calc(100vh - 180px)" x-show="showingInbox" x-transition @click.outside="showingInbox = false"
        x-cloak>
        <div class="relative overflow-y-auto">
            <p class="text-2xl font-bold">Event Invites</p>
            <div class="pt-5">
                <template x-for="(invite, index) in invitations">
                    <div class="mdc-card mdc-card--outlined px-4 py-3 mb-5">
                        <div class="flex">
                            <div class="flex-grow">
                                <p class="text-xl font-bold" x-text="invite.name"></p>
                                <p x-text="invite.formatted_date"></p>
                                <p class="text-sm text-gray-600" x-text="invite.formatted_time"></p>
                                <template x-if="invite.reoccuring == 1">
                                    <p class="mt-2 text-sm text-gray-600">This event repeats</p>
                                </template>
                                <p class="mt-2 text-sm" :aria-describedby="'email-invite-' + index">
                                    Shared by
                                    <span x-text="invite.creator.firstname"></span>
                                    <span x-text="invite.creator.lastname"></span>
                                </p>
                                <div class="mdc-tooltip z-50" role="tooltip" aria-hidden="true"
                                    :id="'email-invite-' + index">
                                    <div class="mdc-tooltip__surface mdc-tooltip__surface-animation"><span
                                            x-text="invite.creator.email"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button class="mdc-icon-button material-icons" @click="acceptInvite(index)">
                                    <div class="mdc-icon-button__ripple"></div>
                                    check
                                </button>
                                <button class="mdc-icon-button material-icons" @click="declineInvite(index)">
                                    <div class="mdc-icon-button__ripple"></div>
                                    close
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <template x-if="invitations.length == 0">
                <div class="flex flex-col items-center justify-center py-6 text-gray-400">
                    <p><i class="material-icons text-7xl">upcoming</i></p>
                    <p class="mt-3 text-lg">No invites at the moment.</p>
                </div>
            </template>
        </div>
    </div>
</div>

@push('scripts')
    <script data-swup-reload-script>
        function eventInvitationList() {
            return {
                invitations: [],

                showingInbox: false,

                init: function() {
                    @this.getInvitations().then((result) => {
                        this.invitations = result;
                        this.$nextTick(() => {
                            for (i = 0; i < result.length; i++) {
                                initTooltip('email-invite-' + i)
                            }
                        })
                    });
                },

                acceptInvite: function(index) {
                    fetch(window.location.origin + '/event/invite/accept', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            id: this.invitations[index].id,
                        })
                    }).then((response) => {
                        if (response.ok) {
                            this.invitations.splice(index, 1);
                            this.$wire.updateAgendaData();
                        }
                    })
                },

                declineInvite: function(index) {
                    fetch(window.location.origin + '/event/invite/decline', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            id: this.invitations[index].id,
                        })
                    }).then((response) => {
                        if (response.ok) {
                            this.invitations.splice(index, 1);
                        }
                    })
                }
            }
        }
    </script>
@endpush
