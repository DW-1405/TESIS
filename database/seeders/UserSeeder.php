<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\VoucherType;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'category' => 'CAT A'
        ]);

        Brand::create([
            'brand' => 'BRAND A'
        ]);

        VoucherType::create([
            'type' => 'BOLETA',
            'serie' => 'B001',
            'code' => '03'
        ]);

        VoucherType::create([
            'type' => 'FACTURA',
            'serie' => 'F001',
            'code' => '03',
        ]);

        DocumentType::create([
            'document' => 'DNI',
        ]);

        DocumentType::create([
            'document' => 'RUC',
        ]);

        Workstation::create([
            'work' => 'ADMINISTRADOR',
        ]);

        Workstation::create([
            'work' => 'VENDEDOR',
        ]);

        $employee = Employee::create([
            'name' => 'Omar',
            'lastname' => 'Salazar Lozano',
            'document_type_id' => 1,
            'number_document' => '19802345',
            'date_birth' => '1980-03-13',
            'email' => 'omars@gmail.com',
            'telephone' => '988841787',
            'address' => 'Av. 28 Julio 235',
            'workstation_id' => 1
        ]);

        User::create([
            'name' => 'ADMIN',
            'password' => bcrypt('12345678'),
            'employee_id' => $employee->id
        ]);
    }
}
