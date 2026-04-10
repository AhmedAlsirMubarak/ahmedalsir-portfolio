<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Experience extends Model {
    use HasFactory;
    protected $fillable = ['role','company','location','duration','type','description','responsibilities','tech_tags','sort_order'];
    protected $casts = ['responsibilities'=>'array','tech_tags'=>'array'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
}
