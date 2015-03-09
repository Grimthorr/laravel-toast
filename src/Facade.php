<?php

namespace Grimthorr\LaravelToast;


class Facade extends \Illuminate\Support\Facades\Facade {

    protected static function getFacadeAccessor()
    {
        return 'toast';
    }

} 
