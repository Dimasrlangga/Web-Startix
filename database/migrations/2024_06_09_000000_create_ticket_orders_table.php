<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ticket_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->string('identity_type');
            $table->string('identity_number');
            $table->text('address');
            $table->string('province');
            $table->string('city');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('sender_name')->nullable();
            $table->string('proof')->nullable();
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ticket_orders');
    }
}; 