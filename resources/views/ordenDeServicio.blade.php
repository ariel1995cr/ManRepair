@extends('inicio')

@section('ordenDeServicio')
@if($ordenDeServicio==NULL)
<div class="alert alert-danger d-flex align-items-center mt-2 text-center w-100" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div class="mt-2">
        <p>No existe la orden de servicio!</p>
    </div>
</div>
@endif
@endsection