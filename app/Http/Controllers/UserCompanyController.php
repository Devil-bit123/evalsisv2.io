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
        // Validar los datos si es necesario
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Obtener el usuario y la compañía
        $user = User::find($request->input('user_id'));
        $company = Company::find($request->input('company_id'));

        // Asociar el usuario a la compañía
        $user->companies()->attach($company);

    }


    public function removeUserFromCompany(Request $request, $userId, $companyId)
    {
        // Obtener el usuario y la compañía
        $user = User::find($userId);
        $company = Company::find($companyId);

        // Verificar si el usuario y la compañía existen
        if ($user && $company) {
            // Desasociar el usuario de la compañía
            $user->companies()->detach($company);

            // Puedes redirigir a donde sea necesario después de eliminar la asociación.
            return redirect()->route('info.view');
        } else {
            // Manejar el caso en el que el usuario o la compañía no existan
            // Puedes redirigir a una página de error o hacer algo más según tus necesidades.
            return redirect()->route('info.view');
        }
    }

}
