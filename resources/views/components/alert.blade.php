@props(['type' =>'info','message'])

@php
   $icons = [
    'success' => 'bi-check2-square',
    'info' => 'bi-info-circle',
    'warning' => 'bi-exclamation-square',
    'danger' => 'bi-exclamation-octagon'
    ];

  $icon = $icons[$type] ?? 'bi-info-circle-fill';

@endphp
<div class="alert alert-{{$type}} d-flex align-items-center" role="alert">
    <i class="bi-{{$icon}} me-2 fs-5"></i>
    <div>
        {{$message}}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Fermer</button>
</div>