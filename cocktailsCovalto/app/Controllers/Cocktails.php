<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;
use App\Models\CocktailsModel;

class Cocktails extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //se aplicaron elementos de paginacion
        $cocktailsModel = new CocktailsModel();
        $data['cocktails'] = $cocktailsModel->paginate(10);
        $data['pager'] = $cocktailsModel->pager;
        return view('cocktails/index', $data);

    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('cocktails/new');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //validaciones para que los datos tengan determinadas caracteristicas
        $valid = [
            'idDrink' => 'max_length[5]',
            'strDrink' => 'required',
            'strCategory' => 'required',
            'strAlcoholic' => 'required',
            'strGlass' => 'required',
            'strInstructions' => 'required',
        ];
        //en caso de error regresa con los valores ingresados
        if (!$this->validate($valid)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        //si no entraron al if anterior es por que todo esta bien y podemos mandarlo a la tabla de la bd
        $post = $this->request->getPost(['idDrink', 'strDrink', 'strCategory', 'strAlcoholic', 'strGlass', 'strInstructions']);
        $cocktailsModel = new CocktailsModel();
        $cocktailsModel->insert([
            // 'idDrink'=>$post['idDrink'],
            'strDrink' => $post['strDrink'],
            'strCategory' => $post['strCategory'],
            'strAlcoholic' => $post['strAlcoholic'],
            'strGlass' => $post['strGlass'],
            'strInstructions' => $post['strInstructions'],
        ]);
        return redirect()->to('cocktails');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->route('cocktails');
        }
        $cocktailsModel = new CocktailsModel();
        $data['cocktails'] = $cocktailsModel->find($id);
        return view('cocktails/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //validaciones para que los datos tengan determinadas caracteristicas
        $valid = [
            'idDrink' => 'max_length[5]',
            'strDrink' => 'required',
            'strCategory' => 'required',
            'strAlcoholic' => 'required',
            'strGlass' => 'required',
            'strInstructions' => 'required',
        ];
        //en caso de error regresa con los valores ingresados
        if (!$this->validate($valid)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        //si no entraron al if anterior es por que todo esta bien y podemos mandarlo a la tabla de la bd
        $post = $this->request->getPost(['idDrink', 'strDrink', 'strCategory', 'strAlcoholic', 'strGlass', 'strInstructions']);
        $cocktailsModel = new CocktailsModel();
        $cocktailsModel->update($id, [
            // 'idDrink'=>$post['idDrink'],
            'strDrink' => $post['strDrink'],
            'strCategory' => $post['strCategory'],
            'strAlcoholic' => $post['strAlcoholic'],
            'strGlass' => $post['strGlass'],
            'strInstructions' => $post['strInstructions'],
        ]);
        return redirect()->to('cocktails');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */

    //eliminar registros
    public function delete($id = null)
    {
        if (!$this->request->is('delete') || $id == null) {
            return redirect()->route('cocktails');
        }

        $cocktailsModel = new CocktailsModel();
        $cocktailsModel->delete($id);

        return redirect()->to('cocktails');
    }


// obtener los valorees desde la api
    public function importFromApi()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'https://www.thecocktaildb.com/api/json/v1/1/search.php?f=a');
        if ($response->getStatusCode() === 200) {
            $cocktailsData = json_decode($response->getBody(), true);
            $cocktailsModel = new CocktailsModel();
            foreach ($cocktailsData['drinks'] as $cocktail) {
                $cocktailsModel->insert([
                    'idDrink' => $cocktail['idDrink'],
                    'strDrink' => $cocktail['strDrink'],
                    'strCategory' => $cocktail['strCategory'],
                    'strAlcoholic' => $cocktail['strAlcoholic'],
                    'strGlass' => $cocktail['strGlass'],
                    'strInstructions' => $cocktail['strInstructions'],
                ]);
            }

            return redirect()->to('cocktails');
        } else {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
    }

}
