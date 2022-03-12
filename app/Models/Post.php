<?php

namespace App\Models;

// use App\Models\Category;
// use Illuminate\Support\Str;
// use Illuminate\Foundation\Auth\User;
// use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;
// use Dotenv\Repository\Adapter\GuardedWriter;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Post extends Model
{
    use HasFactory, Sluggable;

    // protected $fillable = ['title', 'slug', 'excerpt', 'body'];
    protected  $guarded = ['id'];

    protected $with = ['category', 'author'];
    //setiap pemanggilan model post maka category dan authornya langsung terpanggil

    public function scopeFilter($query, array $filters)
    {

        // $query->when($filters['search'] ?? false, function($query, $search){
        //     return $query->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('body', 'like', '%' . $search . '%');

        // });
        // $query->when($filters['category'] ?? false, function($query, $category){
        //     return $query->whereHas('category', function($query) use($category){
        //         $query->where('slug', $category);
        //     });
        // });
        // $query->when($filters['author'] ?? false, function($query, $author){
        //     return $query->whereHas('author', function($query) use($author){
        //         $query->where('username', $author);
        //     });
        // });

        $query->when($filters['search'] ?? false, fn($query, $search)
            => $query->where('title', $search)
                    ->orWhere('body', 'like', '%' . $search . '%')
        );
        $query->when($filters['category'] ?? false, fn($query, $category)
            => $query->whereHas('category', fn($query)
            => $query->where('slug', $category))
        );
        $query->when($filters['author'] ?? false, fn($query, $author)
            => $query->whereHas('author', fn($query) 
            => $query->where('username', $author))
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
        // getRouteKeyName untuk mengakali resource agar bisa menggunakan slug...bukan menggunakan id
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
