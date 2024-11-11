<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\JobApplication;
use App\Models\MyJob;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Prajwal Test',
            'email' => 'prajwaltest@gmail.com',
        ]);


        User::factory(300)->create();

        $users = User::all()->shuffle();

        for($i=0; $i<20; $i++){
            Employer::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        $employers = Employer::all();

        for($i=0; $i<100; $i++){
            MyJob::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        foreach($users as $user){
            $jobs = MyJob::inRandomOrder()->take((rand(0,4)))->get();

            foreach($jobs as $job){
                JobApplication::factory()->create([
                    'my_job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }

    }
}
