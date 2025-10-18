<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the Portal',
                'content' => 'This is your new announcements page. Stay tuned for updates.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Maintenance Notice',
                'content' => 'The system will undergo maintenance this weekend.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
