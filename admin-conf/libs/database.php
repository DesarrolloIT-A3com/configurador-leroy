<?php

class Database{
	
    /**
     * Devuelve una instancia de la conexión a la base de datos
     * @return type
     */
    function connectDB(){
        
        $conexion = mysqli_connect(SERVER, USER, PASS, DB);
        if($conexion){
        }else{
               echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>';
        }
        mysqli_query ($conexion,"SET NAMES 'utf8'");
        mysqli_set_charset($conexion, "utf8");
        return $conexion;
    }
	
    /**
     * Desconecta la base de datos a partir de la instancia que le pasamos
     * @param type $conexion
     * @return type
     */
    function disconnectDB($conexion){
       $close = mysqli_close($conexion);
                if($close){
                }else{
                    echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
                }   
        return $close;
    }
	
	/**
     * Obtenemos un valor a partir de una sentencia SQL de entrada
     * @param type $sql
     * @return type
     */
    function getVar($sql){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die(mysqli_error($conexion));
      
		//guardamos en un array todos los datos de la consulta (una fila)
        $row = mysqli_fetch_array($result);
		
        $this->disconnectDB($conexion);
        
		//devolvemos solo el primer valor
		return $row[0];
    }
	
	/**
     * Obtenemos un array a partir de una sentencia SQL de entrada
     * @param type $sql
     * @return type
     */
    function getRow($sql){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die(mysqli_error($conexion));
        
		//guardamos en un array todos los datos de la consulta (una fila)
		$row = mysqli_fetch_array($result);

        $this->disconnectDB($conexion);
		
		//devolvemos el array
        return $row;
    }
	
    /**
     * Obtenemos un array multidimensional a partir de una sentencia SQL de entrada
     * @param type $sql
     * @return type
     */
    function getResults($sql){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die(mysqli_error($conexion));
        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
        while($row = mysqli_fetch_array($result))
        {
            $rawdata[$i] = $row;
            $i++;
        }
        $this->disconnectDB($conexion);
		
		//devolvemos el array completo
        return $rawdata;
    }
	
	/**
     * Insertamos valores en la base de datos
     * @param type $tabla
	 * @param type $campos
	 * @param type $valores
     * @return type
     */
    function insert($tabla, $campos, $valores){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
		$sql = "INSERT INTO ". $tabla ." (". $campos .") VALUES (". $valores .");";
		
        $result = mysqli_query($conexion, $sql);
		
		if($result)
			$result = mysqli_insert_id($conexion);
		
        $this->disconnectDB($conexion);
		
		//devolvemos el array completo
        return $result;
    }

	/**
     * Modificamos valores en la base de datos
     * @param type $tabla
	 * @param type $campos
	 * @param type $where
     * @return type
     */
    function update($tabla, $campos, $where){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
		$sql = "UPDATE ". $tabla ." SET ". $campos ." WHERE ". $where .";";
		
        $result = mysqli_query($conexion, $sql);
		
        $this->disconnectDB($conexion);
		
		//devolvemos el array completo
        return $result;
    }	
	
	/**
     * Borramos valores en la base de datos
     * @param type $tabla
	 * @param type $where
     * @return type
     */
    function delete($tabla, $where){
        //Creamos la conexión
        $conexion = $this->connectDB();
        //generamos la consulta
		$sql = "DELETE FROM ". $tabla ." WHERE ". $where .";";
		
        $result = mysqli_query($conexion, $sql);
		
        $this->disconnectDB($conexion);
		
		//devolvemos el array completo
        return $result;
    }	

}

?>