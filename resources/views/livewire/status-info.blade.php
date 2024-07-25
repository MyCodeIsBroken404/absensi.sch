<div>
    @isset($color)
    @isset($icon)
    <div class="alert text-white bg-{{$color}} fade show alert-dismissible" role="alert">
        <div class="d-flex align-items-center">
            <img src="{{asset('icons/'.$icon)}}" class="me-3" alt="Icon" style="width: 24px; height: 24px; filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg);">
            <div class="flex-grow-1">
                {{$message}}
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endisset
    @endisset
</div>