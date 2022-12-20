<?php

class RoundConroller
{
    public function __construct()
    {



    }


    public function StartRound(){

        $id = '11';
        $roundInfo = new FileListener();
        $Round = $roundInfo->readFile($id, "start");
        $provider = $roundInfo->Secreader();
        $Sign = $provider->Sign;
        $pass = hash('sha256', $Sign);

        $Request['ProviderId'] = $provider->ProviderId;
        $Request['Sign'] = $pass;
        $Request['roundId'] = $Round->roundId;
        $Request['playerId'] = $Round->playerId;

        if(!empty($Request)){

            $success = true;

        }else{

            $success = false;

        }


        $db = 'provider: '.$Request['ProviderId'].', pass: '.$Request['Sign'].', Round N:'.$Request['roundId'].'player:'.$Request['playerId'];
        file_put_contents('db.txt', $db);



        $responce = $this->responce($success, 'start');

        return $responce;



    }
    public function endRound(){

        $id = '11';
        $roundInfo = new FileListener();
        $Round = $roundInfo->readFile($id, "end");
        $provider = $roundInfo->Secreader();
        $Sign = $provider->Sign;
        $pass = hash('sha256', $Sign);

        $Request['ProviderId'] = $provider->ProviderId;
        $Request['Sign'] = $pass;
        $Request['roundId'] = $Round->roundId;
        $Request['reward'] = $Round->reward;



        if(!empty($Request)){

            $success = true;

        }else{

             $success = false;

        }
        $db = 'provider: '.$Request['ProviderId'].', pass: '.$Request['Sign'].', Round N:'.$Request['roundId'].'player:'.$Request['playerId'];

        file_put_contents('db.txt', $db);

        $responce = $this->responce($success, 'end');

        return $responce;


    }
    public function responce($success, $action_id){

        $responce['success'] = $success;

        $responce['action_id'] = $action_id;

        if($success===true){

            $responce['message'] = 'ALL ok';

        }else{

            $responce['message'] = 'error';

        }
        $responce['code'] = $action_id;

        return $responce;


    }


    public function log($success, $action_id){

        $responce['request_type'] = $action_id;

        $responce['success'] = $success;

        if($success===true){

            $responce['error_message'] = 'ALL ok';

        }else{

            $responce['error_message'] = 'error';

        }

        $responce['action_id'] = $action_id;
        $log = 'provider: '. $responce['request_type'] .', pass: '.$responce['success'].', Round N:'.$responce['message'] = 'ALL ok'.'player:'.$responce['action_id'].'time:  '.date('l jS \of F Y h:i:s A');


        file_put_contents('log.txt', $log);

        return $responce;

    }

}

