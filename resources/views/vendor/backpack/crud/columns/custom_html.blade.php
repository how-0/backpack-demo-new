

@php
    $status = $entry->{$column['name']};
    
    $class = match ($status) {
        'New' => 'badge bg-danger text-white',
        'Processing' => 'badge bg-warning text-white',
        'Completed' => 'badge bg-success text-white',
        'Cancel' => 'badge bg-secondary text-white',
        default => 'badge bg-light',
    };
@endphp

<span class="{{ $class }}">
    {{ $status }}
</span>