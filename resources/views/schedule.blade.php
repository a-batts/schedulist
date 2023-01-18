<x-app-layout title="Agenda">
    <div class="mx-auto">
        @livewire('schedule.agenda-widget', ['initDate' => $initDate, 'view' => $view ?? 'day'])
        @livewire('schedule.event-share')
        @livewire('schedule.event-delete')
        @livewire('schedule.event-invite', ['sharedEvent' => $sharedEvent ?? null])

        <x-offline-banner />
    </div>
</x-app-layout>
