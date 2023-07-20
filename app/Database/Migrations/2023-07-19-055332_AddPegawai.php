<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'address' => [
                'type' => 'text',
                'null' => true,
            ],
            'nohp' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'martialStatus' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'bod' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true
            ],
            'startDate' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'endDate' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'createdAt datetime default current_timestamp',
            'updatedAt datetime default current_timestamp',
            'deletedAt' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pegawai',true);
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
