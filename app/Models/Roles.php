<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Roles extends Model{
    protected $table = 'roles';
    
    protected $allowedFields = [
        'role_name',
        'created_at',
        'updated_at'
    ];
}