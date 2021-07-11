<x-app-layout title="Dashboard" id="appcontent">
  @push('fonts')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush

  <div class="py-12" id="app" style="padding-top: 100px;">
    <x-offline-banner/>
    
    @livewire('dashboard.class-create')
    @livewire('dashboard.class-card')
    @livewire('dashboard.delete-class')
  </div>
</x-app-layout>
