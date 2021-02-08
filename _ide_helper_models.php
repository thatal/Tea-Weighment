<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $address_1
 * @property string|null $address_2
 * @property string|null $pin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address withoutTrashed()
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DailyFineLeafCount
 *
 * @property int $id
 * @property int $headquarter_id
 * @property int|null $factory_id
 * @property float $fine_leaf_count_from
 * @property float $fine_leaf_count_to
 * @property mixed $price
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Factory|null $factory
 * @property-read \App\Models\Headquarter $headquarter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DailyFineLeafCount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereFineLeafCountFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereFineLeafCountTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereHeadquarterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DailyFineLeafCount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DailyFineLeafCount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DailyFineLeafCount withoutTrashed()
 */
	class DailyFineLeafCount extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Factory
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role admin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\FactoryInformation|null $factory_information
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory available()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Factory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Factory whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Factory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Factory withoutTrashed()
 */
	class Factory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FactoryInformation
 *
 * @property int $id
 * @property int $user_id
 * @property int $headquarter_id
 * @property string|null $mobile
 * @property string|null $location
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Factory $factory
 * @property-read \App\Models\Headquarter $headquarter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FactoryInformation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereHeadquarterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FactoryInformation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FactoryInformation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FactoryInformation withoutTrashed()
 */
	class FactoryInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Headquarter
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role admin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FactoryInformation[] $factories_info
 * @property-read int|null $factories_info_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Headquarter whereUsername($value)
 */
	class Headquarter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $name
 * @property float $weight
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vehicle whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vehicle withoutTrashed()
 */
	class Vehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role admin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VendorBankDetails[] $bank_details
 * @property-read int|null $bank_details_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\VendorInformation|null $vendor_information
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor withoutTrashed()
 */
	class Vendor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VendorBankDetails
 *
 * @property int $id
 * @property int $vendor_id vendor id is belongs to user type vendor
 * @property string $bank_name
 * @property string $account_number
 * @property string $account_holder_name
 * @property string $ifsc_code
 * @property int $is_primary
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorBankDetails onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereAccountHolderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereIfscCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorBankDetails whereVendorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorBankDetails withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorBankDetails withoutTrashed()
 */
	class VendorBankDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VendorInformation
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $mobile
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorInformation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorInformation whereVendorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorInformation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorInformation withoutTrashed()
 */
	class VendorInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VendorOffer
 *
 * @property int $id
 * @property string|null $confirmation_code
 * @property int $vendor_id
 * @property int $factory_id
 * @property float $leaf_quantity
 * @property float $offer_price
 * @property string $expected_fine_leaf_count
 * @property mixed $expected_moisture
 * @property mixed $confirmed_moisture
 * @property string|null $vehicle_number
 * @property int|null $vehicle_type_id
 * @property float $first_weight
 * @property string|null $first_weight_image
 * @property float $second_weight
 * @property string|null $second_weight_image
 * @property float $tare
 * @property float $deduction
 * @property float $net_weight
 * @property float $confirmed_price
 * @property float|null $counter_offer_price
 * @property int|null $counter_offer_sent_by_id
 * @property string|null $counter_offer_sent_type
 * @property string|null $counter_offer_sent_at
 * @property string|null $counter_offer_accepted_at counter offer accepted or rejected at.
 * @property string|null $counter_offer_rejected_at
 * @property string $confirmed_fine_leaf_count
 * @property int|null $daily_leaf_cound_id
 * @property float $final_rate
 * @property int|null $leaf_count_added_by_id
 * @property string|null $leaf_count_added_at
 * @property float $total_amount
 * @property string $status
 * @property string|null $confirmed_at
 * @property int|null $confirmed_by_id
 * @property string|null $confirmed_by_type
 * @property int|null $cancelled_by_id
 * @property string|null $cancelled_by_type
 * @property string|null $cancelled_at
 * @property string|null $cancelled_reason
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $cancelled_by
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $confirmed_by
 * @property-read \App\Models\Factory $factory
 * @property-read mixed $first_weight_image_url
 * @property-read mixed $second_weight_image_url
 * @property-read \App\Models\Vehicle|null $vehicle
 * @property-read \App\Models\Vendor $vendor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer confirmed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer latest()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorOffer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer pending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCancelledById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCancelledByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCancelledReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedFineLeafCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereConfirmedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferSentById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCounterOfferSentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereDailyLeafCoundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereDeduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereExpectedFineLeafCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereExpectedMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereFinalRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereFirstWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereFirstWeightImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereLeafCountAddedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereLeafCountAddedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereLeafQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereNetWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereSecondWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereSecondWeightImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereTare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereVehicleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereVehicleTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VendorOffer whereVendorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorOffer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VendorOffer withoutTrashed()
 */
	class VendorOffer extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role admin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

