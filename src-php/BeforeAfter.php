<?php

namespace Dewsign\BeforeAfterRepeater;

use Illuminate\Database\Eloquent\Model;
use Dewsign\NovaRepeaterBlocks\Traits\IsRepeaterBlock;
use Dewsign\NovaRepeaterBlocks\Traits\CanBeContainerised;

class BeforeAfter extends Model
{
    use IsRepeaterBlock;
    use CanBeContainerised;

    protected $table = 'nrb_before_after_blocks';

    public static $repeaterBlockViewTemplate = 'before-after-repeater::before-after';

    public function getStandardOriginalImageAttribute()
    {
        return $this->getImage($this->original_image, 'before-after-original');
    }

    public function getStandardOverlayImageAttribute()
    {
        return $this->getImage($this->overlay_image, 'before-after-overlay');
    }

    public function getImage(string $image, string $style = 'before-after', array $params = [])
    {
        return config(
            "repeater-blocks.images.processors.{$style}",
            config("repeater-blocks.images.processors.default")
        )::get($image, $params);
    }
}
