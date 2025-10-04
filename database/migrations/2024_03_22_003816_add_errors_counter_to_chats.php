<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('telegraph_chats', function (Blueprint $table) {
            $table->unsignedInteger('errors')->default(0)->after('telegraph_bot_id');
        });
    }

    public function down(): void
    {
        Schema::table('telegraph_chats', function (Blueprint $table) {
            $table->dropColumn('errors');
        });
    }
};
