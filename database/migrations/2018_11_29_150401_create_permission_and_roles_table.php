<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // 权限表
        Schema::create('backend_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->defaule('');
            $table->string('description', 100)->default('');
            $table->timestamps();
        });

        // 角色表
        Schema::create('backend_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('');
            $table->string('description', 100)->default('');
            $table->timestamps();
        });

        // 角色权限表
        Schema::create('backend_role_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->defaule('');
            $table->integer('permission_id')->defaule('');
            $table->timestamps();
        });

        // 用户角色表
        Schema::create('backend_user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->defaule('');
            $table->integer('role_id')->defaule('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('backend_permissions');
        Schema::dropIfExists('backend_roles');
        Schema::dropIfExists('backend_role_permission');
        Schema::dropIfExists('backend_user_role');
    }

}
