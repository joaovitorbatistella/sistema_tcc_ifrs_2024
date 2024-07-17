<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileHelper 
{
    CONST TYPES = [
        ".png"  => "image",
        ".jpg"  => "image",
        ".jpeg" => "image",
        ".gif"  => "image",
        ".tiff" => "image",
        ".pdf"  => "document",
        ".docx" => "document",
        ".odf"  => "document",
        ".xls"  => "document",
        ".xlsx" => "document",
        ".doc"  => "document",
        ".ppt"  => "document",
        ".pptx" => "document",
        ".csv"  => "document",
        ".txt"  => "document"
    ];

    public static function getSlugTypeByExtension(string $extension): string
    {
        return self::TYPES[$extension] ?? 'document';
    }

    public static function hasFile(string $path) {
        return Storage::disk('public')->exists($path);
    }
      
    public static function getFile(string $path) {
        if(self::hasFile($path)) {
            return Storage::disk('public')->get($path);
        }
        return null;
    }

    public static function deleteDirectory($dirPath) {
        if (is_dir($dirPath)) {
           $files = scandir($dirPath);
           foreach ($files as $file) {
              if ($file !== '.' && $file !== '..') {
                 $filePath = $dirPath . '/' . $file;
                 if (is_dir($filePath)) {
                    deleteDirectory($filePath);
                 } else {
                    unlink($filePath);
                 }
              }
           }
           rmdir($dirPath);
        }
     }
}
