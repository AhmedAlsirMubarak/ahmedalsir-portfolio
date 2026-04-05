<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Skill extends Model {
    protected $fillable = ['name','category','level','sort_order'];
    protected $casts = ['level'=>'integer'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
}
