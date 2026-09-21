@props([
    'name' => '',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'icon' => null,
    'helper' => null,
    'rows' => 3
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

    <div class="admin-input-wrapper {{ $icon ? 'has-icon' : '' }}">
        @if($icon)
            <span class="admin-input-icon">
                {{ $icon }}
            </span>
        @endif

        @if($type === 'textarea')
            <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                rows="{{ $rows }}"
                class="admin-textarea @error($name) is-invalid @enderror"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes }}
            >{{ old($name, $value) }}</textarea>
        @else
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ old($name, $value) }}"
                class="admin-input @error($name) is-invalid @enderror"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes }}
            />
        @endif
    </div>

    @if($helper)
        <small class="admin-form-helper">{{ $helper }}</small>
    @endif

    @error($name)
        <span class="admin-form-error">{{ $message }}</span>
    @enderror
</div>
