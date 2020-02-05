<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request){

        $filterData['users'] = User::all();
        $filterData['statuses'] = TaskStatus::all();
        $filterRequest = $request->get('filter',[]);

        $tasks = Task::filter($filterRequest);

        $validatedData = $request->validate([
            'filter.user.*' => 'exists:users,id',
            'filter.developer.*' => 'exists:users,id',
            'filter.status.*' => 'exists:task_statuses,id',
            'filter.deadline_time.from' => 'date|date_format:Y-m-d',
            'filter.deadline_time.to' => 'date|date_format:Y-m-d',
        ]);

        // dd($filterRequest);

        return view('welcome', compact('tasks', 'filterData', 'filterRequest'));
    }

}
