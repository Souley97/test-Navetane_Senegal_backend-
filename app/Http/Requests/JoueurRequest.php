<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoueurRequest extends FormRequest
{
    public function rules(): array
    {
        return [
 
            'nom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'licence' => ['required', 'string', 'unique:joueurs,licence'],
            'equipe_id' => ['required', 'exists:equipes,id'],
            'categorie_id' => ['required', 'exists:categories,id'],
          
        ];
    }
}
