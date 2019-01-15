<?php

namespace Dewsign\BeforeAfterRepeater;

use Illuminate\Database\Eloquent\Model;
use Dewsign\NovaRepeaterBlocks\Traits\IsRepeaterBlock;

class BeforeAfter extends Model
{
    use IsRepeaterBlock;

    protected $table = 'nrb_before_after_blocks';

    public static $repeaterBlockViewTemplate = 'before-after-repeater::before-after';

    public function getStandardOriginalImageAttribute()
    {
        if (!$this->original_image) {
            return null;
        }

        return cloudinary_image($this->original_image, [
            "width" => 500,
        ]);
    }

        public function getStandardOverlayImageAttribute()
    {
        if (!$this->overlay_image) {
            return null;
        }

        return cloudinary_image($this->overlay_image, [
            "width" => 500,
        ]);
    }
}
