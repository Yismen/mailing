<?php

namespace Dainsys\Mailing\Http\Controllers;

use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('mailing::about', [
            'content' => str(File::get(__DIR__ . '/../../../README.md'))->markdown()
        ])   ;
    }
}
