<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Alumno;

class CursoController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos-list',compact('cursos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin = $request->fecha_fin;
        $curso->save();
        return redirect()->action([CursoController::class, 'index']);
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
        $curso = Curso::find($id);
        return $curso;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function listarCursos($id){
        $alumno = Alumno::find($id);
        $cursos = Curso::all();
        return view('cursos-inscripcion', compact('cursos','alumno'));
    }

    public function inscribir(Request $request){
        DB::table('curso_alumno')->where('alumno_id',$request->alumno_id)->delete();
        if ($request->curso_id){
            foreach ($request->curso_id as $curso_id) {
                DB::table('curso_alumno')->insert(
                    ['curso_id' => $curso_id, 'alumno_id' => $request->alumno_id]
                );
            }
        }
        return redirect('alumnos/');
    }

    public function listarInscripciones($id){
        $inscripciones = DB::table('curso_alumno')
            ->where('alumno_id',$id)
            ->get();
        $json = json_encode($inscripciones);
        return  $json;  
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
        $curso = Curso::find($id);
        $curso->nombre = $request->nombre;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin = $request->fecha_fin;
        $curso->save();
        return redirect()->action([CursoController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->action([CursoController::class, 'index']);
    }
}
