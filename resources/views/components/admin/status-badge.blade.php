@props([
    'status' => '',
    'variant' => null
])

@php
    $normalized = strtolower(trim($status));
    
    if ($variant) {
        $badgeClass = 'status-badge--' . $variant;
    } else {
        $badgeClass = match($normalized) {
            'tersedia', 'beroperasi', 'selesai', 'aktif', 'arsiparis', 'terverifikasi tte' => 'status-badge--success',
            'menunggu validasi', 'diproses', 'menunggu review' => 'status-badge--warning',
            'disetujui', 'pustakawan' => 'status-badge--info',
            'akan dibeli' => 'status-badge--purple',
            'dipinjam', 'pemeliharaan', 'revisi berkas', 'nonaktif' => 'status-badge--danger',
            'super admin' => 'status-badge--maroon',
            default => 'status-badge--info',
        };
    }
@endphp

<span class="status-badge {{ $badgeClass }}">
    {{ $status }}
</span>
