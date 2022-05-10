<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
Use Alert;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students= Student::latest()->paginate(10);
        return view('pages.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers= Teacher::all();
        return view('pages.student.create',compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $date= $this->validate($request,[
            'first_name' => 'required|min:2',
            'last_name' => 'nullable|min:3',
            'email' => 'required|email|unique:users,email' ,
             'dob' =>'required|date',
             'gender'=>'required',
             'profile_image'=> 'required|image|mimes:jpg,png,jpeg,gif,svg|max:3048'
         ]);
        $image='';
       if($request->hasFile('profile_image')){
           $location= '/uploads/student/';
           $image= $this->image_upload($request->profile_image,$location);
       }

         $student=Student::create([
             'first_name' => $request->first_name,
             'last_name' => $request->last_name,
             'email' => $request->email ,
             'dob' =>  date('Y-m-d',strtotime($request->dob)),
             'gender'=>$request->gender,
             'profile_image'=> $image,
             'teacher_id' =>$request->teacher_id
         ]);
       if(!$student){
           Alert::toast('Something went wrong ..!', 'error');
           return back();
       }
        Alert::toast('Student create successfully.', 'success');
        return redirect()->route('student.index');
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
    public function edit($id)
    {
        $teachers= Teacher::all();
        $id= Crypt::decrypt($id);
        $student = Student::find($id);
        return view('pages.student.edit',compact('student','teachers'));
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
            'dob' =>'required|date',
            'gender'=>'required',
        ]);
        $student= Student::find(Crypt::decrypt($id));
        $image ='';
        if($request->hasFile('profile_image')){
            $location= '/uploads/student/';
            $image= $this->image_delete($student->profile_image,$location);
        }else{
            $image= $student->profile_image;
        }
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ,
            'dob' =>  date('Y-m-d',strtotime($request->dob)),
            'gender'=>$request->gender,
            'profile_image'=> $image,
            'teacher_id' =>$request->teacher_id
        ]);

        Alert::toast('Student updated successfully.', 'success');
        return redirect()->route('student.index');
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
        $data= Student::find($id);
        $data->delete();
        Alert::toast('Student deleted successfully.', 'success');
        return redirect()->route('student.index');

    }

    private function image_upload($file, $location)
    {
        $name = rand(10,99999).time().'.'.$file->extension();
        $file->move(public_path().$location, $name);
        return $name;
    }

    private function image_delete($file,$location){
        File::delete($location.$file);
    }
}
