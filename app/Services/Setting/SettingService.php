<?php

namespace App\Services\Setting;

use App\Constants\IntroduceSetting;
use App\Models\Introduce;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingService
{
    /**
     * Create user
     *
     * @param request
     * @return
     */
    public static function getContent()
    {
        $data = [];
        foreach (IntroduceSetting::INTRODUCE as $key => $item) {
            $data[$item] = Introduce::select('name', 'content')->where('condition', $key)->first();
        }

        return $data;
    }
}
