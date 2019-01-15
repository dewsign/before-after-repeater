<div class="before-after-image">
    @isset($repeaterContent->title)<h2>{{ $repeaterContent->title }}</h2>@endisset
    @isset($repeaterContent->subtitle)<p>{{ $repeaterContent->subtitle }}</p>@endisset
    
    <image-split
        originalimage="{{ $repeaterContent->standardOriginalImage }}"
        overlayimage="{{ $repeaterContent->standardOverlayImage }}"
        originalalt="{{ $repeaterContent->original_alt }}"
        overlayalt="{{ $repeaterContent->overlay_alt }}"
    >
    </image-split>
</div>