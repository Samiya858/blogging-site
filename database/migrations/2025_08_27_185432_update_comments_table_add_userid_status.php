<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('comments', function (Blueprint $table) {
        $table->dropColumn('author'); // remove author
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // link to users
        $table->string('status')->default('pending'); // pending or approved
    });
}

public function down(): void
{
    Schema::table('comments', function (Blueprint $table) {
        $table->string('author');
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
        $table->dropColumn('status');
    });
}

};
