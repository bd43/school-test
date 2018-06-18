<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller 
{

    /**
     * Display homepage view
     *
     * @return Response
     */
    public function index()
    {
        return view('homepage');
    }
  
}

?>