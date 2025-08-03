<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Accommodation
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $address
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $website
 * @property float|null $price_from
 * @property bool $is_active
 * @property string|null $featured_image
 * @property array|null $gallery
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoomType[] $roomTypes
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation wherePriceFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation active()
 * @method static \Illuminate\Database\Eloquent\Builder|Accommodation ofType($type)
 * @method static \Database\Factories\AccommodationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'price_from',
        'is_active',
        'featured_image',
        'gallery',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'price_from' => 'decimal:2',
        'is_active' => 'boolean',
        'gallery' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the room types for the accommodation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roomTypes(): HasMany
    {
        return $this->hasMany(RoomType::class);
    }

    /**
     * Get the facilities for the accommodation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }

    /**
     * Scope a query to only include active accommodations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include accommodations of a specific type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}