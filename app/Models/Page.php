<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class Page extends Model
{
    use CrudTrait;

    protected $table = 'pages';
    protected $guarded = ['id'];

    /**
     * Upload multiple files and store JSON paths in DB.
     */
    public function uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path)
    {
        // decode nilai attribute yang sudah tersimpan
        if (! is_array($this->{$attribute_name})) {
            $attribute_value = json_decode($this->{$attribute_name}, true) ?? [];
        } else {
            $attribute_value = $this->{$attribute_name};
        }

        $files_to_clear = request()->get('clear_'.$attribute_name);

        // jika ada file yang dihapus
        if ($files_to_clear) {
            foreach ($files_to_clear as $key => $filename) {
                Storage::disk($disk)->delete($filename);
                $attribute_value = Arr::where($attribute_value, function ($value, $key) use ($filename) {
                    return $value != $filename;
                });
            }
        }

        // jika ada file baru yang diupload
        if (request()->hasFile($attribute_name)) {
            foreach (request()->file($attribute_name) as $file) {
                if ($file->isValid()) {

                    // 1. Generate nama unik
                    $new_file_name = md5($file->getClientOriginalName() . random_int(1, 9999) . time()) . '.' . $file->getClientOriginalExtension();

                    // 2. Simpan file ke path tujuan
                    $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

                    // 3. Tambahkan path ke array attribute_value
                    $attribute_value[] = $file_path;
                }
            }
        }

        // Simpan path-path file dalam bentuk JSON ke database
        $this->attributes[$attribute_name] = json_encode(array_values($attribute_value));
    }

    /**
     * Mutator khusus untuk field 'photos'
     * Menyimpan langsung ke public/uploads/gallery
     */
    public function setPhotosAttribute($value)
    {
        $attribute_name = "photos";
        $disk = "public_uploads"; // disk baru yang kamu tambahkan di config/filesystems.php
        $destination_path = "gallery"; // folder dalam /public/uploads/

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
