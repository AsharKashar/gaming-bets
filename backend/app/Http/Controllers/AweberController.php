<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AweberController extends Controller
{
    public function oauth(Request $request)
    {
        var_dump($request->all());
    }
}
