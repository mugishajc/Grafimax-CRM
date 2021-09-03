<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
            'manage language',
            'create language',
            'manage account',
            'edit account',
            'change password account',
            'manage system settings',
            'manage role',
            'create role',
            'edit role',
            'delete role',
            'manage permission',
            'create permission',
            'edit permission',
            'delete permission',
            'manage company settings',
            'manage stripe settings',
            'manage lead stage',
            'create lead stage',
            'edit lead stage',
            'delete lead stage',
            'manage project stage',
            'create project stage',
            'edit project stage',
            'delete project stage',
            'manage lead source',
            'create lead source',
            'edit lead source',
            'delete lead source',
            'manage label',
            'create label',
            'edit label',
            'delete label',
            'manage product unit',
            'create product unit',
            'edit product unit',
            'delete product unit',
            'manage expense',
            'create expense',
            'edit expense',
            'delete expense',
            'manage client',
            'create client',
            'edit client',
            'delete client',
            'manage lead',
            'create lead',
            'edit lead',
            'delete lead',
            'manage project',
            'create project',
            'edit project',
            'delete project',
            'client permission project',
            'invite user project',
            'manage product',
            'create product',
            'edit product',
            'delete product',
            'show project',
            'manage tax',
            'create tax',
            'edit tax',
            'delete tax',
            'manage invoice',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',
            'manage expense category',
            'create expense category',
            'edit expense category',
            'delete expense category',
            'manage payment',
            'create payment',
            'edit payment',
            'delete payment',
            'manage invoice product',
            'create invoice product',
            'edit invoice product',
            'delete invoice product',
            'manage invoice payment',
            'create invoice payment',
            'manage task',
            'create task',
            'edit task',
            'delete task',
            'move task',
            'show task',
            'create checklist',
            'edit checklist',
            'create milestone',
            'edit milestone',
            'delete milestone',
            'view milestone',
            'manage change password',
            'manage plan',
            'create plan',
            'edit plan',
            'buy plan',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'manage order',
            'manage bug status',
            'create bug status',
            'edit bug status',
            'delete bug status',
            'move bug status',
            'manage bug report',
            'create bug report',
            'edit bug report',
            'delete bug report',
            'move bug report',
            'manage timesheet',
            'create timesheet',
            'edit timesheet',
            'delete timesheet'
        ];

        foreach($arrPermissions as $ap)
        {
            Permission::create(['name' => $ap]);
        }

        // Super admin

        $superAdminRole        = Role::create(
            [
                'name' => 'super admin',
                'created_by' => 0,
            ]
        );
        $superAdminPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
            'manage language',
            'create language',
            'manage account',
            'edit account',
            'change password account',
            'manage system settings',
            'manage stripe settings',
            'manage role',
            'create role',
            'edit role',
            'delete role',
            'manage permission',
            'create permission',
            'edit permission',
            'delete permission',
            'manage change password',
            'manage plan',
            'create plan',
            'edit plan',
            'manage order'

        ];
        foreach($superAdminPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $superAdminRole->givePermissionTo($permission);
        }
        $superAdmin = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('1234'),
                'type' => 'super admin',
                'lang' => 'en',
                'avatar' => '',
                'created_by' => 0,
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // client
        $clientRole       = Role::create(
            [
                'name' => 'client',
                'created_by' => 0,
            ]
        );
        $clientPermission = [
            'manage account',
            'edit account',
            'change password account',
            'show project',
            'manage project',
            'manage task',
            'create task',
            'move task',
            'show task',
            'create checklist',
            'edit checklist',
            'create milestone',
            'edit milestone',
            'delete milestone',
            'view milestone',
            'manage change password',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'buy plan',
            'manage bug status',
            'create bug status',
            'edit bug status',
            'delete bug status',
            'move bug status',
            'manage bug report',
            'create bug report',
            'edit bug report',
            'delete bug report',
            'move bug report',
            'manage timesheet',
            'create timesheet',
            'edit timesheet',
            'delete timesheet'
        ];

        foreach($clientPermission as $ap)
        {
            $permission = Permission::findByName($ap);
            $clientRole->givePermissionTo($permission);
        }


        // company

        $companyRole        = Role::create(
            [
                'name' => 'company',
                'created_by' => $superAdmin->id,
            ]
        );
        $companyPermissions = [
            "manage user",
            "create user",
            "edit user",
            "delete user",
            "manage language",
            "manage account",
            "edit account",
            "change password account",
            "manage role",
            "create role",
            "edit role",
            "delete role",
            "manage company settings",
            "manage lead stage",
            "create lead stage",
            "edit lead stage",
            "delete lead stage",
            "manage project stage",
            "create project stage",
            "edit project stage",
            "delete project stage",
            "manage lead source",
            "create lead source",
            "edit lead source",
            "delete lead source",
            "manage label",
            "create label",
            "edit label",
            "delete label",
            "manage product unit",
            "create product unit",
            "edit product unit",
            "delete product unit",
            "manage expense",
            "create expense",
            "edit expense",
            "delete expense",
            "manage client",
            "create client",
            "edit client",
            "delete client",
            "manage lead",
            "create lead",
            "edit lead",
            "delete lead",
            "manage project",
            "create project",
            "edit project",
            "delete project",
            'client permission project',
            'invite user project',
            "manage product",
            "create product",
            "edit product",
            "delete product",
            "show project",
            "manage tax",
            "create tax",
            "edit tax",
            "delete tax",
            "manage invoice",
            "create invoice",
            "edit invoice",
            "delete invoice",
            "show invoice",
            "manage expense category",
            "create expense category",
            "edit expense category",
            "delete expense category",
            "manage payment",
            "create payment",
            "edit payment",
            "delete payment",
            "manage invoice product",
            "create invoice product",
            "edit invoice product",
            "delete invoice product",
            "manage invoice payment",
            "create invoice payment",
            "manage task",
            "create task",
            "edit task",
            "delete task",
            "move task",
            'show task',
            "create checklist",
            "edit checklist",
            'create milestone',
            'edit milestone',
            'delete milestone',
            'view milestone',
            'manage change password',
            'manage plan',
            'buy plan',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'buy plan',
            'manage bug status',
            'create bug status',
            'edit bug status',
            'delete bug status',
            'move bug status',
            'manage bug report',
            'create bug report',
            'edit bug report',
            'delete bug report',
            'move bug report',
            'manage timesheet',
            'create timesheet',
            'edit timesheet',
            'delete timesheet'
        ];

        foreach($companyPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $companyRole->givePermissionTo($permission);
        }
        $company = User::create(
            [
                'name' => 'company',
                'email' => 'company@example.com',
                'password' => Hash::make('1234'),
                'type' => 'company',
                'lang' => 'en',
                'avatar' => '',
                'plan' => 1,
                'created_by' => $superAdmin->id,
            ]
        );
        $company->assignRole($companyRole);
        $company->makeEmployeeRole();
        $company->userDefaultData();
    }
}
