<x-app-layout title="Agenda">
  @push('fonts')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush

  <div class="pt-10 mx-auto">
    <div class="mt-10"></div>
    <div>
      @livewire('schedule.agenda-widget', ['initDate' => $initDate])
    </div>
    @livewire('schedule.event-create')
    @livewire('schedule.event-edit')
    @livewire('schedule.event-share')
    @livewire('schedule.event-delete')
    @livewire('schedule.event-invite', ['sharedEvent' => $sharedEvent ?? null, 'invalidEvent' => $invalidEvent ?? false])

    <x-offline-banner/>
  </div>
</x-app-layout>
