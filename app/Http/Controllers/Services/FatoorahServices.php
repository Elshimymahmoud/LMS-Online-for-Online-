<?php
 namespace App\Http\Controllers\Services;
use GuzzleHttp\Client;;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Redirect;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\ValidationException;

class FatoorahServices
{
    private $base_url;
    private $request_client;
    private $headers;
        public function __construct(Client $request_client){
            $this->request_client=$request_client;

            $this->base_url=env('FATOORAH_BASE_URL');
           
            $this->headers=[
                'Content-Type'=>'application/json',
                'Authorization'=>'Bearer '. env('FATOORAH_TOKEN')
            ];
            
        }
        private  function BuildRequest($uri,$method,$body=[])
        {
            # code...
            $request=new Request($method,$this->base_url. $uri,$this->headers);
          
            if(!$body){
                return false;
            }
            $response=$this->request_client->send($request,['json'=>$body]);

            if($response->getStatusCode() !==200){
                return false;
            }
            $response=json_decode($response->getBody(),true);
            return $response;
        }
        public function SendPayment($requierdData=[])
        {
            # code...
            
            try{
            $response=$this->BuildRequest('/v2/SendPayment','POST',$requierdData); 
            }
            catch (ClientException $exception) {
                //throw $th;
                $response = $exception->getResponse()->getBody()->getContents();
            return $response;
                
                
            }
            return $response;
        }
}
