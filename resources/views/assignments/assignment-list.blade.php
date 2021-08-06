<x-app-layout title="Dashboard | Assignments">
  @push('meta')
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  @push('fonts')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
  @endpush
  <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="mt-4"></div>
    @livewire('assignments.assignment-list', ['class' => $class, 'due' => $due])
    @livewire('assignments.assignment-create')
  </div>
  <x-offline-banner/>
</x-app-layout>
