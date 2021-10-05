<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notas extends Migration
{
	public function up()
	{
		if ($this->forge->dropDatabase('notas')) {
			echo 'Database deleted!';
		}
	}

	public function down()
	{
		//
	}
}
