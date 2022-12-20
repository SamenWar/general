<?php


class router
{

    public function read($request){

        $request = explode('/', $request);
        return $request[2];

    }
    public function run($request){

        $action = $this->read($request);
        $do = new RoundConroller();
        if(!empty($action)){
            if($action==='start_round'){

                $do->StartRound();

            }elseif($action==='end_round'){

                    $do->endRound();


            }else{
                return '404';
            }

        }

    }


}