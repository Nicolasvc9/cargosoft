<?php

class User extends Base
{
  protected $table = "users";

  //   Obtener config
  public function statusUser($id, $status)
  {
    // Validar que el $status recibido sea "disabled" o "enabled"
    if ($status === "disabled" || $status === "enabled") {
      // Establecer el valor numérico correspondiente al $status
      $statusValue = ($status === "disabled") ? 0 : 1;

      // Preparar la consulta UPDATE con consultas preparadas
      $consulta = $this->mysqli->prepare("UPDATE users SET status = ? WHERE id = ?");
      $consulta->bind_param("ii", $statusValue, $id);

      // Ejecutar la consulta
      if ($consulta->execute()) {
        if ($consulta->affected_rows > 0) {
          return "El usuario con ID $id fue actualizado a estado '$status'.";
        } else {
          return "el ID $id. no fue modificado.";
        }
      } else {
        return "Error al ejecutar la consulta: " . $consulta->error;
      }

      $consulta->close();
    } else {
      return "El valor de 'status' debe ser 'disabled' o 'enabled'.";
    }
  }


  public function updatePermisos($permiso, $user, $activo)
  {
    $response = $this->mysqli->prepare("SELECT * FROM permisos_usuarios WHERE permiso = ? AND usuario = ?");
    $response->bind_param("ii", $permiso, $user);
    $response->execute();
    $resultado = $response->get_result();
    $permisoExistente = $resultado->fetch_assoc();
    if ($permisoExistente) {
      // El permiso existe para el usuario
      if ($activo == "true") {
        // No hacer nada, el permiso ya tiene el estado deseado
      } else {
        // Si el permiso está en el estado contrario al deseado, actualizarlo
        $consultaActualizar = $this->mysqli->prepare("DELETE FROM permisos_usuarios WHERE permiso = ? AND usuario = ?");
        $consultaActualizar->bind_param("ii", $permiso, $user);
        $consultaActualizar->execute();
        // Aquí puedes realizar otras acciones o mostrar un mensaje de éxito, si es necesario
      }
    } else {
      // El permiso no existe para el usuario
      if ($activo == "true") {
        // Si el permiso debe estar activo, insertarlo
        $consultaInsertar = $this->mysqli->prepare("INSERT INTO permisos_usuarios (id, permiso, usuario, status) VALUES (NULL, ?, ?, 1)");
        $consultaInsertar->bind_param("ii", $permiso, $user);
        $consultaInsertar->execute();
        // Aquí puedes realizar otras acciones o mostrar un mensaje de éxito, si es necesario
      } else {
        // No hacer nada, ya que el permiso no debe existir y debe estar inactivo
      }
    }

    return true;
  }
  public function checkUser($user)
  {
    $response = $this->mysqli->query("SELECT COUNT(*) as num FROM {$this->table} WHERE user = '$user'");
    return $response->num_rows > 0 ? $response->fetch_assoc() : false;
  }
  public function get()
  {
    $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY updated_at DESC");
    return $response->num_rows > 0 ? $response->fetch_all() : false;
  }
  public function getUsuario($user)
  {
    $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE id = $user ORDER BY updated_at DESC");
    return $response->num_rows > 0 ? $response->fetch_assoc() : false;
  }
  public function getPermisos($user)
  {
    $response = $this->mysqli->query("SELECT pu.id, p.id as idPermiso, p.modulo, p.permiso FROM permisos_usuarios pu INNER JOIN permiso p ON pu.permiso = p.id WHERE pu.usuario = $user");
    return $response->num_rows > 0 ? $response->fetch_all() : false;
  }
  public function getPermisosAll()
  {
    $response = $this->mysqli->query("SELECT * FROM permiso WHERE status = 1");
    return $response->num_rows > 0 ? $response->fetch_all() : false;
  }

  //   ALMACENAR
  public function set($username, $name, $password, $ciudad)
{
    $sql = "INSERT INTO {$this->table} (user, name, password, ciudad, last_updated_by) 
            VALUES (?, ?, ?, ?, 1)";

    $stmt = $this->mysqli->prepare($sql);
    
    if ($stmt) {
        // Enlazar parámetros
        $stmt->bind_param("sssi", $username, $name, $password, $ciudad);

        // Ejecutar la consulta
        $result = $stmt->execute();
        
        $stmt->close();

        return $result;
    } else {
        return false;
    }
}


  //   Actualizar informacion
  public function update($id, $nombre, $password, $ciudad)
  {
    if ($password != '') {
      $password = ", password = '{$password}'";
    }
    $sql = "UPDATE {$this->table} SET name = '{$nombre}' $password , ciudad = '{$ciudad}' WHERE id = $id";
    // return $sql;
    return $this->mysqli->query($sql);
  }

}
