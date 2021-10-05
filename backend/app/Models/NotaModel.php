<?php

namespace App\Models;

use CodeIgniter\Model;

class NotaModel extends Model
{
	protected $table                = 'notas';
	protected $allowedFields        = [
		'titulo', 'nota', 'created', 'updated'
	];
	protected $createdField  = 'created';
	protected $updatedField  = 'updated';
}
