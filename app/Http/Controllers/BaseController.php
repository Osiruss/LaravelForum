<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct() {
    	$this->data = [];
    	$this->data['faker'] = \Faker\Factory::create();
		$this->middleware('auth',['except'=>['index','show']]);
    }
}
