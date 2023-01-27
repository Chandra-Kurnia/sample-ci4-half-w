<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Users extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'username',
        'password',
        'role_id',
        'status',
        'is_update',
        'image',
        'created_at',
        'updated_at'
    ];
}