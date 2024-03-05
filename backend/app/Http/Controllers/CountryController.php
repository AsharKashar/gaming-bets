<?php

namespace App\Http\Controllers;

use App\Model\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successApiResponse(Country::all());
    }
}
