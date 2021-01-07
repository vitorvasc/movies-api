<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $id)
 * @method static create(array $data)
 */
class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'year', 'sinopse', 'duration', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /*
    |--------------------------------------------------------------------------
    | STATIC VARS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function get_people_roles(): Movie
    {
        $this->attributes['stars'] = $this->people()
            ->where('person_role', '=', Person::ROLES['STAR'])
            ->get();

        $this->attributes['directors'] = $this->people()
            ->where('person_role', '=', Person::ROLES['DIRECTOR'])
            ->get();

        $this->attributes['writers'] = $this->people()
            ->where('person_role', '=', Person::ROLES['WRITER'])
            ->get();

        return $this;
    }

    public function get_ratings_average(): Movie
    {
        $ratings = $this->ratings()->get();
        $totalStars = 0;

        if ($ratings->isEmpty()) {
            return $this;
        }

        foreach ($ratings as $rating) {
            $totalStars += $rating['rating'];
        }

        $this->attributes['rating'] = $totalStars / count($ratings);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany('\App\Models\Person', 'movie_person');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany('App\Models\Rating');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
