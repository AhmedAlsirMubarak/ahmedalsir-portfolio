<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Education extends Model {
    use HasFactory;
    protected $table = 'educations';
    protected $fillable = ['degree','institution','year','location','description','logo','sort_order'];
    public function scopeOrdered(Builder $q): Builder { return $q->orderBy('sort_order')->orderBy('id'); }
    public function getLogoUrlAttribute(): ?string {
        if (!$this->logo) return null;
        if (str_starts_with($this->logo,'http')) return $this->logo;
        return asset('storage/'.$this->logo);
    }
}
