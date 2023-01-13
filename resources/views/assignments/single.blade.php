<x-app-layout :title="$title">
    <x-offline-banner />
    @livewire('assignments.assignment-content', ['urlString' => $assignmentString])
</x-app-layout>
