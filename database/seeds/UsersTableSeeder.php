<?php

use Illuminate\Database\Seeder;
use App\Bls\Admin\Model\AdminModel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new AdminModel();
        $user->name = 'Aufree';
        $user->email = 'admin@qq.com';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
