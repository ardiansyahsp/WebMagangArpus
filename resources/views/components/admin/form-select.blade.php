@props([
    'name' => '',
    'label' => null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'helper' => null,
    'placeholder' => '-- Pilih Opsi --'
])

<div class="admin-form-group">
    @if($label)
        <label for="{{ $name }}" class="admin-form-label">
            {{ $label }}
            @if($required)
                <span class="required" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="admin-select @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @if(!empty($options))
            @foreach($options as $key => $option)
                @php
                    $val = is_array($option) ? ($option['id'] ?? $option['nama'] ?? $key) : (is_numeric($key) ? $option : $key);
                    $optLabel = is_array($option) ? ($option['nama'] ?? $option['label'] ?? $val) : $option;
                    $isSelected = (string) old($name, $selected) === (string) $val;
                @endphp
                <option value="{{ $val }}" {{ $isSelected ? 'selected' : '' }}>
                    {{ $optLabel }}
                </option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>

    @if($helper)
        <small class="admin-form-helper">{{ $helper }}</small>
    @endif

    @error($name)
        <span class="admin-form-error">{{ $message }}</span>
    @enderror
</div>
