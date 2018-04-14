<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
class LoaiTinController extends Controller
{
    public function getDanhsach(){
        $loaitin = LoaiTin::all();
//        dd($loaitin);
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        return view('admin.loaitin.them');
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required|unique|min:3|max:100'
        ],
        [
            'Ten.required'=>'Ban chua nhap Ten loai tin',
            'Ten.unique'=>'Ban da nhap trùng tên loai tin',
            'Ten.min'=>'Bạn nhập quá ngắn',
            'Ten.max'=>'Bạn nhập quá muộn',
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','da them loai tin thanh cong');
    }
}
