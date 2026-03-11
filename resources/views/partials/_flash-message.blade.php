@if (session('error'))
    <div class="alert alert-error text-center">
        {{ session('error') }}
    </div>
@endif
@if (session('primary'))
    <div class="alert alert-primary text-center">
        {{ session('primary') }}
    </div>
@endif
