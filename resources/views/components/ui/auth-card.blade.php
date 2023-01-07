<div class="py-4">
    <div class="mdc-card mdc-card--outlined w-full px-10 py-8 mx-auto mt-6 overflow-hidden sm:max-w-lg">
        <div class="text-4xl font-bold">
            {{ $title }}
        </div>
        <div class="mt-3 text-base text-left text-gray-600">
            {{ $description ?? '' }}
        </div>

        <div class="mt-5 border-t border-gray-200"></div>

        {{ $slot }}

    </div>

</div>
