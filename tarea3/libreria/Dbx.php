<?php
//clase para gestionar la coleccion de datos en los archivos del directorio datax

defiNe("DATA_DIR", __DIR__."/datax");
class Dbx{
    public static function list($collection){
        $datapath = DATA_DIR."/{$collection}";
        
        if(!is_dir($datapath)){
            return [];
        }

        $files = scandir($datapath);
        $data = [];
        
        foreach($files as $file){
            $filepath = $datapath . '/' . $file;

            if(is_file($filepath)){
                continue;
            }

            $content = file_get_contents($filepath);
            $itemData = unserialize($content);

            if($itemData){
                $data[$file] = $itemData;
            }
        }
        return $data;
    }

}
?>