<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class tintucController extends Controller
{
    public function getDanhsach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
//    public function getSua(){
//        return view('admin.theloai.sua');
//    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required|min:3|max:100'
        ],
        [
            'Ten.required'=>'Ban chua nhap Ten',
            'Ten.min'=>'Ban chua nhap du so ki tu',
            'Ten.max'=>'Ban nhap qua so ki tu',
        ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
//    Sua
    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|unique:TheLoai,Ten|min:3|max:111'
            ],
            [
                 'Ten.required'=>'Bạn chưa nhập tên thể loại',
                 'Ten.unique' => 'Tên Thể Loại Đã Tồn Tại',
                 'Ten.min' =>'Ban chua nhap du so ki tu',
                 'Ten.max' =>'Ban nhap qua so ki tu',
            ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Xoa thành công');
    }
}
