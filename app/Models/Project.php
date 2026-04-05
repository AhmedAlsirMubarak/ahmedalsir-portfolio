<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Project extends Model {
    protected $fillable = ['title','description','image','tech_tags','category','live_url','repo_url','featured','sort_order'];
    protected $casts = ['tech_tags'=>'array','featured'=>'boolean'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
    public function getImageUrlAttribute(): ?string {
        if (!$this->image) return null;
        if (str_starts_with($this->image,'http')) return $this->image;
        return asset('storage/'.$this->image);
    }
}
