<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    //

    public function go_to_view(Request $request)
    {
        $user=Auth::user();
        return view('info.add', compact('user'));
    }



    public function store(Request $request, $id)
    {

        $customMessages = [
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.digits_between' => 'El teléfono debe tener exactamente 10 dígitos.',
            'fechaNacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fechaNacimiento.date' => 'Por favor, ingrese una fecha de nacimiento válida.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.unique' => 'Su cédula ya ha sido registrada.',
            'cedula.digits_between' => 'La cédula debe tener entre 10 y 13 dígitos.',
            'direccion.required' => 'El campo dirección es obligatorio.',
        ];

        $request->validate([
            'telefono' => 'required|digits_between:10,10',
            'fechaNacimiento' => 'required|date',
            'cedula' => 'required|digits_between:10,13|unique:infos,info->ci,except,id',
            'direccion' => 'required',
        ], $customMessages);

        // Obtén el usuario por su ID
        $user = User::findOrFail($id);

        $userData = [
            'phone' => $request->input('telefono'),
            'date' => $request->input('fechaNacimiento'),
            'ci' => $request->input('cedula'),
            'address' => $request->input('direccion'),
        ];

        // Crea la información asociada al usuario
        $info = Info::create([
            'info'=> json_encode($userData)
        ]);

        // Asigna la información al usuario
        $user->info()->associate($info);
        $user->save();

        return redirect()->route('voyager.dashboard');

    }


    public function edit($id){
        $user = User::find($id);
        return view('info.edit',compact('user'));
    }





    public function update(Request $request, $id)
    {
        // Validation rules similar to your 'store' method
        $request->validate([
            'telefono' => 'required|digits_between:10,10',
            'direccion' => 'required',
        ]);

        // Assuming a one-to-one relationship between User and Info
        $user = User::findOrFail($id);
        $info = $user->info;

        // Decode the existing JSON to an associative array
        $infoData = json_decode($info->info, true);

        // Update specific fields
        $infoData['phone'] = $request->input('telefono');
        $infoData['address'] = $request->input('direccion');

        // Encode the modified array back to JSON
        $info->update([
            'info' => json_encode($infoData),
        ]);

        return redirect()->route('voyager.dashboard')->with('success', 'Información actualizada exitosamente.');
    }




}
