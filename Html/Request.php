<?php

namespace App\Html;

use App\RestApiClient\Client;
use App\Html\PageCounties;

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
        $page = new PageCounties();
        var_dump($request);
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
            case isset($request['btn-edit']):
                $page->editor();
                break;
            case isset($request['btn-save-county']):
                
                $name = $request['county-name'];
                $id =  $request['id-county'];
                $data['name'] = $name;
                $data['id'] = $id;
                var_dump($data);
                //die;
                $client->put('counties/'.$id,$data);
                break;
            case isset($request['brn-add']):               
                $data['name'] = $request['new-county'];
                var_dump($data);
                $client->post('counties', $data);
                break;
        }
    }
    private static function getCounties() : array
    {
        $client = new Client();
        $response = $client->get('counties');

        return $response['data'];
    }

    
}
