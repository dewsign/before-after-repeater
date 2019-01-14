<?php

namespace Dewsign\BeforeAfterRepeater;

use Illuminate\Database\Eloquent\Model;
use Dewsign\NovaRepeaterBlocks\Traits\IsRepeaterBlock;

class BeforeAfter extends Model
{
    use IsRepeaterBlock;

    protected $table = 'nrb_before_after_blocks';

    public static $repeaterBlockViewTemplate = 'before-after-repeater::before-after';
}
