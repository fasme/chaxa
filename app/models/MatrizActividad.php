<?php
class MatrizActividad extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'matriz_actividad';
    protected $fillable = array('nombre');



public function machasmatriz()
{
    return $this->belongsToMany("Matriz",'matriz_matriz_actividad','matriz_actividad_id','matriz_id');
}


public function muchasley()
{
    return $this->belongsToMany("MatrizLey",'matriz_matriz_actividad_ley','actividad_id','ley_id');
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