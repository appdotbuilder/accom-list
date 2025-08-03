<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RoomType
 *
 * @property int $id
 * @property int $accommodation_id
 * @property string $name
 * @property string|null $description
 * @property float $price_per_night
 * @property int $max_occupancy
 * @property int|null $size_sqm
 * @property array|null $amenities
 * @property string|null $image
 * @property bool $is_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Accommodation $accommodation
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereAccommodationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereMaxOccupancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType wherePricePerNight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereSizeSqm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType available()
 * @method static \Database\Factories\RoomTypeFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class RoomType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'accommodation_id',
        'name',
        'description',
        'price_per_night',
        'max_occupancy',
        'size_sqm',
        'amenities',
        'image',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_night' => 'decimal:2',
        'max_occupancy' => 'integer',
        'size_sqm' => 'integer',
        'amenities' => 'array',
        'is_available' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the accommodation that owns the room type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Scope a query to only include available room types.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}