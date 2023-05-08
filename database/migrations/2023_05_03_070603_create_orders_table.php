<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('id_pesanan');
            $table->string('name');
            $table->string('contact');
            $table->string('alamat')->nullable();
            $table->string('shipto');
            $table->string('shippingserve');
            $table->string('shippingcode');
            $table->string('shippingcost');
            $table->unsignedInteger('id_user');
            $table->string('total_qty');
            $table->double('subtotal');
            $table->double('total_price');
            $table->enum('status', ['paid', 'unpaid']);
            $table->enum('payment_method', ['tf_mandiri', 'tf_bca', 'tf_bsi']);
            $table->string('bukti_pembayaran')->nullable();
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
        Schema::dropIfExists('orders');
    }
};