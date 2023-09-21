<?php

class Login extends Base
{
    protected $table = "users";
    public function login($user, $password)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE user = '$user' AND password = '$password' AND status = 1 LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_assoc() : false;
    }
    public function permisos($user){
        $response = $this->mysqli->query("SELECT p.id, p.modulo, p.permiso FROM permisos_usuarios pu INNER JOIN permiso p ON pu.permiso = p.id WHERE pu.usuario = $user");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
}