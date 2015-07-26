<?php
class KpiController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $kpis = Kpi::all();
        $kpiobjetivos = Kpiobjetivo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('kpi.show')->with("kpis",$kpis)
        ->with("kpiobjetivos",$kpiobjetivos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $kpi = new Kpi; 
        $personals = Personal::lists("nombre","id");
        $kpiobjetivos = Kpiobjetivo::lists("nombre","id");

        return View::make('kpi.formulario')
        ->with("kpi",$kpi)
        ->with("personals",$personals)
        ->with("kpiobjetivos",$kpiobjetivos);
     
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $kpi = new Kpi;

        $datos = Input::all(); 

        
        if ($kpi->isValid($datos))
        {
            
            $kpi->fill($datos);


         
           $kpi->save();

           $kpi = Kpi::find($kpi->id);


           for($i=0; $i<count($datos["selectpac"]); $i++)
        {

            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $kpi->muchaspersonal()->attach($datos["selectpac"][$i],array("frecuencia"=>$frecuencia, "actividad"=>$datos["actividad"][$i],"personal_admin_id"=>Auth::user()->id,"estado"=>"Abierta"));
            
            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();
            //$kpi->muchaspersonal()->attach($datos["selectpac"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"kpi"));

            //return $kpi->id;
            /*
            $kpiactividad = new ActividadKpi;
            $kpiactividad->actividad = $datos["actividad"][$i];
            $kpiactividad->personal_id = $datos["selectpac"][$i];
           

            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $kpiactividad->frecuencia = "$ano-$mes-$dia";



            $kpi->actividadKpi()->save($kpiactividad);

            $kpiactividad = ActividadKpi::find($kpiactividad->id);
            $kpiactividad->muchaspersonal()->attach($datos["selectpac"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"kpi"));

            
            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();
            //echo $datos["selectpac"][$i]." ".$datos["actividad"][$i]."<br>";
            */
        }

         
           
          
            return Redirect::to('kpi')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('kpi/insert')->withInput()->withErrors($kpi->errors);
            //return "mal2";
        }
     //   return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $kpi = Kpi::find($id);
           $personals = Personal::lists("nombre","id");
            $kpiobjetivos = Kpiobjetivo::lists("nombre","id");
         
        return View::make('kpi.formulario')
        ->with("kpi",$kpi)
        ->with("personals",$personals)
        ->with("kpiobjetivos",$kpiobjetivos);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $kpi = Kpi::find($id);



        $datos = Input::all(); 



        
        if ($kpi->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $kpi->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

            $kpi->muchaspersonal()->detach();
            for($i=0; $i<count($datos["selectpac"]); $i++)
        {
          
           

            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $kpi->muchaspersonal()->attach($datos["selectpac"][$i],array("frecuencia"=>$frecuencia, "actividad"=>$datos["actividad"][$i],"personal_admin_id"=>Auth::user()->id,"estado"=>"Abierta"));
            
            //$kpi->muchaspersonal()->attach($datos["selectpac"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"kpi"));

            //return $kpi->id;
            /*
            $kpiactividad = new ActividadKpi;
            $kpiactividad->actividad = $datos["actividad"][$i];
            $kpiactividad->personal_id = $datos["selectpac"][$i];
           

            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $kpiactividad->frecuencia = "$ano-$mes-$dia";



            $kpi->actividadKpi()->save($kpiactividad);

            $kpiactividad = ActividadKpi::find($kpiactividad->id);
            $kpiactividad->muchaspersonal()->attach($datos["selectpac"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"kpi"));

            
            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();
            //echo $datos["selectpac"][$i]." ".$datos["actividad"][$i]."<br>";
            */
        
        }
        


            
           $kpi->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('kpi')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('kpi/update/'.$id)->withInput()->withErrors($kpi->errors);
            //return "mal2";
        }

        return Redirect::to('kpi')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $kpi = Kpi::find($id);

        $kpi->delete();

    //return Redirect::to('usuarios/insert');
    }




    public function mostrar() //get
    {
        //echo $id;
     
 $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
           $kpi = Kpi::find($id);
           $personals = Personal::lists("nombre","id");
            $kpiobjetivos = Kpiobjetivo::lists("nombre","id");
         
        return View::make('kpi.mostrar')
        ->with("kpi",$kpi)
        ->with("personals",$personals)
        ->with("kpiobjetivos",$kpiobjetivos);
 
                
 
      
    }
 






}



?>