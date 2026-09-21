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
                <i data-lucide="x" style="width: 18px; height: 18px;"></i>
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
