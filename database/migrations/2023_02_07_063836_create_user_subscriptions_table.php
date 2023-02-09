<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_method', ['stripe'])->default('stripe')->nullable();
            $table->string('stripe_subscription_id', 10)->default(null)->nullable();
            $table->string('stripe_customer_id', 10)->default(null)->nullable();
            $table->string('stripe_plan_id',50)->default(null)->nullable();
            $table->float('plan_amount', 10, 2)->default(null)->nullable();
            $table->string('plan_amount_currency' ,10)->default(null)->nullable();
            $table->string('plan_interval' ,10)->default(null)->nullable();
            $table->boolean('plan_interval_count')->default(null)->nullable();
            $table->string('payer_email' ,50)->default(null)->nullable();
            $table->dateTime('created', $precision = 0)->default(null)->nullable();
            $table->dateTime('plan_period_start', $precision = 0)->default(null)->nullable();
            $table->dateTime('plan_period_end', $precision = 0)->default(null)->nullable();
            $table->string('status',50)->default(null)->nullable();
            $table->boolean('resubscribe')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
}
