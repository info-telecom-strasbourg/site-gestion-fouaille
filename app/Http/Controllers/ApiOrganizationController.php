<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class ApiOrganizationController extends Controller
{
    public function index(){
        return Organization::all()->toJson(JSON_PRETTY_PRINT);
    }
}
