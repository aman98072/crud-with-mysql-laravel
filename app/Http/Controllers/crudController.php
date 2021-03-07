<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\crudModel;

class crudController extends Controller
{
    
    public function __construct() {
        $this->table = 'crud';
    }

    public function getAllData() {
        $data = crudModel::all()->toArray();
        return $data;
    }

    public function getData(Request $request) {
        $data = $this->getAllData();

        $msg = $request->session()->get('msg') ?? '';
        return view('crud', ['msg' => $msg, 'data' => $data]);
    }

    public function saveData(Request $request) {        
        $postData = $request->input();
        $curd = new crudModel;
        $curd->name = $postData['name'];
        $curd->phone = $postData['phone'];
        $curd->email = $postData['email'];
        $curd->pwd = $postData['pwd'];
        $res = $curd->save();    
        if ($res == 1) {
            $request->session()->flash("msg", "<div class='alert alert-success'><strong>Successfully Created!</strong></div>");               
        } else {
            $request->session()->flash("msg", "<div class='alert alert-danger'><strong>Something Went Wrong!</strong></div>");           
        }

       return redirect('crud');
    }

    public function editData($id = '') {
        $list = $this->getAllData();

        $editData = crudModel::find($id)->toArray();        
        return view('crud', ['msg' => '', 'data' => $list, 'editData' => $editData, 'editId' => $id]);
    }

    public function delete(Request $request, $id = '') {
        $isDelete = DB::table($this->table)->where('id', $id)->delete();        
        if ($isDelete) {
            $request->session()->flash("msg", "<div class='alert alert-success'><strong>Successfully Deleted!</strong></div>");
        } else {
            $request->session()->flash("msg", "<div class='alert alert-danger'><strong>Something Went Wrong!</strong></div>");
        }

        return redirect('crud');
    }

    public function update(Request $request) {
        $postData = $request->input();        
        $data = [
            'name' => $postData['name'],
            'phone' => $postData['phone'],
            'email' => $postData['email'],
            'pwd' => $postData['pwd']
        ];

        $id = $postData['editId'];
        $isUpdated = DB::table($this->table)->where('id', $id)->update($data);
        if ($isUpdated) {
            $request->session()->flash("msg", "<div class='alert alert-success'><strong>Successfully Updated!</strong></div>");               
        } else {
            $request->session()->flash("msg", "<div class='alert alert-danger'><strong>Something Went Wrong!</strong></div>");           
        }

       return redirect('crud');
    }
}
