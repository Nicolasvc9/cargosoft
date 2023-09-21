<?php

class Guia extends Base
{
    protected $table = "guides";

    public function getCiudad($id){
        $query = "SELECT city FROM cities WHERE id = '$id'"; 
        // return $query;
        $response = $this->mysqli->query($query);
        return $response->num_rows > 0 ? $response->fetch_assoc() : false;
    }
    public function getRemitente($id){
        $query = "SELECT * FROM clients WHERE id = '$id'"; 
        // return $query;
        $response = $this->mysqli->query($query);
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }
    public function getGuiaPrint($guia){
        $query = "SELECT * FROM guides WHERE guia = '$guia'"; 
        // return $query;
        $response = $this->mysqli->query($query);
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }
    public function setGuia($guia, $guiac,$remitente, $destinatario, $origen, $destino, $ruta, $comercial, $contenido, $observaciones, $producto, $piezas, $kg, $vol, $kg_vol, $flete, $declarado, $seguro,$tarifaCombustible,$valuacion, $vseguro, $venvio, $valorCombustible, $total, $actualizado, $contrapago, $formadepago, $status, $adicionales)   {
        $query = "UPDATE {$this->table}
        SET guia = '$guiac',
            id_remitente = '$remitente',
            id_destinatario = '$destinatario',
            id_origin_city = '$origen',
            id_destino_city = '$destino',
            ruta = '$ruta',
            commercial = '$comercial',
            content = '$contenido',
            observations = '$observaciones',
            product = '$producto',
            parts = '$piezas',
            kg = '$kg',
            vol = '$vol',
            kg_vol = '$kg_vol',
            flete = '$flete',
            valor_declarado = '$declarado',
            seguro = '$seguro',
            valor_seguro = '$vseguro',
            valor_envio = '$venvio',
            tarifa_combustible = '$tarifaCombustible',
            valuacion = '$valuacion',
            valor_combustible = '$valorCombustible',
            total = '$total',
            last_update_by = '$actualizado',
            counterpayment = '$contrapago',
            way_to_pay = '$formadepago',
            adicionales = '$adicionales',
            status = '$status'
        WHERE guide = $guia;
        ";
        // return $query;
        $this->mysqli->query($query);
        return $guia;
    }
    public function setParcial($guia, $guiac, $comercial, $contenido, $destinatario, $destino, $observaciones, $origen, $piezas, $producto, $remitente, $ruta, $kg = 0, $vol = 0, $adi = null)   {
        $query = "INSERT INTO {$this->table} (guide, guia, commercial, content, id_destinatario, id_destino_city, observations, id_origin_city, parts, product, id_remitente, ruta, kg, vol, adicionales) VALUES ('$guia','$guiac', '$comercial', '$contenido', '$destinatario', '$destino', '$observaciones', '$origen', '$piezas', '$producto', '$remitente', '$ruta', '$kg', '$vol', '$adi')";
        // return $query;
        $response = $this->mysqli->query($query);
        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    public function getDetaladoLicad($licad)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY guide");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getGuides()
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY guide");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getGuiasPalletListar($pallet)
    {
        // return $ruta ." - ". $tipo ." - ". $desde ." - ". $hasta;
        $response = $this->mysqli->query("SELECT g.id, g.guia,g.kg, c.business_name FROM guides g
        INNER JOIN clients c ON g.id_remitente = c.id WHERE g.pallet = $pallet");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function deleteGuiaPallet($guia)
    {
        // return $ruta ." - ". $tipo ." - ". $desde ." - ". $hasta;
        $response = $this->mysqli->query("UPDATE guides SET pallet = 0 WHERE id = $guia");
        return $guia;
    }
    public function getGuiaPallet($ruta,$tipo,$desde,$hasta)
    {
        // return $ruta ." - ". $tipo ." - ". $desde ." - ". $hasta;
        $response = $this->mysqli->query("SELECT g.id, g.guia,g.kg, c.business_name FROM guides g
        INNER JOIN clients c ON g.id_remitente = c.id WHERE ruta = $ruta AND commercial = $tipo AND create_at BETWEEN '$desde' AND '$hasta' AND pallet = 0");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getGuide($guia)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE guia = {$guia} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }
    public function getGuiaRes($guia)
    {
        $response = $this->mysqli->query("SELECT g.guia, g.content, ci.city, g.parts, g.kg_vol as kg,
        c.document as rem_documento, c.business_name as rem_nombre , c.direction as rem_direccion,
        cc.document as des_documento , cc.business_name as des_nombre, cc.direction as des_direccion
        FROM {$this->table} g
        INNER JOIN cities ci ON g.id_destino_city = ci.id
        INNER JOIN clients c ON c.id = g.id_remitente
        INNER JOIN clients cc ON cc.id = g.id_destinatario
        WHERE g.guia = '{$guia}'");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }
// 
    public function set($guide, $remitente, $destinatario, $origen,$destino, $commercial,$contenido,$observaciones, $flete, $declarado,$seguro,$vseguro,$venvio, $factura, $licad, $iduser,$contrapago, $formadepago )
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (id, guide, id_client, id_remitent, id_origin_city, id_destino_city, commercial, content, observations, flete, valor_declarado, seguro, valor_seguro, valor_envio, bill, licad, last_update_by, counterpayment, way_to_pay) VALUES ('{$guide}' , '{$remitente}' , '{$destinatario}' , '{$origen}' ,'{$destino}' , '{$commercial}' ,'{$contenido}' ,'{$observaciones}' , '{$flete}' , '{$declarado}' ,'{$seguro}' ,'{$vseguro}' ,'{$venvio}' , '{$factura}' , '{$licad}' , '{$iduser}' ,'{$contrapago}' , '{$formadepago}')");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    
}
