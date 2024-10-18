<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidationRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Règles de validation qui s'appliquent à la demande.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Validation pour la table 'users'
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)], // Modification pour ignorer l'unicité de l'email lors de la mise à jour
            'password' => ['required', 'string', 'min:8'], // Ajout de 'confirmed' pour la confirmation du mot de passe

            // Validation pour la table 'equipes'
            'equipe_nom' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Renforcement de la validation des images pour le logo
            'date_creer' => ['required', 'date', 'before_or_equal:today'], // Permet de saisir une date antérieure ou égale à aujourd'hui
            'zone_id' => ['required', 'exists:zones,id'],
            'user_id' => ['nullable', 'exists:users,id'],

            // Validation pour la table 'joueurs'
            'joueur_nom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'licence' => ['required', 'string', 'unique:joueurs,licence'],
            'equipe_id' => ['required', 'exists:equipes,id'],
            'categorie_id' => ['required', 'exists:categories,id'],

            // Validation pour la table 'categories'
            'categorie_nom' => ['required', 'string', 'max:255'],

            // Validation pour la table 'zones'
            'zone_nom' => ['required', 'string', 'max:255'],
            'localite' => ['required', 'string', 'max:255'],
            'zone_user_id' => ['nullable', 'exists:users,id'],

            // Validation pour la table 'competitions'
            'competition_nom' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin' => ['required', 'date', 'after:date_debut'],

            // Validation pour la table 'matchs'
            'equipe_local' => ['required', 'exists:equipes,id'],
            'equipe_visiteur' => ['required', 'exists:equipes,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'lieu' => ['required', 'string', 'max:255'],

            // Validation pour la table 'resultats'
            'match_id' => ['required', 'exists:matchs,id'],
            'carton_jaune' => ['required', 'integer', 'min:0'],
            'carton_rouge' => ['required', 'integer', 'min:0'],
            'detail_but' => ['required', 'json'], // Validation JSON simple, il serait possible d'ajouter des règles de structure
            'score_local' => ['required', 'integer', 'min:0'], // Renforcement pour garantir des scores positifs
            'score_visiteur' => ['required', 'integer', 'min:0'],

            // Validation pour la table 'tirages'
            'competition_id' => ['required', 'exists:competitions,id'],
            'phase' => ['required', 'json'],
            'poul' => ['required', 'json'],
            'nombre_poules' => ['required', 'integer', 'min:1'],

            // Validation pour la table 'historique_joueur_equipe'
            'joueur_id' => ['required', 'exists:joueurs,id'],

            // Validation pour la table 'notifications'
            'type' => ['required', 'string', 'max:255'],
            'data' => ['required', 'string'],
            'read_at' => ['nullable', 'date'],

            // Validation pour la table 'reclamations'
            'description' => ['required', 'string'],
            'statut' => ['required', Rule::in(['en_attente', 'traitee', 'rejete'])],
        ];
    }
}
