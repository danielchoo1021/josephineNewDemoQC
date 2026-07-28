<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddAlmmoraAdminPermissionGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Find which permission_lvl the existing admin accounts currently use.
        $baseAdmin = DB::table('admins')->where('email', 'admin@vesson.my')->first();
        $basePermissionLvl = $baseAdmin->permission_lvl ?? 2;

        // Grant the "permission-control" page to the existing admin group,
        // so their access to Settings Manage > Permission stays unchanged.
        $alreadyGranted = DB::table('permissions')
            ->where('permission_lvl', $basePermissionLvl)
            ->where('page', 'permission-control')
            ->exists();

        if (!$alreadyGranted) {
            DB::table('permissions')->insert([
                'permission_lvl' => $basePermissionLvl,
                'page' => 'permission-control',
                'sorting' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create a dedicated permission group for the new admin account,
        // so it can be denied "permission-control" without affecting the others.
        $groupId = DB::table('permission_groups')->where('group_name', 'Admin (Almmora)')->value('id');

        if (empty($groupId)) {
            $groupId = DB::table('permission_groups')->insertGetId([
                'group_name' => 'Admin (Almmora)',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'AD000001',
                'updated_by' => 'AD000001',
            ]);

            // Copy every page grant from the base admin group, except permission-control.
            $basePermissions = DB::table('permissions')
                ->where('permission_lvl', $basePermissionLvl)
                ->where('page', '!=', 'permission-control')
                ->get();

            $rows = $basePermissions->map(function ($permission) use ($groupId) {
                return [
                    'permission_lvl' => $groupId,
                    'page' => $permission->page,
                    'sorting' => $permission->sorting,
                    'status' => $permission->status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            if (!empty($rows)) {
                DB::table('permissions')->insert($rows);
            }
        }

        // Create the admin@almmora.com account, if it doesn't already exist.
        $exists = DB::table('admins')->where('email', 'admin@almmora.com')->exists();

        if (!$exists) {
            $lastCode = DB::table('admins')->orderBy('id', 'desc')->value('code');
            $num = 1;
            if ($lastCode && preg_match('/AD(\d+)/', $lastCode, $m)) {
                $num = intval($m[1]) + 1;
            }
            $code = 'AD' . str_pad($num, 6, '0', STR_PAD_LEFT);

            DB::table('admins')->insert([
                'code' => $code,
                'email' => 'admin@almmora.com',
                'password' => Hash::make('admin1234'),
                'f_name' => 'Admin',
                'l_name' => 'Almmora',
                'website_logo' => '',
                'lvl' => 2,
                'permission_lvl' => $groupId,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admins')->where('email', 'admin@almmora.com')->delete();

        $groupId = DB::table('permission_groups')->where('group_name', 'Admin (Almmora)')->value('id');
        if (!empty($groupId)) {
            DB::table('permissions')->where('permission_lvl', $groupId)->delete();
            DB::table('permission_groups')->where('id', $groupId)->delete();
        }
    }
}
