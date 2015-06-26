<?php
class ActividadPac extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'actividad_pac';
    protected $fillable = array('actividad','frecuencia','personal_id','tipoplan');


    public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'actividad_responsable','actividad_id','personal_id')
    ->withpivot("id","personal_admin_id","estado","tipoactividad","adjunto1","adjunto2","adjunto3","adjunto4","adjunto5",'fechaenvio')
    ->withTimestamps();
}




public function pac()
{
    return $this->belognsTo("Pac");
}



public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            
         
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