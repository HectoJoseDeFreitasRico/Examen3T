<?php

    class HTDB{
        public function __construct($basededatos){
            $this->db = $basededatos;
            echo "La base de datos que se selecciono es ".$this->db."<br>";
        }
        public function peticion($consulta){
            echo "A continuacion vamos a procesar la siguiente consulta: ".$consulta."<br>";
        
            $primerapalabra = explode(" ",$consulta)[0];
            $segundapalabra = explode(" ",$consulta)[1];
            $tercerapalabra = explode(" ",$consulta)[2];
            echo "la primera palabra es: ".$primerapalabra."<br>";
            switch($primerapalabra){
                case "CREATE":
                    echo"Voy a crear algo<br>";
                    if($segundapalabra == "TABLE"){
                        $myfile = fopen("db/".$this->db."/".$tercerapalabra.".csv", "a") or die("Unable to open file!");
                        $text = $consulta;
                        preg_match('#\((.*?)\)#', $text, $match);
                        print $match[1];
                        $txt = $match[1];
                        $campos = explode(",",$txt);
                        $cadenacampos = "";
                        for($i =0;$i<count($campos);$i++){
                            $cadenacampos .= '"'.$campos[$i].'",';
                        }
                        $recortado = substr($cadenacampos, 0, -1);
                        fwrite($myfile, $recortado."\n");
                        
                        fclose($myfile);
                        
                    }
                    break;
                case "INSERT":
                    $tabla = explode(" ",$consulta)[2];
                    $myfile = fopen("db/".$this->db."/".$tabla.".csv","a") or die("Unable to open file!");
                    $text = $consulta;
                    preg_match('#\((.*?)\)#', $text, $match);
                        print $match[1];
                        $txt = $match[1];
                    fwrite($myfile, $txt."\n");
                    break;
                case "SELECT":
                $piezas = explode(" ",$consulta);
                foreach( $piezas as $key => $value )
                {
                    if($piezas[$key] == 'FROM' )
                    {
                        $tabla = $piezas[$key+1];
                        break;
                    }
                }
                echo "La tabla es: ".$tabla."<br>";
                $array = [];
                $contador = 0;
                // Verificar si la consulta contiene ORDER BY y ASC
                if (in_array("ORDER", $piezas) && in_array("ASC", $piezas)) {
                    $posicion_order_by = array_search("ORDER", $piezas);
                    $posicion_asc = array_search("ASC", $piezas);
                    if ($posicion_asc == $posicion_order_by + 2) {
                        // La consulta contiene ORDER BY y ASC, agregar la cláusula ORDER BY aquí
                        $consulta .= " ORDER BY nombre ASC";
                    }
                }
                $file = fopen("db/".$this->db."/".$tabla.".csv", 'r');
                $line = fgetcsv($file);
                $nombrescampo = $line;

                $file = fopen("db/".$this->db."/".$tabla.".csv", 'r');
                while (($line = fgetcsv($file)) !== FALSE) {
                    echo "<br>";

                    $array[$contador] = $line;
                    for($i = 0;$i<count($line);$i++){
                        $array[$contador][$nombrescampo[$i]] = $line[$i];
                    }
                    $contador++;

                }
                fclose($file);
                return $array;
                break;

                case "DELETE":
                        $piezas = explode(" ",$consulta);
                    foreach( $piezas as $key => $value )
                        {
                        if($piezas[$key] == 'FROM' )
                            {
                                $tabla = $piezas[$key+1];
                                break;
                            }
                        }
                    foreach( $piezas as $key => $value )
                        {
                            if($piezas[$key] == 'WHERE' )
                            {
                                $campo = $piezas[$key+1];
                                $valor = str_replace("'","",$piezas[$key+3]);
                                break;
                            }
                        }
                    echo "De la tabla ".$tabla." voy a borrar el campo".$campo." cuyo valor sea ".$valor."<br>";
                    
                    $array = [];
                    $contador = 0;
                    $file = fopen("db/".$this->db."/".$tabla.".csv", 'r');
                    $line = fgetcsv($file);
                    $nombrescampo = $line;
                    $file = fopen("db/".$this->db."/".$tabla.".csv", 'r');
                    $file2 = fopen("db/".$this->db."/".$tabla."2.csv", 'w');
                    while (($line = fgetcsv($file)) !== FALSE) {
                        echo "<br>";
                        $borra = "no";                    
                        $array[$contador] = $line;

                        for($i = 0;$i<count($line);$i++){
                            $array[$contador][$nombrescampo[$i]] = $line[$i];
                            if($nombrescampo[$i] == $campo &&  $line[$i] == $valor){
                                echo "He encontrado una coincidencia";
                            }else{

                            }
                        }

                        $contador++;
                        if($borra == "si"){
                            echo "He encontrado una coincidencia";
                        }else{
                            echo "No he encontrado una coincidencia";
                            foreach($line as $a){
                                fwrite($file2, '"'.$a.'",');
                        }
                        fwrite($file2,PHP_EOL);
                        }
                        
                    }
                   fclose($file);
                    fclose($file2);
                   
                    unlink("db/".$this->db."/".$tabla.".csv");
                    rename("db/".$this->db."/".$tabla."2.csv", "db/".$this->db."/".$tabla.".csv");
                    
                    break;
            }
        }
    }
?>