<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->table(), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_type')->index();
            $table->foreignUuid('user_id');
            $table->decimal('balance', 64, 0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on($this->tableUser());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table());
    }

    private function table(): string
    {
        return (new Wallet())->getTable();
    }

    private function tableUser(): string
    {
        return (new User())->getTable();
    }
};
