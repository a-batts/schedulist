<x-guest-layout title="Set Password">
  <div class="py-12">
    @php
      $userData = session()->get('data');
      if (! session()->has('data'))
        abort('401');
    @endphp
    <livewire:auth.password-picker :userData="$userData">
  </div>
</x-guest-layout>
