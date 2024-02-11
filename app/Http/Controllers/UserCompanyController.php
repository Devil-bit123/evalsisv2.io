<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function index() {
        $users = User::all();
        $companies = Company::all();
        return view('vendor.voyager.user-company.browse', compact('users', 'companies'));
    }



    public function store(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            // Obtener el usuario y la compañía
            $user = User::findOrFail($request->input('user_id'));
            $company = Company::findOrFail($request->input('company_id'));

            // Verificar si el usuario ya está asociado a esta compañía
            if ($user->companies()->where('company_id', $company->id)->exists()) {
                // Si el usuario ya está asociado a esta compañía, enviar un mensaje de error
                return response()->json(['error' => 'El usuario ya está asociado a esta compañía.'], 400);
            }

            // Asociar el usuario a la compañía
            $user->companies()->attach($company);

            // Enviar mensaje de éxito
            return response()->json(['message' => 'Usuario asociado a la compañía correctamente.'], 200);
        } catch (\Exception $e) {
            // Enviar mensaje de error
            return response()->json(['error' => 'Error al asociar usuario a la compañía: ' . $e->getMessage()], 500);
        }
    }



    public function removeUserFromCompany(Request $request, $userId, $companyId)
    {
        try {
            // Obtener el usuario y la compañía
            $user = User::find($userId);
            $company = Company::find($companyId);

            // Verificar si el usuario y la compañía existen
            if ($user && $company) {
                // Verificar si el usuario está asociado a la compañía
                if ($user->companies()->where('company_id', $companyId)->exists()) {
                    // Desasociar el usuario de la compañía
                    $user->companies()->detach($company);
                    return response()->json(['message' => 'Usuario eliminado de la compañía correctamente.'], 200);
                } else {
                    return response()->json(['error' => 'El usuario no está asociado a esta compañía.'], 400);
                }
            } else {
                return response()->json(['error' => 'Usuario o compañía no encontrados.'], 404);
            }
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir
            return response()->json(['error' => 'Error al eliminar usuario de la compañía: ' . $e->getMessage()], 500);
        }
    }



}
