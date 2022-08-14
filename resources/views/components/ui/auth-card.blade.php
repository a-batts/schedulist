<div class="py-4">
  <div class="mdc-card mdc-card--outlined roboto mx-auto mt-6 w-full overflow-hidden px-10 py-8 sm:max-w-lg">
    <div class="text-4xl font-medium">
      {{$title}}
    </div>
    <div class="mt-3 text-left text-base text-gray-600">
      {{$description ?? ''}}
    </div>

    <div class="mt-5 border-t border-gray-200"></div>

    {{$slot}}

  </div>

</div>
