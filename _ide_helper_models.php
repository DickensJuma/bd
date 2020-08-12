<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property int $product_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Brand[] $brands
 * @property-read int|null $brands_count
 * @property-read \App\ProductCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubCategory query()
 */
	class SubCategory extends \Eloquent {}
}

namespace App{
/**
 * App\Brand
 *
 * @property int $id
 * @property string $name
 * @property int $sub_category_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @property-read \App\SubCategory $subcategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand query()
 */
	class Brand extends \Eloquent {}
}

namespace App{
/**
 * App\order
 *
 * @property int $id
 * @property int $orderNo
 * @property int $customer_id
 * @property float $total_price
 * @property string $phone
 * @property string|null $county
 * @property float|null $longitude
 * @property float|null $latitude
 * @property string|null $address
 * @property string|null $LocationName
 * @property string $status
 * @property int $paid
 * @property float|null $discount
 * @property float|null $sub_total
 * @property int|null $coupon_id
 * @property string $deliver
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Coupon|null $coupon
 * @property-read \App\User $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\orderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\MpesaWallet|null $mpesa_wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\order query()
 */
	class order extends \Eloquent {}
}

namespace App{
/**
 * App\ProductCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $file_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SubCategory[] $subCategory
 * @property-read int|null $sub_category_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory query()
 */
	class ProductCategory extends \Eloquent {}
}

namespace App{
/**
 * App\Rider
 *
 * @property int $id
 * @property int $user_id
 * @property int $id_no
 * @property string $vehicle_type
 * @property string $verification
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $rider
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rider query()
 */
	class Rider extends \Eloquent {}
}

namespace App{
/**
 * App\Coupon
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property int|null $value
 * @property int|null $percent_off
 * @property string $status
 * @property float $goods_worth
 * @property int $unique_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon query()
 */
	class Coupon extends \Eloquent {}
}

namespace App{
/**
 * App\MpesaWallet
 *
 * @property-read \App\order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MpesaWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MpesaWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MpesaWallet query()
 */
	class MpesaWallet extends \Eloquent {}
}

namespace App{
/**
 * App\orderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $shipment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $quantity
 * @property-read \App\order $order
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\orderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\orderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\orderItem query()
 */
	class orderItem extends \Eloquent {}
}

namespace App{
/**
 * App\Shipment
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $rider_id
 * @property string|null $status
 * @property string $shipmentId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\order $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\orderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipment query()
 */
	class Shipment extends \Eloquent {}
}

namespace App{
/**
 * App\ProductImage
 *
 * @property int $id
 * @property float|null $height
 * @property int $product_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $file_path
 * @property-read mixed $large_path
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage query()
 */
	class ProductImage extends \Eloquent {}
}

namespace App{
/**
 * App\ResetPassword
 *
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $code
 * @property string|null $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResetPassword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResetPassword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ResetPassword query()
 */
	class ResetPassword extends \Eloquent {}
}

namespace App{
/**
 * App\LocationTracking
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $longitude
 * @property float|null $latitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LocationTracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LocationTracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LocationTracking query()
 */
	class LocationTracking extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $verification_code
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property string $role
 * @property string $phone
 * @property string|null $county
 * @property float|null $longitude
 * @property float|null $latitude
 * @property string|null $address
 * @property string|null $location_name
 * @property int $status
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\log[] $log
 * @property-read int|null $log_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @property-read \App\Rider|null $ride
 * @property-read \App\WholesalerRetailer|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App{
/**
 * App\RiderDocs
 *
 * @property int $id
 * @property int $rider_id
 * @property string $name
 * @property string $filename
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $docs
 * @property-read mixed $file_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RiderDocs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RiderDocs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RiderDocs query()
 */
	class RiderDocs extends \Eloquent {}
}

namespace App{
/**
 * App\Delivery
 *
 * @property int $id
 * @property int $Rider_id
 * @property int $Customer_id
 * @property int $Order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $customer
 * @property-read \App\order $order
 * @property-read \App\User $rider
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Delivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Delivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Delivery query()
 */
	class Delivery extends \Eloquent {}
}

namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property int $sub_category_id
 * @property int $brand_id
 * @property int $user_id
 * @property int $status
 * @property string $description
 * @property float $price
 * @property int $visitors
 * @property string|null $quantity
 * @property string $disabled
 * @property int $uniqueId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Brand $brand
 * @property-read \App\ProductCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductImage[] $files
 * @property-read int|null $files_count
 * @property-read \App\orderItem|null $orderItem
 * @property-read \App\SubCategory $subcategory
 * @property-read \App\User $wholesaler
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereLike($column, $value, $boolean = 'and')
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\WholesalerRetailer
 *
 * @property int $id
 * @property string $shop_name
 * @property string|null $profile_image
 * @property int $user_id
 * @property string $verification
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $file_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WholesalerRetailer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WholesalerRetailer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WholesalerRetailer query()
 */
	class WholesalerRetailer extends \Eloquent {}
}

namespace App{
/**
 * App\log
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $logs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\log query()
 */
	class log extends \Eloquent {}
}

