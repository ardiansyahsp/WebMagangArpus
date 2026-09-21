@props([
    'title' => '',
    'label' => '',
    'value' => '0',
    'raw' => null,
    'description' => '',
    'growth' => null,
    'trend' => 'up',
    'icon' => 'book-open',
    'color' => 'maroon',
    'sparkline' => null,
])

@php
    $displayLabel = $title ?: $label;
    $numericTarget = $raw ?? preg_replace('/[^0-9]/', '', $value);
    $isNumeric = is_numeric($numericTarget) && $numericTarget > 0;
    
    // Sparkline points mock based on color/type
    $sparkPoints = match($color) {
        'maroon' => '12,18,15,28,24,38,45',
        'gold' => '8,15,22,19,30,26,40',
        'blue' => '20,18,32,25,36,44,52',
        'amber' => '5,12,8,15,10,18,22',
        default => '10,20,15,25,30,28,35',
    };

    $sparkColor = match($color) {
        'maroon' => '#a11212',
        'gold' => '#f4b400',
        'blue' => '#0ea5e9',
        'amber' => '#f59e0b',
        default => '#a11212',
    };
@endphp

<div class="stat-card stat-card--{{ $color }} animate-fade-up">
    <div class="stat-card__top">
        <div class="stat-card__icon">
            @if($icon === 'book-open' || $icon === 'book')
                <i data-lucide="book-open" style="width: 22px; height: 22px;"></i>
            @elseif($icon === 'archive')
                <i data-lucide="archive" style="width: 22px; height: 22px;"></i>
            @elseif($icon === 'globe')
                <i data-lucide="globe-2" style="width: 22px; height: 22px;"></i>
            @elseif($icon === 'search' || $icon === 'file-search')
                <i data-lucide="file-search" style="width: 22px; height: 22px;"></i>
            @elseif($icon === 'users')
                <i data-lucide="users" style="width: 22px; height: 22px;"></i>
            @elseif($icon === 'file-text')
                <i data-lucide="file-text" style="width: 22px; height: 22px;"></i>
            @else
                <i data-lucide="layers" style="width: 22px; height: 22px;"></i>
            @endif
        </div>

        @if($growth)
            <span class="stat-card__badge">
                <i data-lucide="trending-up" style="width: 13px; height: 13px;"></i>
                <span>{{ $growth }}</span>
            </span>
        @endif
    </div>

    <!-- Animated Counting Number -->
    <div class="stat-card__value" 
         @if($isNumeric) 
            data-counter-target="{{ $numericTarget }}" 
            data-counter-prefix="" 
         @endif>
        {{ $value }}
    </div>

    <div class="stat-card__label">{{ $displayLabel }}</div>
    
    @if($description)
        <div class="stat-card__description">{{ $description }}</div>
    @endif

    <!-- Mini Sparkline Visualization -->
    <div class="stat-card__sparkline" data-sparkline="{{ $sparkPoints }}" data-sparkline-color="{{ $sparkColor }}"></div>
</div>
