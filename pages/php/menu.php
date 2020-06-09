<?php 

function cargarMenuBd() {
    
    try {
        include '../php_util/conexion.php';
        $conexion = mConectar();
        if ($conexion==null ) 
            exit;
             
        //$conexion->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);
        $result = $conexion->query(" select mn.nombre_pagina,
                                      mn.logo,
                                      mn.etiqueta,
                                      mn.contenido,                                      
                                      mn.id_menu,
                                      mn.id_menu_padre,
                                      mn.es_menu
                              	      from menu mn
                              	      inner join menu_x_rol mnr on mn.id_menu = mnr.id_menu
                              	      where id_empresa= ".$_SESSION['idempresa']."
                              	      and mnr.id_rol =  ".$_SESSION['idrol']."
                              	      and mn.estado = '1'
                                      and mn.id_menu !=0
                              	      order by orden") or die("Problemas en el select:".$conexion->error);        
        //$conexion->commit();
        
        // error en consulta ejecutada
        if(!$result){
            echo "Error: La ejecución de la consulta falló debido a: \n";
            //echo "Query: " . $sql . "\n";
            echo "Errno: " . $conexion->errno . "\n";
            echo "Error: " . $conexion->error . "\n";
            exit;
        }
        
        // no obtuvo resultado en la consulta
        if ($result->num_rows === 0) {
            echo "Lo sentimos. No se pudo encontrar una coincidencia para la consulta realizada. Inténtelo de nuevo.";
            exit;
        }
        
        while($row = $result->fetch_assoc())
        {
            $vectormenu[] = array(  'nombre_pagina'=> $row['nombre_pagina'],
                                    'logo'=> $row['logo'],
                                    'etiqueta'=> $row['etiqueta'],                
                                    'id_menu'=> $row['id_menu'],
                                    'id_menu_padre'=> $row['id_menu_padre'],
                                    'es_menu'=> $row['es_menu']
            );
        }
        $_SESSION['$vectormenu'] =$vectormenu;
        cargarMenuSesion($vectormenu);
    } catch (Exception $e) {
        //$conexion->rollback();
    }
    finally {
        mDesconectar($conexion);
    }    
}/*cargarMenu*/

function cargarMenuSesion($arregloMenu) { 
    
    $ArregloTmp = $arregloMenu;
    foreach ($arregloMenu as $item )
    {
        if($item['id_menu_padre']==0 && $item['es_menu'] == 'S')
        {   echo "<li>";
            echo "<a href=\"". $item['nombre_pagina']. "\">";
            echo "<i class=\"". $item['logo']. "\"></i>";
            echo $item['etiqueta'];
            echo "</a>";
            echo "</li>";
        }
        else {
            
            if($item['id_menu_padre']==0 && $item['es_menu'] == 'N')
            {   echo "<li>";
                echo "<a href=\"#pageSubmenu\" data-toggle=\"collapse\" aria-expanded=\"false\" class=\"dropdown-toggle\">";
                echo "<i class=\"". $item['logo']. "\"></i>";
                echo $item['etiqueta'];            
                echo "</a>";
                echo "<ul class=\"collapse list-unstyled\" id=\"pageSubmenu\">";
                cargarOpcionSubMenu($ArregloTmp, $item['id_menu']);
                echo "</ul>";
                echo "</li>";
            }
        }                
    }        
}/*menuCargadoSesion*/


function cargarOpcionSubMenu($ArregloTmp, $id_menuTmp) 
{   
    foreach ($ArregloTmp as $item )
    {
        if($item['id_menu_padre'] == $id_menuTmp)
        {
            echo "<li>";
            echo "<a href=\"". $item['nombre_pagina']. "\">";
            echo "<i class=\"". $item['logo']. "\"></i>";
            echo $item['etiqueta'];
            echo "</a>";
            echo "</li>";
        } 
    }

}/*cargarOpcionSubMenu*/

?>

<!-- Sidebar  -->
<nav id="sidebar" >
    <div class="sidebar-header">
        <h3>Control Restaurante</h3>
        <strong>CR</strong>
    </div>
    <ul class="list-unstyled components">            
        <?php            
            if(!isset($_SESSION['$vectormenu']))
                cargarMenuBd();
            else
                cargarMenuSesion($_SESSION['$vectormenu']);            
        ?>             
    </ul>       
</nav>