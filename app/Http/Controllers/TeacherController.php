<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
Use Alert;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers= Teacher::latest()->paginate(10);;

        return view('pages.teacher.index',compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $this->validate($request,[
            'first_name' => 'required|min:2',
            'last_name' => 'nullable|min:3',
            'email' => 'required|email|unique:users',
            'gender'=>'required',
            'mobile'=>'required|digits:10',
            'profile_image'=> 'required|image|mimes:jpg,png,jpeg,gif,svg|max:3048'
        ]);
        $image='';
        if($request->hasFile('profile_image')){
            $location= '/uploads/teacher/';
            $file= $request->profile_image;
            $image= $this->image_upload($file,$location);
        }

        $student=Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ,
            'gender'=>$request->gender,
            'mobile'=>$request->mobile,
            'profile_image'=> $image,
        ]);
        if(!$student){
            Alert::toast('Something went wrong ..!', 'error');
            return back();
        }
        Alert::toast('Teacher create successfully.', 'success');
        return redirect()->route('teacher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id= Crypt::decrypt($id);
        $students= Student::where('teacher_id',$id)->get();
        return view('pages.student.teacher',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher= Teacher::find(Crypt::decrypt($id));
        return view('pages.teacher.edit',compact('teacher'));
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
        $date= $this->validate($request,[
            'first_name' => 'required|min:2',
            'last_name' => 'nullable|min:3',
            'email' => 'required|email|unique:users' ,
            'gender'=>'required',
            'mobile' =>'required|digits:10',
            'profile_image'=>'nullable'
        ]);
        $student= Teacher::find(Crypt::decrypt($id));
        if($request->hasFile('profile_image')){
            $location= '/uploads/teacher/';
             $this->image_delete($student->profile_image,$location);
            $image= $this->image_upload($request->profile_image,$location);
        }else{
            $image = $student->profile_image;
        }
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ,
            'gender'=>$request->gender,
            'mobile'=>$request->mobile,
            'profile_image'=> $image,
        ]);
        Alert::toast('Teacher updated successfully.', 'success');
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id= Crypt::decrypt($id);

        $data= Teacher::find($id);
        $data->delete();
        Alert::toast('Teacher deleted successfully.', 'success');
        return redirect()->route('teacher.index');
    }

    private function image_upload($file, $location)
    {
        $name = rand(10,99999).time().'.'.$file->extension();
        $file->move(public_path().$location, $name);
        return $name;
    }

    private function image_delete($file,$location){
        unlink(public_path().$location.$file);
    }
}
