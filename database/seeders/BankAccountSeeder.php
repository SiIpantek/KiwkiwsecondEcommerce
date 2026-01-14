<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            ['bank_name' => 'BCA', 'account_number' => '1234567890', 'account_name' => 'PT Kiw Kiw E-Commerce'],
            ['bank_name' => 'Mandiri', 'account_number' => '0987654321', 'account_name' => 'PT Kiw Kiw E-Commerce'],
            ['bank_name' => 'BNI', 'account_number' => '1122334455', 'account_name' => 'PT Kiw Kiw E-Commerce'],
            ['bank_name' => 'BRI', 'account_number' => '5544332211', 'account_name' => 'PT Kiw Kiw E-Commerce'],
            ['bank_name' => 'CIMB Niaga', 'account_number' => '6677889900', 'account_name' => 'PT Kiw Kiw E-Commerce'],
        ];

        foreach ($banks as $bank) {
            BankAccount::create($bank);
        }
    }
}
