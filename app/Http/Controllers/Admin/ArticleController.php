<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Laracasts\Utilities\JavaScript\ViewBinder;

class ArticleController extends Controller
{
    public function index(Request $request){
        $rel = Article::select('id','title','pid')->where('is_nav','1')->orderBy('id','asc')->get();
        $arr = $arr2 = '';
        for ( $i=$j=0;$i<count($rel);$i++ ){
            if($rel[$i]->pid==0){
                $arr[] = $rel[$i];
            }else{
                $arr2[] = $rel[$i];
            }
        }
        for ( $i=0;$i<count($arr2);$i++ ) {
            for ( $j=0;$j<count($arr);$j++ ) {
                if ($arr[$j]->id == $arr2[$i]->pid) {
                    array_splice($arr, $j+1,0,array($arr2[$i]));
                }
            }
        }
        return view('admin.article')->with('permission',$arr);
    }

    /**
     * 展示一条数据
     */
    public function show($id){

    }

    /**
     * 展示新增页面
     */
    public function create(){
        return view('admin.article_create');
    }


    /**
     * 查看内容列表
     */
    public function look_son($id){
        $articles = Article::where('pid',$id)->orderBy('id','desc')->paginate(10);
        return view('admin.article_list',compact('articles'));
    }

    /**
     * 展示添加内容页面
     */
    public function add_son($id){
        return view('admin.article_add_son',compact('id'));
    }

    public function store_son( Request $request ){
        $atic = Input::all();
        $atic['thumbnail'] = getUrl($request,'thumbnail');
        $rel = Article::create($atic);
        if($rel->wasRecentlyCreated){
            return back()->with('errors','添加成功');
        }
        return back()->withErrors();
    }

    /**
     * 新增
     */
     public function store( ){
        $rel = Article::create(Input::all() );
        if($rel->wasRecentlyCreated){
            return back()->with('errors','添加成功');
        }
        return back()->withErrors();
    }

    private function getlevel($pid,$request,$str=""){
        $artical = Article::find($pid);
        if( $artical->pid != 0 ){
            $str .= "　　_";
            $request->attributes->add(['str'=>$str]);
            $artical = Article::find($pid);
            if($artical->pid != 0){
                $this->getlevel($artical->pid,$request,$str);
            }
        }
    }

    /**
     * 编辑页面
     */
    public function edit($id){
        $article = Article::find($id);
        if(!$article){
            return back()->with('errors','无此数据');
        }
        return view('admin.article_edit',compact('article'));
    }

    /**
     * 保存编辑
     */
    public function update($id,Request $request){
        $article = Article::find($id);
        if(!$article){
            return back()->with('errors',"无此数据");
        }
        $atic = Input::all();
        $atic['thumbnail'] = getUrl($request,'thumbnail');
        if( !$atic['thumbnail'] ){
            unset( $atic['thumbnail']);
        }
        $rel = $article->update($atic);
        if($rel){
            return back()->with('errors',"更新成功");
        }
        return back()->with('errors',"更新失败");
    }

    /**
     * 删除数据
     */
    public function destroy($id){
        $article = Article::find($id);
        if($article && $article->delete()){
            return back()->with('errors',"删除成功");
        }
        return back()->with('errors',"删除失败");
    }

    public function delete_son($id){
        $article = Article::find($id);
        if($article && $article->delete()){
            return back()->with('errors',"删除成功");
        }
        return back()->with('errors',"删除失败");
    }

}
