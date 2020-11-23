<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decorations', function (Blueprint $table) {
            $table->id();
            $table->string('text')->default('NoText');
            $table->string('description')->nullable();
            $table->integer('width');
            $table->integer('height');
            $table->integer('position_x');
            $table->integer('position_y');
            $table->foreignId('scene_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('element_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();

            // 表示名
            // 文字サイズ*
            // 向き
            // 幅
            // 高さ
            // 座標X*
            // 座標Y*
            // is_auto_size def:true
            // color @string
            // scene_id
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decorations');
    }
}
