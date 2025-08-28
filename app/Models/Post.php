<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //menambahkan atribut yang diizinkan untuk mass assigment

    protected $fillable = ['title', 'image','content','genre','author_id'];

}
