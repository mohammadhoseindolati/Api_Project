<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser ;

    protected function getSearchParameters () : array {

        $url = $_SERVER['REQUEST_URI'];

        $pars = parse_url($url, $component = -1);

        parse_str($pars['query'] , $parameters) ;

        $parameterSearch = array_filter($parameters , function ($param){

            // filter parameter of pagination
            return $param !== "page" ;
        } , ARRAY_FILTER_USE_KEY);

        return $parameterSearch ;
    }
}
