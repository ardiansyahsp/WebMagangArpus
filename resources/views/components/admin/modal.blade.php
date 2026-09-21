@props([
    'id' => 'adminModal',
    'title' => 'Form Data',
    'size' => 'md',
    'footer' => null
])

<div id="{{ $id }}" class="admin-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}Title" tabindex="-1">
    <div class="admin-modal-dialog {{ $size === 'lg' ? 'admin-modal-dialog--lg' : '' }}">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="{{ $id }}Title">{{ $title }}</h3>
            <button type="button" class="admin-modal-close" data-modal-close aria-label="Tutup dialog modal">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="admin-modal-body">
            {{ $slot }}
        </div>

        @if($footer)
            <div class="admin-modal-footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
