<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model{
    protected $table = "admin";
    protected $primaryKey = "admin_id";
    protected $field = ["name", "password"];
    protected $allowedFields = ["name", "password"];

    public function getAdmins(){
        return $this->findAll();
    }

    public function getAdminByName($name){
        $admin = $this->where("name", $name)->findAll();

        if(empty($admin)){
            return null;
        }

        return $admin[0];
    }
}

?>