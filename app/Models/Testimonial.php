<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Testimonial extends Model {
    protected $fillable = ['quote','name','role','company','avatar','sort_order'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
    public function getAvatarUrlAttribute(): ?string {
        if (!$this->avatar) return null;
        if (str_starts_with($this->avatar,'http')) return $this->avatar;
        return asset('storage/'.$this->avatar);
    }
}
