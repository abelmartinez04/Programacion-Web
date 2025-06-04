<?php
//clase para gestionar la coleccion de datos en los archivos del directorio datax

defiNe("DATA_DIR", __DIR__."/datax");

if(!is_dir(DATA_DIR)){
    mkdir(DATA_DIR, 0777, true);
}

class Dbx{
    public static function list($collection){
        $datapath = DATA_DIR."/{$collection}";
        
        if(!file_exists($datapath)){
            return [];
        }

        // $files = scandir($datapath);
        $data = [];
        
        foreach(scandir($datapath) as $file){
            if ($file === "." || $file === "..") {
                continue;
            }
            $filepath = $datapath . "/" . $file;

            if(!is_file($filepath)){
                continue;
            }

            $content = file_get_contents($filepath);
            $itemData = unserialize($content);

            if($itemData){
                $data[] = $itemData;
            }
        }
        return $data;
    }
    public static function get($collection, $id){
        $datapath = DATA_DIR . "/{$collection}/{$id}.dat";

        if(!file_exists($datapath)){
            return null;
        }

        $content = file_get_contents($datapath);
        return unserialize($content);
    }

    public static function save($collection, $item){
        $datapath = DATA_DIR . "/{$collection}";

        if(!is_dir($datapath)){
            mkdir($datapath, 0777, true);
        }
        
        $fileName = (strlen($item->idx) > 4) ? $item->idx : uniqid();
        $fileName = uniqid();
        $item->idx = $fileName;
        $filepath = $datapath . '/' .$fileName.'.dat';

        file_put_contents($filepath, serialize($item));
    }
}
?>