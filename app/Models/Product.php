<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','slug','image','price','short_desc','full_desc','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
