<?php

namespace App\Controllers;

class CategoriasController extends BaseController
{

    public function nuevaCategoria()
    {

        $CategoriasModelo = new \App\Models\Categorias_modelo();

        $nombre = $this->request->getPost('nombreCategoriaNueva');

        $reglas = [
            'nombreCategoriaNueva' => [
                'label' => 'Nombre',
                'rules' => 'required|is_unique[categorias.nombre]|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'Ya existe una categoría con ese nombre.',
                    'min_length' => 'El campo {field} debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo {field} debe tener máximo 100 caracteres.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        }

        try {
            $CategoriasModelo->insert([
                'nombre' => $nombre
            ]);

            return redirect()->back()->with('success', 'Categoría creada correctamente');
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al crear la categoría.');
        }
    }
}
