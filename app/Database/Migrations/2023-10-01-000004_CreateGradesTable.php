<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGradesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'enrollment_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'grade' => [
                'type' => 'DECIMAL',
                'constraint' => [5,2],
                'null' => true
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'graded_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'graded_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('enrollment_id', 'enrollments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('graded_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('grades');
    }

    public function down()
    {
        $this->forge->dropTable('grades');
    }
}
