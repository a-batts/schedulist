<!-- prettier-ignore-attribute :style -->
<div class="transition-width mdc-card mdc-card--outlined agenda-item absolute min-h-[3.75rem] w-full select-none transition-colors"
    @click="setSelectedItem(index, day, $event)"
    :class="`${'background-' + getItemColor(item.id, item.color)} ${'agenda-item-' + index  }`"
    :style="`top: ${item.top}px; width: calc(${item.width}% - .25rem ); left: calc(${item.left}% + .25rem); height: calc(${item.bottom}px - ${item.top}px);`">
    <div class="mdc-card__primary-action h-full pb-2" tabindex="0"
        :class="`${ view == 'day' ? 'px-5' : 'px-3'} ${item.bottom - item.top > 80 && view == 'day' ? 'py-5' : 'py-1.5'}`">
        <p class="agenda-text-primary font-medium"
            :class="{
                'text-lg ': view == 'day',
                'overflow-y-hidden overflow-x-clip text-sm': view ==
                    'week'
            }"
            x-text="item.name"></p>
        <p class="agenda-text-secondary text-sm" x-text="item?.data?.['location'] ?? ''"></p>
        <p class="agenda-text-secondary text-sm transition-all" :class="{ 'hidden': view == 'week' }">
            <span x-text="item.startString"></span>
            <template x-if="item.endString != null">
                <span x-text="' - ' + item.endString"></span>
            </template>
        </p>
    </div>
</div>
