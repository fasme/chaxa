<?php
class Ley extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'matriz_ley';
    protected $fillable = array('nombre','articulo','descripcion');




public function muchasactividad()
{
    return $this->belongsToMany("MatrizActividad",'matriz_matriz_actividad_ley','ley_id','actividad_id');
}


public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
          //  'cliente_id'     => 'exists:cliente,id',
          //  "guiavalue" => "required",
            
         
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }





}
?>