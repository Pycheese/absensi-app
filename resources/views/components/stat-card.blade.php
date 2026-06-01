@props(['label', 'value', 'icon'])

<x-card>
    <div class="flex items-center gap-3">
        <div class="text-xl">{{ $icon }}</div>
        <div>
            <p class="text-muted text-sm">{{ $label }}</p>
            <h2 class="text-xl font-semibold text-text">{{ $value }}</h2>
        </div>
    </div>
</x-card>