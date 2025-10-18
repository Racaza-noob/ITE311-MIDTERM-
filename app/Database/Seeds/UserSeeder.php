<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        // Admin User
        $users->save([
            'username' => 'admin',
            'password' => 'admin123',
            'name'     => 'Administrator',
            'email'    => 'admin@school.edu',
            'role'     => 'admin'
        ]);

        // Teacher User
        $users->save([
            'username' => 'teacher',
            'password' => 'teacher123',
            'name'     => 'Jim Jamero',
            'email'    => 'jim.jamero@school.edu',
            'role'     => 'teacher'
        ]);

        // Student User
        $users->save([
            'username' => 'student',
            'password' => 'student123',
            'name'     => 'Jerald Student',
            'email'    => 'jerald.student@school.edu',
            'role'     => 'student'
        ]);

        echo "Users have been seeded!\n";
    }
}
