<div class="before-after-image">
    @isset($repeaterContent->title)<h2>{{ $repeaterContent->title }}</h2>@endisset
    @isset($repeaterContent->subtitle)<p>{{ $repeaterContent->subtitle }}</p>@endisset
    
    <v-image-split
        originalimage="{{ $repeaterContent->original_image }}"
        overlayimage="{{ $repeaterContent->overlay_image }}"
        originalalt="{{ $repeaterContent->original_alt }}"
        overlayalt="{{ $repeaterContent->overlay_alt }}"
    >
    </v-image-split>
</div>