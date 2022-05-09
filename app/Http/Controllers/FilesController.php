<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use UrlSigner;
use Carbon\Carbon;

class FilesController extends Controller
{
    public static function getFile($filename)
    {
        $file=Storage::disk('public_pets')->get($filename);
        return response($file, 200)->header('Content-Type', 'image');
    }
}
