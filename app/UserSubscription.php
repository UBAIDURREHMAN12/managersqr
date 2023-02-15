<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    public $table = 'user_subscriptions';

    protected $fillable = ['user_id','payment_method', 'stripe_subscription_id', 'stripe_customer_id', 'stripe_plan_id',
    'plan_amount', 'plan_amount_currency', 'plan_interval', 'plan_interval_count', 'payer_email', 'created',
        'plan_period_start', 'plan_period_end', 'status', 'resubscribe'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
