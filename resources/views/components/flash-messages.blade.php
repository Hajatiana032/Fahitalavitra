@php
    $flashMessages = [
        'primary' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info'),
    ];
@endphp
@foreach($flashMessages as $type => $message)
    @if($message)
        <div class="container mx-auto px-4 mt-5">
            <div
                class="alert alert-soft alert-{{ $type }} max-w-2xl mx-auto removing:translate-x-5 removing:opacity-0
                transition duration-300 ease-in-out flex items-center"
                role="alert"
                id="dismiss-alert-{{ $type }}">
                <span class="flex-1 text-center">{{ $message }}</span>
                <button
                    class="cursor-pointer ms-3 leading-none flex-shrink-0"
                    data-remove-element="#dismiss-alert-{{ $type }}"
                    aria-label="Close Button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>
    @endif
@endforeach
