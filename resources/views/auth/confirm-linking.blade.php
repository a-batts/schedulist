<x-guest-layout title="Confirm Account Password">
  <div class="py-12">
    @php
      $userData = session()->get('data');
      if (! session()->has('data'))
        abort('401');
    @endphp
    <livewire:auth.confirm-password :userData="$userData">
  </div>
</x-guest-layout>
