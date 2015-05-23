<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller {

    public function index()
    {
        return \View::make('index')->with('entry', News::all());
    }

}
