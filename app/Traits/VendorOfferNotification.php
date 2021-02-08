<?php

namespace App\Traits;

use App\Helpers\CommonHelper;

// 1150
/**
 * Trait responsible for all vendor offer fcm notification
 */
trait VendorOfferNotification
{
    public function notifyCreatedNotification()
    {
        // notification to supplier
        $supplier        = $this->vendor;
        $notification_id = $supplier->fcm_token;
        $title           = "Offer created";
        $message         = "Hi, {$supplier->name}, Your offer is successfully sent to approver/factory.";
        $id              = $supplier->id;
        $type            = "basic";
        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);

        // notification to factory
        $factory         = $this->factory;
        $notification_id = $factory->fcm_token;
        $title           = "New offer received";
        $message         = "You have received a new offer {$this->leaf_quantity} kg's. from {$factory->name}.";
        $id              = $factory->id;
        $type            = "basic";
        $res             = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);
    }
    public function notifyRejectedBySupplierNotification()
    {
        // notification to supplier
        $supplier        = $this->vendor;
        $notification_id = $supplier->fcm_token;
        $title           = "Offer rejected";
        $message         = "Hi, {$supplier->name}, Your offer is rejected.";
        $id              = $supplier->id;
        $type            = "basic";
        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);

        // notification to factory
        $factory         = $this->factory;
        $notification_id = $factory->fcm_token;
        $title           = "An offer is rejected";
        $message         = "Hi, {$factory->name} an offer of {$this->leaf_quantity} kg's quantity is rejected by {$factory->name}. ".($this->cancelled_reason ? "reason: ".$this->cancelled_reason : "");
        $id              = $factory->id;
        $type            = "basic";
        $message         = substr($message, 0, 1000);
        $res             = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);
    }
    public function notifyAcceptedBySupplierNotification()
    {
        // notification to supplier
        $supplier        = $this->vendor;
        $notification_id = $supplier->fcm_token;
        $title           = "Offer Accepted";
        $message         = "Hi, {$supplier->name}, Your offer is Accepted and confirmation code is {$this->confirmation_code}. For more information open mobile application.";
        $id              = $supplier->id;
        $type            = "basic";
        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);

        // notification to factory
        $factory         = $this->factory;
        $notification_id = $factory->fcm_token;
        $title           = "Offer Accepted";
        $message         = "Hi, {$factory->name} an offer of {$this->leaf_quantity} kg's quantity is accepted by {$factory->name}.";
        $id              = $factory->id;
        $type            = "basic";
        $message         = substr($message, 0, 1000);
        $res             = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);
    }
    public function notifyAcceptedByFactoryNotification()
    {
        // notification to supplier
        $supplier        = $this->vendor;
        $notification_id = $supplier->fcm_token;
        $title           = "Offer Accepted";
        $message         = "Hi, {$supplier->name}, Your offer is Accepted. And confirmation code is {$this->confirmation_code}.";
        $id              = $supplier->id;
        $type            = "basic";
        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);

        // notification to factory
        $factory         = $this->factory;
        $notification_id = $factory->fcm_token;
        $title           = "Offer Accepted";
        $message         = "Hi, {$factory->name} an offer of {$this->leaf_quantity} kg's quantity is accepted and confirmation code is {$this->confirmation_code}.";
        $id              = $factory->id;
        $type            = "basic";
        $message         = substr($message, 0, 1000);
        $res             = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);
    }
    public function notifyRejectedByFactoryNotification()
    {
        // notification to supplier
        $supplier        = $this->vendor;
        $factory         = $this->factory;

        $notification_id = $supplier->fcm_token;
        $title           = "Offer rejected";
        $message         = "Hi, {$supplier->name} an offer of {$this->leaf_quantity} kg's quantity is rejected by {$factory->name}. ".($this->cancelled_reason ? "reason: ".$this->cancelled_reason : "");
        $id              = $supplier->id;
        $type            = "basic";
        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);

        // notification to factory
        $notification_id = $factory->fcm_token;
        $title           = "Offer rejected";
        $message         = "Hi, {$factory->name} an offer of {$this->leaf_quantity} kg's quantity is rejected.";
        $id              = $factory->id;
        $type            = "basic";
        $message         = substr($message, 0, 1000);
        $res             = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id, $type);
    }
}

