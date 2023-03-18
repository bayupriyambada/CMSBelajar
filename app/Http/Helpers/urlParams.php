<?php

namespace App\Http\Helpers;

use Illuminate\Support\Str;

class urlParams
{
    public function paramsUrl($params)
    {
        $url = request()->query($params, null);
        if (!$url) {
            $url = auth()->user()->name  . '/' . Str::random(24);
            self::redirect($params, $url);
        }
        return;
    }

    public static function redirect($params, $url)
    {
        route($params, [$params => $url]);
    }
}
