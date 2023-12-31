<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Services\Class\ClassService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(){
        $classes = $this->classService->getAll(['mentee_id' => Auth::user()->id]);
        return view('dashboard.mentee.class.index' ,compact('classes'));
    }

    public function show($classId){
        $class = $this->classService->show($classId);

        return view('dashboard.mentee.class.detail', compact('class'));
    }
}
