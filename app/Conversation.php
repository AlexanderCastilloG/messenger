<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * Después de crear el descriptor de acceso, agregue el nombre del atributo a la propiedad appends 
     * en el modelo. Tenga en cuenta que los nombres de los atributos se mencionan normalmente en 
     * "caso de serpiente", aunque el descriptor de acceso se define usando "caso de camello":
     */
    protected $appends = ['contact_name'];

    /**
     * Anexar valores a JSON
     * Ocasionalmente, al convertir modelos a una matriz o JSON, es posible que desee agregar atributos 
     * que no tienen una columna correspondiente en su base de datos. Para hacerlo, primero defina un 
     * descriptor de acceso para el valor:
     */
    public function getContactNameAttribute(){
        // return $this->contact->name;
        return $this->contact()->first(['name'])->name;
    }

    public function contact() {
        // Conversation N  1 User (contact)
        return $this->belongsTo(User::class);
    }
}
