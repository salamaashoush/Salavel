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

class UserController extends Controller implements ResourceInterface
{

    public function index()
    {
        // TODO: Implement index() method.
        echo "it is working";
    }

    public function create()
    {
        // TODO: Implement create() method.
        echo "create also working";
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
        echo "salama";
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        echo $id;
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        echo "$id is edited";
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        echo "$id id now";
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}