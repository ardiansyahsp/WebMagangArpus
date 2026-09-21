@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumbs' => []
])

<div class="admin-page-header animate-fade-up">
    <div class="admin-page-header__main">
        @if(!empty($breadcrumbs))
            <nav class="admin-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 4px;">
                    <i data-lucide="home" style="width: 14px; height: 14px;"></i>
                    <span>Admin</span>
                </a>
                @foreach($breadcrumbs as $breadcrumb)
                    <span class="separator">/</span>
                    @if(!empty($breadcrumb['url']))
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                    @else
                        <span style="color: var(--text-dark); font-weight: 600;">{{ $breadcrumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <h1 class="admin-page-title">{{ $title }}</h1>
        @if($subtitle)
            <p class="admin-page-subtitle">{{ $subtitle }}</p>
        @endif
    </div>

    @if(isset($actions))
        <div class="admin-page-actions">
            {{ $actions }}
        </div>
    @endif
</div>
