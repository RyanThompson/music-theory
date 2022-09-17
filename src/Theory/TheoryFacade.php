<?php

namespace RyanThompson\MusicTheory\Theory;

use Illuminate\Support\Facades\Facade;

class TheoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'theory';
    }
}
