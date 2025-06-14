<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    public function getList() {
        
        $articles = DB::table('articles')->get();

        return $articles;
    }
}