<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
class Produto extends Model
{
    use HasFactory;
    protected $table = "produtos";
    
    public function autor()
    {
        return $this->belongsTo(Empresa::class,'empresa','id');
    }
}
