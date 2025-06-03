<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Deal;

return new class extends Migration
{
     /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payments')->onDelete('cascade');
            $table->foreignId('deal_statuses_id')->constrained('deal_statuses')->onDelete('cascade');
            $table->string('car_name');
            $table->string('brand_name');
            $table->integer('price');
            $table->timestamps();
        });

        $deals = [
            [
                'car_name' => 'Civic',
                'brand_name' => 'Honda',
                'price' => '10000000',
                'payment_method_id' => 1,
                'deal_statuses_id' => 1,
            ],
        ];

        foreach($deals as $deal){
            Deal::create($deal);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
