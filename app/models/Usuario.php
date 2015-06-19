<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuario';
    protected $fillable = array('username','password','nombre','apellido','tipousuario'); // los campos de la tabla



    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'username' => 'required',
            'nombre'     => 'required',
            'apellido' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }


    //funcion para el editar usuario, de esta forma la contraseña no es enviada
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }


    
 protected $hidden = array('password', 'remember_token');
 
public function getAuthIdentifier()
{
    return $this->getKey();
}

/**
 * Get the password for the user.
 *
 * @return string
 */
public function getAuthPassword()
{
    return $this->password;
}

/**
 * Get the e-mail address where password reminders are sent.
 *
 * @return string
 */
public function getReminderEmail()
{
    return $this->email;
}

public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}
  

}
?>