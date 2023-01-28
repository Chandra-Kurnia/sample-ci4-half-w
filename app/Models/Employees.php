<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Employees extends Model{
    protected $table = 'employees';
    
    protected $allowedFields = [
        'nip',
        'name',
        'address',
        'phone_number',
        'email',
        'date_of_birth',
        'gender',
        'sallary',
        'created_at',
        'udpated_at',
    ];
}