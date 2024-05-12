<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->table(), function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('detail');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on($this->tableUser())->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table());
    }

    private function table(): string
    {
        return (new Product())->getTable();
    }

    private function tableUser(): string
    {
        return (new User())->getTable();
    }
};
