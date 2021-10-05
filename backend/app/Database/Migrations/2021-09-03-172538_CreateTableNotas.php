<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableNotas extends Migration
{
	public function up()
	{
		$this->forge->addField('id');
		$this->forge->addField([
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'nota' => [
				'type' => 'TEXT'
			]
		])->createTable('notas');
	}

	public function down()
	{
		$this->forge->dropTable('notas');
	}
}
