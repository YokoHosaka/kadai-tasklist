// <? php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;

// use App\User;

// class UsersController extends Controller
// {
//     public function index()
//     {
//         $users = User::find($id);
//         $tasks = $user->tasks()->orderBy('created_at', 'desc');
        
//         $data = [
//             'user' => $user,
//             'tasks' => $tasks,
//         ];
        
//         $data += $this->counts($user);
        
//         return view('tasks.index', $data);
        
//     }
    
//     public function show($id)
//     {
//         $user = User::$find($id);
//         $tasks = $user->tasks()->orderBy('created_at', 'desc');
        
//         $data = [
//             'user' => $user,
//             'tasks' => $tasks,
//         ];
        
//         $data += $this->conunts($user);
        
//         return view('task.show', $data);
//         ]);
//     }
// }
