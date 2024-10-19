<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('drop view if exists role_count_member');
        DB::statement("
            create view role_count_member as
            select r.*, count(distinct mhr.model_id) AS count_of_member, group_concat(distinct p.name order by p.name ASC separator ', ') AS permissions
            from  roles r left join model_has_roles mhr on mhr.role_id = r.id
            left join role_has_permissions rhp on rhp.role_id = r.id
            left join permissions p on p.id = rhp.permission_id
            group by r.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view if exists role_count_member');
    }
};
