<?php
require_once('HTTP/Request2.php');

class ApiClient {

    public function erzData($zip=null,$type=null, $page=1) {

        if ($type) {
            $url = 'http://openerz.herokuapp.com:80/api/calendar/' . $type . '.json';
        } else {
            $url = 'http://openerz.herokuapp.com:80/api/calendar.json';
        }
          
        //Http-request 
        $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);

        $reqUrl = $request->getUrl();
        $pageSize = 10;
        $reqUrl->setQueryVariable('limit', $pageSize);
        $offset = ($page - 1) * $pageSize;
        $reqUrl->setQueryVariable('offset', $offset);
        

        if ($zip) {
            $reqUrl->setQueryVariable('zip', $zip);
        }

        try {
            $response = $request->send();
            // 200 ist für den Status ob ok ist 404 wäre zum Beispiel ein Fehler
            if ($response->getStatus() == 200) {
                return json_decode($response->getBody());
            }
        } catch (HTTP_Request2_Exception $ex) {
            echo $ex;
        }

        return null;
    }


    }

    //ErzData($zip,$type,$page);





?>