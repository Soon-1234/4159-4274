<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('PrefixeSeeder');
        $this->call('TypeOperationSeeder');
        $this->call('BaremeFraisSeeder');
        $this->call('OperateurSeeder');
        $this->call('AutreOperateurSeeder');
        $this->call('CommissionExterneSeeder');
    }
}
