<?php

namespace Dainsys\Report\Http\Controllers;

use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('report::about', [
            'content' => str(File::get(__DIR__ . '/../../../README.md'))->markdown()
        ])   ;
    }
}
