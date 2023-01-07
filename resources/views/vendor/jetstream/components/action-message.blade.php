@props(['on'])

<div style="display: none;" x-data="{ shown: false, timeout: null }" x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout);
    shown = true;
    timeout = setTimeout(() => { shown = false }, 2000); })" x-show="shown"
    x-transition.opacity.out.duration.1500ms {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>
    {{ $slot ?? 'Saved.' }}
</div>
