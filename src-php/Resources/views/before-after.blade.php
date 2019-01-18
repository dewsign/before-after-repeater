<div class="before-after-image">
    @isset($repeaterContent->title)<h2>{{ $repeaterContent->title }}</h2>@endisset
    @isset($repeaterContent->subtitle)<p>{{ $repeaterContent->subtitle }}</p>@endisset
    
    <before-after
        beforeimage="{{ $repeaterContent->standardOriginalImage }}"
        afterimage="{{ $repeaterContent->standardOverlayImage }}"
        beforealt="{{ $repeaterContent->original_alt ?? '' }}"
        afteralt="{{ $repeaterContent->overlay_alt ?? '' }}"
    >
    </before-after>
</div>