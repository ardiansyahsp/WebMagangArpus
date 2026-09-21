@props([
    'title' => null,
    'subtitle' => null,
    'searchPlaceholder' => 'Cari data...',
    'actions' => null,
    'footer' => null,
])

<div class="admin-card animate-fade-up">
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
                    <i data-lucide="search" class="icon" style="width: 16px; height: 16px;"></i>
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
