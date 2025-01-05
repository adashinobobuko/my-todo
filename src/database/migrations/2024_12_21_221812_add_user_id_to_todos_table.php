<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            // 'user_id' カラムがすでに存在しない場合のみ追加する
            if (!Schema::hasColumn('todos', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id')->nullable(); // カラムを nullable にするかは要件次第
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            if (Schema::hasColumn('todos', 'user_id')) {
                $table->dropForeign(['user_id']); // 外部キー制約を削除
                $table->dropColumn('user_id');   // カラムを削除
            }
        });
    }
}
