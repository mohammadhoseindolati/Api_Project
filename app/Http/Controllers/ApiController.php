<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser;

    protected function getSearchParameters(): array|null
    {

        $url = $_SERVER['REQUEST_URI'];

        $pars = parse_url($url, $component = -1);

        $parameter = "query" ;

        if (array_key_exists($parameter, $pars)) {

            parse_str($pars[$parameter], $parameters);

            $parameterSearch = array_filter($parameters, function ($param) {

                // filter parameter of pagination
                return $param !== "page";
            }, ARRAY_FILTER_USE_KEY);

            return $parameterSearch;
        }else{

            return null ;
        }
    }
}
