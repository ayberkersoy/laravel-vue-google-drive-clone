<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('storage_path', 1024)->after('path')->nullable();
            $table->boolean('uploaded_on_cloud')->default(1)->after('size');
        });
    }

    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('storage_path');
            $table->dropColumn('uploaded_on_cloud');
        });
    }
};
