@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <div class="alert-danger">
                {{ $error }}
            </div>
        </div>
    @endforeach
@endif