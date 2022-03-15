<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name', 30);
            $table->string('surname', 50);
            $table->string('address', 100);
            $table->char('postal_code', 6);
            $table->string('city', 50);
            $table->char('phone', 9);
            $table->unsignedTinyInteger('payment_type_id');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->float('value', 8, 2, true);
            $table->boolean('assembly');
            $table->boolean('os_installation');
            $table->datetime('date')->useCurrent();
            $table->unsignedTinyInteger('order_status_id')->default(1);
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
