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
//        var_dump($errors);
//        die();
        if(!$errors){
            $post=new Post();
            $post->title=$request->get('title');
            $post->body=$request->get('body');
            $post->uid=1;
            $post->image="os.jpg";
            $post->save();
            redirect('/posts');
        }else{
            redirect('posts/create',['response'=>['errors'=>$errors]]);
        }

    }

    public function show($id)
    {
       $post=Post::retrieveByPK($id);
//       var_dump($post->comments());
       return view('posts/show',['post'=>$post]);
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}