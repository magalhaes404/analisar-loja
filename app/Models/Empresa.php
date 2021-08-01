<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
class Empresa extends Model
{
    use HasFactory;
    protected  $table ="empresas";
    
    public function produtos()
    {
        return $this->hasMany(Produto::class,'empresa');
    }
}
