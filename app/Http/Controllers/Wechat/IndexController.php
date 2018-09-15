<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Maatwebsite\Excel\Facades\Excel;


class IndexController extends Controller
{
    /**
 * 显示主页
 */
    public function index(Request $request)
    {
        $list=Users::all()->toArray();
        return view('Wechat.index',['list' => $list,'add'=>'false']);
    }

    /**
     * 删除一条数据
     */
    public function delete(Request $request)
    {

        $id= $request->input('id');
        Users::where('id','=',$id)->delete();
        return redirect('/');
    }

    /**
     * 添加一条数据
     */
    public function addline(Request $request)
    {
        $User=new Users();
        $User->title = $request->input('title','未知');
        $User->source = $request->input('source','未知');
        $User->click = $request->input('click','0');
        $User->read = $request->input('read','0');
        $User->save();

        return redirect('/');
    }

    /**
     * 上传Excel
     */
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('upload');
        $this->importExcel($path);
        return redirect('/');
    }

    /**
     * 把上传的Excel导入数据库
     */
    public function importExcel($path){
        $filePath = 'storage/app/'.$path;
        Excel::load($filePath, function($reader) {
            $reader = $reader->getSheet(0);
            //获取表中的数据
            $results = $reader->toArray();
            foreach ($results as $key => $value) {
                $User=new Users();
                $User->title = $value[0];
                $User->source = $value[1];
                $User->click = $value[2];
                $User->read = $value[3];
                $User->save();
            }
        });
    }

    public function download(Request $request){
        $cellData =Users::all()->toArray();
        $cellData[0]=array('文章标题','来源','点击量','阅读量');
        Excel::create('文章总览',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->download('xls');
        die;
    }


}