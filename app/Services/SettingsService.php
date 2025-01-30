<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class SettingsService{
    function setting($key, $value  = null){
        $setting = DB::table('settings')->where('key', $key)->first();

        if($value === null){
            return Crypt::decryptString($setting->value) ?? null;
        }

        DB::table('settings')->updateOrInsert(
            ['key' => $key], 
            ['value' => Crypt::encryptString($value)] 
        );
        return $setting ? Crypt::decryptString($setting->value) : null;
    }
} 