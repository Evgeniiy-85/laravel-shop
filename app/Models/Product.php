<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model {

    use HasFactory;

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    public const STATUSES = [
        1 => 'Активен',
        0 => 'Отключен',
    ];

    public $timestamps = false;
    public $primaryKey = 'prod_id';

    /**
     * @param int|null $status
     * @return int|array
     */
    public static function getStatuses(int|null $status = null) :string|array {
        return $status !== null ? self::STATUSES[$status] : self::STATUSES;
    }

    /**
     * @return Attribute
     */
    protected function prodImageUrl(): Attribute {
        return Attribute::make(
            get: function() {
                $prod_images = $this->prod_images_data;
                return $prod_images ? Storage::disk('products')->url($prod_images[0]) : asset('/images/no-img.png');
            },
        );
    }


    /**
     * @return Attribute
     */
    protected function prodImagesData(): Attribute {
        return Attribute::make(
            get: function() {
                return $this->prod_images ? json_decode($this->prod_images, 1) : false;
            },
        );
    }

    /**
     * @param $image
     * @return string
     */
    public function getImageUrl($image) {
        return Storage::disk('products')->url($image);
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = []) {
        return parent::save($options);
    }


    /**
     * @var string[]
     */
    protected $fillable = [
        'prod_title', 'prod_category', 'prod_alias', 'prod_price', 'prod_quantity',
        'prod_status', 'prod_short_desc', 'prod_desc', 'prod_images'
    ];
}
