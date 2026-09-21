@props([
    'title' => null,
    'subtitle' => null,
    'searchPlaceholder' => 'Cari dalam tabel...',
    'actions' => null,
    'footer' => null,
])

<div class="admin-card">
    @if($title || $actions)
        <div class="admin-card__header">
            <div class="admin-card__title-box">
                <div>
                    @if($title)
                        <h3 class="admin-card__title">{{ $title }}</h3>
                    @endif
                    @if($subtitle)
                        <p class="admin-card__subtitle">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            <div class="admin-card__toolbar">
                <div class="table-search-input">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="{{ $searchPlaceholder }}" aria-label="Filter tabel">
                </div>

                @if($actions)
                    {{ $actions }}
                @endif
            </div>
        </div>
    @endif

    <div class="admin-table-responsive">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="admin-table__footer">
            {{ $footer }}
        </div>
    @endif
</div>
