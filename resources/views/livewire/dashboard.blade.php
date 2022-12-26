<x-app-layout title="Dashboard" id="appcontent">
  <div class="py-12">
    <x-offline-banner/>

    @livewire('dashboard.dashboard-cards')
    @livewire('dashboard.class-details')
    @livewire('dashboard.class-create')
  </div>
</x-app-layout>
