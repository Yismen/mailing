<?php

if (function_exists('reportTableName') === false) {
    function reportTableName(string $name)
    {
        return config('report.db_prefix') . $name;
    }
}

if (function_exists('str') == false) {
    function str(string $string)
    {
        return \Illuminate\Support\Str::of($string);
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage(string $message, string $type = 'success')
    {
        $flasher = resolve(\Flasher\Prime\FlasherInterface::class);

        $flasher->option('position', 'bottom-right')->addFlash($type, $message);
    }
}
