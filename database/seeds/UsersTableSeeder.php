<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$me = new User([
			'first_name' => 'Peter',
			'last_name' => 'Bedor',
			'username' => 'scowlface',
			'email' => 'peterbedor@gmail.com',
			'avatar' => 'https://api.adorable.io/avatars/285/peterbedor@gmail.com.png',
			'password' => bcrypt('cartman'),
		]);

		$me->save();

		factory(App\Models\User::class, 50)->create();
    }
}
