<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Employee::create([
                'employee_id'=> 'EMP_' . $faker->unique()->randomNumber(5),
                'work_start_date' => $faker->date(),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'position_id' => rand(1,4),
                'status_id' => rand(1,2)
            ]);
        }
    }
}
