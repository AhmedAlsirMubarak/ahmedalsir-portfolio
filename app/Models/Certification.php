<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Certification extends Model {
    protected $fillable = ['title','issuer','date','url','sort_order'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
}
