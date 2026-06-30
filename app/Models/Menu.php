<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'url',
        'page_id',
        'news_id',
        'announcement_id',
        'parent_id',
        'order',
    ];

    public function getLinkAttribute()
    {
        return match ($this->type) {
            'custom', 'external' => $this->url,
            'page' => $this->page ? route('page.detail', $this->page->slug ?? $this->page->id) : '#',
            'news' => $this->news ? route('news') : route('news'),
            'announcement' => $this->announcement ? route('announcement') : route('announcement'),
            default => '#',
        };
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function page() { return $this->belongsTo(Page::class); }
    public function news() { return $this->belongsTo(News::class); }
    public function announcement() { return $this->belongsTo(Announcement::class); }
}
