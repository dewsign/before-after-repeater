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
            CloudinaryImage::make('Original Image'),
            Text::make('Original Alt'),
            CloudinaryImage::make('Overlay Image'),
            Text::make('Overlay Alt'),
        ];
    }

    private static function getPrettyFilename($filename)
    {
        $basename = str_replace('.blade.php', '', $filename);
        return title_case(str_replace('-', ' ', $basename));
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
