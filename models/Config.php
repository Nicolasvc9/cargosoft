<?php

class Config extends Base
{
  protected $table = "configs";
  
  //   Obtener cinfig
  public function get()
  {
    $response = $this->mysqli->query("SELECT * FROM {$this->table}");
    return $response->num_rows > 0 ? $response->fetch_all() : false;
  }
  public function getValuacion()
  {
    $response = $this->mysqli->query("SELECT attribute FROM {$this->table} WHERE config = 'valuacion'");
    return $response->num_rows > 0 ? $response->fetch_all() : false;
  }
  
  //   ALMACENAR
  public function set()
  {
    # code...
  }
  
  //   Actualizar informacion
  public function update($id, $value)
  {
    $sql = "UPDATE {$this->table} SET attribute = '{$value}' WHERE id = '{$id}'";
    // return $sql;
    return $this->mysqli->query($sql);
    
  }
}