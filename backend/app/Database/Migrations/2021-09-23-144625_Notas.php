<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notas extends Migration
{
	public function up()
	{
		$fields = [
			'created' => ['type' => 'INTEGER'],
			'updated' => ['type' => 'INTEGER'],
		];
		$this->forge->modifyColumn('notas', $fields);
	}

	public function down()
	{
		$this->forge->dropTable('notas');
	}
}
