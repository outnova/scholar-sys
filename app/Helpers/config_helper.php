<?php

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $model = new \App\Models\Settings();
        return $model->getSetting($key, $default);
    }
}

if (!function_exists('set_setting')) {
    function set_setting($key, $value)
    {
        $model = new \App\Models\Settings();
        return $model->setSetting($key, $value);
    }
}