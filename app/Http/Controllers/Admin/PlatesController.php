<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Plate;

class PlatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plates = Plate::where('user_id', Auth::user()->id)->paginate(6);
        return view('admin.plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|min:10|max:200',
            'price' => 'required',
            'visible' => 'required',
            'cover' => 'required|image'
        ], [
            'required' => 'Questo campo è obbligatorio',
            'max' => 'Massimo :max caratteri',
            'min' => 'Minimo :min caratteri',
            'image' => 'Penso che sai distinguere le immagini da altri tipi di file... Riprova!'
        ]);
        $data = $request->all();
        if (array_key_exists('cover', $data)) {
            $img_path = Storage::put('uploads', $data['cover']);
            $data['image'] = $img_path;
        }

        // we insert this check cause we have set that the image can be NULL
        // if(array_key_exists('image',$DatasPost)){
        //         $img_path = Storage::put('uploads',$DatasPost['image']);
        //         $DatasPost['cover'] = $img_path;
        // }

        $newPlate = new Plate();

        $img_path = Storage::put('uploads', $data['cover']);

        $newPlate->image = $img_path;

        $newPlate->user_id = Auth::user()->id;

        $newPlate->fill($data);

        $newPlate->save();

        return redirect()->route('admin.plates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plate $plate)
    {
        // Questo pezzo di codice ci servirà come ulteriore controllo per gli utenti
        if ($plate->user_id != Auth::user()->id) {
            return view('layouts.notFound');
        } else {
            return view('admin.plates.edit', compact('plate'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|min:10|max:200',
            'price' => 'required',
            'visible' => 'required',
            'image' => 'nullable|image'
        ], [
            'required' => 'Questo campo è obbligatorio',
            'max' => 'Massimo :max caratteri',
            'min' => 'Minimo :min caratteri',
            'image' => 'Penso che sai distinguere le immagini da altri tipi di file... Riprova!'
        ]);
        $data = $request->all();
        if (array_key_exists('cover', $data)) {
            $img_path = Storage::put('uploads', $data['cover']);
            $data['image'] = $img_path;
        }

        $plate = Plate::find($id);


        $plate->fill($data);


        $plate->update();

        return redirect()->route('admin.plates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plate $plate)
    {
        if ($plate) {



            if ($plate->image) {
                Storage::delete($plate->cover);
            }

            $plate->delete();
        }
        return redirect()->route('admin.plates.index');
    }
}
