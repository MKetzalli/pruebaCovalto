<?php

namespace App\Models;

use CodeIgniter\Model;

class CocktailsModel extends Model
{
    protected $table = 'cocktails';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    //campos de la tabla
    protected $allowedFields = ['idDrink', 'strDrink', 'strCategory', 'strAlcoholic', 'strGlass', 'strInstructions'];

    protected bool $allowEmptyInserts = false;


}
