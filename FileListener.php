<?php


class FileListener
{
    protected $dir = 'C:\OSPanel\domains\general\Inc';

    protected $regexp1 = "json";

    protected $regexp2 = "xml";


    public function __construct()
    {



    }
    // возвращает массивв всех файлов
    public function getFiles(){

        return $files = scandir($this->dir);

    }


    // ищет файлы с конкретным id

    public function getListId($id){

        $files = $this->getFiles();
        foreach ($files as $file)
        {

            $name = explode('.', $file);

            $file_arr = explode('_', $name[0]);

            $file_id = $file_arr[2];

            if($file_id===strval($id)){

                $raundFiles[]=$file;

            }

        }
            if(!empty($raundFiles)) {

                 return $raundFiles;

            }else{

                return 'round not found';

            }


        }

        public function Sort($id, $action)
        {

            $files = $this->getListId($id);
            foreach ($files as $file){

                $name = explode('.', $file);

                $arr = explode('_', $name[0]);

                $nameAction=$arr[0];
                if($nameAction===$action){
                    $fileAction = $file;
                }

            }

            return $fileAction;

        }

        public function readFile($id, $action){

            $file=$this->Sort($id, $action);

            $type = explode('.', $file);

            if($type[1]=='xml'){

                $content = simplexml_load_file('inc/'.$file);

            }elseif ($type[1]=='json'){

                $content = file_get_contents('inc/'.$file);
                $content = json_decode($content);

            }

            return $content;

        }
        public function Secreader(){

            $content = file_get_contents('security/providers.json');

            return json_decode($content);

        }

}
