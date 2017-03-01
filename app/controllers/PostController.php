<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:18 م
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\Post;

class PostController extends Controller implements ResourceInterface
{

    public function index()
    {
        $posts=Post::all();
        return view('posts/index',['posts'=>$posts]);
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store(Request $request)
    {
        $errors=$this->validator->validate($request,['title'=>'required','body'=>'required']);
        if(!$errors){
            $post=new Post();
            $post->title=$request->get('title');
            $post->body=$request->get('body');
            $post->uid=Session::getLoginUser()->id;
            try {
                $files = upload($request->getfile("image"));
                $post->image = $files['metas'][0]['name'];
            } catch (\Exception $e) {
                $e->getMessage();
            };
            $post->created_at = date("Y-m-d H:i:s");
            $post->updated_at = date("Y-m-d H:i:s");
            $post->save();
            Session::setFlash("Post Added Successfully");
            redirect('/posts/'.$post->id);
        }else{
            redirect('/posts/create',['response'=>['errors'=>$errors]]);
        }

    }

    public function show($id)
    {
       $post=Post::retrieveByPK($id);
       return view('/posts/show',['post'=>$post]);
    }

    public function edit($id)
    {
        $post=Post::retrieveByPK($id);
        return view('/posts/edit',['post'=>$post]);
    }

    public function update(Request $request, $id)
    {
        $post=Post::retrieveByPK($id);
        $errors=$this->validator->validate($request,['title'=>'required','body'=>'required']);
        if(empty($errors)){
            $post->title=$request->get('title');
            $post->body=$request->get('body');
            if($request->getfile("image")){
                unlink("/uploads/{$post->image}");
                try {
                    $files = upload($request->getfile("image"));
                    $post->image = $files['metas'][0]['name'];
                } catch (\Exception $e) {
                    $e->getMessage();
                };
            }
            $post->updated_at = date("Y-m-d H:i:s");
            $post->update();
            Session::setFlash("Post Updated Successfully");
            redirect('/posts/'.$id);
        }else{
            $request->saveToSession($errors);
            redirect('/posts/'.$id.'/edit',$request->getLastFromSession());
        }
    }

    public function destroy($id)
    {
        $post=Post::retrieveByPK($id);
        $post->delete();
        Session::setFlash("Post Deleted Successfully");
        redirect('/posts');
    }
}