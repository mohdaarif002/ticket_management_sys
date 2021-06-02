<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
     $user = Auth::user();
     $tickets=Ticket::all();


    return view('NewDashboard')->with(['user'=>$user,'tickets'=>$tickets]);

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::post('create-authorise-person',[\App\Http\Controllers\UserController::class,'create_authorise_person']);

Route::post('create-user-ticket',[\App\Http\Controllers\UserController::class,'create_user_ticket']);



Route::post('/update-ticket-status',[\App\Http\Controllers\UserController::class,'update_ticket_status']);

// Route::get('/all-listings',function(){

//     $listings=Ticket::all();
//     return view('all_listings')->with('listings',$listings);

// });




Route::middleware(['auth'])->group(function(){
    
    Route::get('/create-authorise-person',function(){

        $user=Auth::user();
    
        return view('create_authorise_person')->with('user',$user);
    
    });
    


    Route::get('/create-user-ticket',function(){

        $users=User::where('user_type','user')->get();
        
        $agents=User::where('user_type','agent')->where('status','active')->get();
        
            return view('create_user_ticket')->with(['users'=>$users, 'agents'=>$agents]);
        
        })->middleware(['onlySubadmin']);
        

    Route::get('/agent-assigned-listings',function(){

        $user=Auth::user();
    
        $listings=Ticket::where('assigned_to',$user->id)->get();
    
        return view('agent_assigned_listings')->with(['users'=>$user, 'listings'=>$listings]);
    
    });

    Route::get('/all-listings',[\App\Http\Controllers\UserController::class,'all_listings'])->name('listings');

});