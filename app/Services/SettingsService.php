<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class SettingsService{
    function setting($key, $value  = null){
        $setting = DB::table('settings')->where('key', $key)->first();

        if($value === null){
            return $setting->value ?? null;
        }

        DB::table('settings')->updateOrInsert(
            ['key' => $key], 
            ['value' => $value] 
        );
        return true;
    }
}