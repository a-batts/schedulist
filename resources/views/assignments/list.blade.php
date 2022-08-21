<x-app-layout title="Assignments">
  <div class="max-w-6xl px-4 py-10 mx-auto sm:px-6 lg:px-8">
    <div class="mt-4"></div>
    @livewire('assignments.assignment-list', ['class' => $class, 'due' => $due])
    @livewire('assignments.assignment-create')
  </div>
  <x-offline-banner/>
</x-app-layout>
