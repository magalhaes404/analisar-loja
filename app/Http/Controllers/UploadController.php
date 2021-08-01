<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store($arquivo)
    {
        return Storage::putFile('imagem', $arquivo);
    }
    
}
