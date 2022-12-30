<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\Store;

trait UploadFileTrait
{
    public function uploadFile($actual_file, $file_path)
    {

        if ($actual_file->getClientOriginalName()) {
            $extension = $actual_file->getClientOriginalExtension();
            $file_name = date('YmdHis') . rand(1, 99999) . '.' . $extension;

            if (!file_exists($file_path)) {
                mkdir($file_path, 0755, true);
            }

            $actual_file->move($file_path, $file_name);
        }
        return $file_name;
    }

    public function removePhysicalFile(string $file, string $path)
    {
        try{
            if(!file_exists($file)){
                unlink($path.$file);
                Storage::delete($path.$file);
            }
            return true;
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
            throw new \Exception('Sorry could not remove file.');
        }
        
    }
}
