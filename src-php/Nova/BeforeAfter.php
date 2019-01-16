<?php

namespace Dewsign\BeforeAfterRepeater\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Illuminate\Support\Facades\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Silvanite\NovaFieldCloudinary\Fields\CloudinaryImage;
use Dewsign\NovaRepeaterBlocks\Traits\IsRepeaterBlockResource;

class BeforeAfter extends Resource
{
    use IsRepeaterBlockResource;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Dewsign\BeforeAfterRepeater\BeforeAfter';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label()
    {
        return __('Before / After Image Slider');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Title'),
            Text::make('Subtitle'),
            config('repeater-blocks.images.field')::make('Original Image')
                ->disk(config('repeater-blocks.images.disk')),
            Text::make('Original Alt'),
            config('repeater-blocks.images.field')::make('Overlay Image')
                ->disk(config('repeater-blocks.images.disk')),
            Text::make('Overlay Alt'),
        ];
    }
}
