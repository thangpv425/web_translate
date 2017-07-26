<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setLanguage($lang = 'en')
    {
    	$request = new Request;
    	return $request->session()->put('lang', $lang);
    }
}
