<?php

use App\Enums\JobVacancyStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->longText('qualification');
            $table->integer('salary');
            $table->string('whatsapp');
            $table->enum('status', [JobVacancyStatusEnum::ACTIVE->value, JobVacancyStatusEnum::NONACTIVE->value])->default(JobVacancyStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
