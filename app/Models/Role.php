<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public static function semua_akses()
    {
        return [
            ['id' => 'access_report', 'name' => ucwords(str_replace('_', ' ', 'access_report'))],
            ['id' => 'access_transaction', 'name' => ucwords(str_replace('_', ' ', 'access_transaction'))],
            ['id' => 'access_master', 'name' => ucwords(str_replace('_', ' ', 'access_master'))],
            ['id' => 'access_business_growth_report', 'name' => ucwords(str_replace('_', ' ', 'access_business_growth_report'))],
            ['id' => 'access_revenue_report', 'name' => ucwords(str_replace('_', ' ', 'access_revenue_report'))],
            ['id' => 'access_project_excecution_detail_report', 'name' => ucwords(str_replace('_', ' ', 'access_project_excecution_detail_report'))],
            ['id' => 'access_client_growth_report', 'name' => ucwords(str_replace('_', ' ', 'access_client_growth_report'))],
            ['id' => 'access_project', 'name' => ucwords(str_replace('_', ' ', 'access_project'))],
            ['id' => 'create_project', 'name' => ucwords(str_replace('_', ' ', 'create_project'))],
            ['id' => 'edit_project', 'name' => ucwords(str_replace('_', ' ', 'edit_project'))],
            ['id' => 'delete_project', 'name' => ucwords(str_replace('_', ' ', 'delete_project'))],
            ['id' => 'access_feature', 'name' => ucwords(str_replace('_', ' ', 'access_feature'))],
            ['id' => 'create_feature', 'name' => ucwords(str_replace('_', ' ', 'create_feature'))],
            ['id' => 'edit_feature', 'name' => ucwords(str_replace('_', ' ', 'edit_feature'))],
            ['id' => 'delete_feature', 'name' => ucwords(str_replace('_', ' ', 'delete_feature'))],
            ['id' => 'access_additional_feature', 'name' => ucwords(str_replace('_', ' ', 'access_additional_feature'))],
            ['id' => 'create_additional_feature', 'name' => ucwords(str_replace('_', ' ', 'create_additional_feature'))],
            ['id' => 'edit_additional_feature', 'name' => ucwords(str_replace('_', ' ', 'edit_additional_feature'))],
            ['id' => 'delete_additional_feature', 'name' => ucwords(str_replace('_', ' ', 'delete_additional_feature'))],
            ['id' => 'access_invoice', 'name' => ucwords(str_replace('_', ' ', 'access_invoice'))],
            ['id' => 'create_invoice', 'name' => ucwords(str_replace('_', ' ', 'create_invoice'))],
            ['id' => 'edit_invoice', 'name' => ucwords(str_replace('_', ' ', 'edit_invoice'))],
            ['id' => 'delete_invoice', 'name' => ucwords(str_replace('_', ' ', 'delete_invoice'))],
            ['id' => 'access_payment', 'name' => ucwords(str_replace('_', ' ', 'access_payment'))],
            ['id' => 'create_payment', 'name' => ucwords(str_replace('_', ' ', 'create_payment'))],
            ['id' => 'edit_payment', 'name' => ucwords(str_replace('_', ' ', 'edit_payment'))],
            ['id' => 'delete_payment', 'name' => ucwords(str_replace('_', ' ', 'delete_payment'))],
            ['id' => 'access_user', 'name' => ucwords(str_replace('_', ' ', 'access_user'))],
            ['id' => 'create_user', 'name' => ucwords(str_replace('_', ' ', 'create_user'))],
            ['id' => 'edit_user', 'name' => ucwords(str_replace('_', ' ', 'edit_user'))],
            ['id' => 'delete_user', 'name' => ucwords(str_replace('_', ' ', 'delete_user'))],
            ['id' => 'access_client', 'name' => ucwords(str_replace('_', ' ', 'access_client'))],
            ['id' => 'create_client', 'name' => ucwords(str_replace('_', ' ', 'create_client'))],
            ['id' => 'edit_client', 'name' => ucwords(str_replace('_', ' ', 'edit_client'))],
            ['id' => 'delete_client', 'name' => ucwords(str_replace('_', ' ', 'delete_client'))],
            ['id' => 'access_complexity', 'name' => ucwords(str_replace('_', ' ', 'access_complexity'))],
            ['id' => 'create_complexity', 'name' => ucwords(str_replace('_', ' ', 'create_complexity'))],
            ['id' => 'edit_complexity', 'name' => ucwords(str_replace('_', ' ', 'edit_complexity'))],
            ['id' => 'delete_complexity', 'name' => ucwords(str_replace('_', ' ', 'delete_complexity'))],
            ['id' => 'access_gateway', 'name' => ucwords(str_replace('_', ' ', 'access_gateway'))],
            ['id' => 'create_gateway', 'name' => ucwords(str_replace('_', ' ', 'create_gateway'))],
            ['id' => 'edit_gateway', 'name' => ucwords(str_replace('_', ' ', 'edit_gateway'))],
            ['id' => 'delete_gateway', 'name' => ucwords(str_replace('_', ' ', 'delete_gateway'))],
        ];
    }
}
