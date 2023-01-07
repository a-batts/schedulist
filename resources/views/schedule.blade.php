<x-app-layout title="Agenda">
    <div class="mx-auto">
        <div class="fixed w-full" wire:ignore>
            @livewire('schedule.agenda-widget', ['initDate' => $initDate])
        </div>
        @livewire('schedule.event-create')
        @livewire('schedule.event-edit')
        @livewire('schedule.event-share')
        @livewire('schedule.event-delete')
        @livewire('schedule.event-invite', ['sharedEvent' => $sharedEvent ?? null])

        <x-offline-banner />
    </div>
</x-app-layout>
