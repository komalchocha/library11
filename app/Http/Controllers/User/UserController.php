<?php

namespace App\Http\Controllers\User;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  index(BookDataTable $bookDataTable)
    {

        return $bookDataTable->render('User.index');
    }
}
