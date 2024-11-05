<?php

namespace App\Html;

use App\RestApiClient\Client;

class Request{
    static function handle()
    {
        switch ($_SERVER["REQUEST_METHOD"]){
            case "POST":                
                self::postRequest();
                break;
            case "GET":
            default:
                self::getRequest();
                break;
        }
    }
    private static function getRequest()
    {
        $request = $_REQUEST;
        if (isset($request['page'])) {
            $page = $request['page'];
            switch ($page) {
                case 'counties':
                    PageCounties::table(self::getCounties());
                    break;
                case 'cities':
                      break;
            }
        }

    }
    private static function postRequest()
    {
        $request = $_REQUEST;
        $client = new Client();
        switch ($request) {
            case isset($request['btn-home']) :
                break;
            case isset($request['btn-counties']) :
                PageCounties::table(self::getCounties());
                break;  
            case isset($request['btn-del-county']) :
                //echo $_POST["btn-del-county"];
                $client->delete('counties',$_POST['btn-del-county']);
                break;
        }
    }
    private static function getCounties() : array
    {
        $client = new Client();
        $response = $client->get('counties');

        return $response['data'];
    }

    private static function deleteCounty($id)
    {

    }
    
}
