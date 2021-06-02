<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use App\Repositories\UserRepositoryInterface;


class UserController extends Controller
{

    protected $user_repo = null;
    
    // UserRepositoryInterface is the interface
    public function __construct(UserRepositoryInterface $user_repo)
    {
        $this->user_repo = $user_repo;
    }
 

    public function create_authorise_person(Request $request)
    {

        // return $request->all();

        $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'first_name' => ['required', 'min:5', 'max:15'],
            'last_name' => ['required', 'min:5', 'max:15'],
            'phone' => ['required', 'numeric'],
            'role' => ['required'],
            'status' => ['required'],
            'profile_pic' => ['required', 'image', 'mimes:jpg,gif,png', 'max:20'],

        ]);


        $imageName = time() . '.' . $request->profile_pic->extension();

        $request->profile_pic->move(public_path('images'), $imageName);

        $newPassword = '';
        if ($request->role == 'user') {
            $newPassword = 'User@1234';
        } else {

            // agent and subadmin



            $newPassword = Str::ucfirst(Str::lower($request->first_name)) . '@1234';
        }

       $user= $this->user_repo->createAuthority([
            'name' => $request->first_name . " " . $request->last_name,
            'email' => $request->email,
            'user_type' => $request->role,
            'status' => $request->status,
            'profile_pic' => $imageName,
            'phone' => $request->phone,
            'password' => Hash::make($newPassword)

        ]);

        // $user = User::create([
        //     'name' => $request->first_name . " " . $request->last_name,
        //     'email' => $request->email,
        //     'user_type' => $request->role,
        //     'status' => $request->status,
        //     'profile_pic' => $imageName,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($newPassword)

        // ]);

        if ($user) {

            $email = $request->email;
            $offer = [
                'user_type' => $request->role,
                'login_credential_email' => $request->email,
                'login_credential_password' => $newPassword,
            ];

            Mail::to($email)->send(new RegistrationMail($offer));

            // dd('mail is triggered');

            return redirect()->back()->with('success_msg','Authorise person is created successfully.');
        } else {

            return redirect()->back()->with('error_msg','some error is occured.');
        }
    }

    public function create_user_ticket(Request $request)
    {

        // return $request->all();

        $request->validate([
            'name' => ['required', 'min:5', 'max:15'],
            'phone' => ['required', 'numeric'],
            'assets' => ['required'],
            'priority' => ['required'],
            'serial_no' => ['required', 'min:5', 'max:15'],
            'model_no' => ['required', 'min:5', 'max:15'],
            'assigned_to' => ['required'],

        ]);



        $ticket = Ticket::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'assets' => $request->assets,
            'priority' => $request->priority,
            'serial_no' => $request->serial_no,
            'model_no' => $request->model_no,
            'assigned_to' => $request->assigned_to,
            'status' => 'pending'   //default value

        ]);



        return redirect()->back()->with('success_msg','Ticket is created successfully.');

    }


    public function update_ticket_status(Request $request)
    {

        // return $request->all();

        $ticket = Ticket::find($request->listing_id);

        $ticket->status = $request->new_status;

        $ticket->save();

        return redirect()->back()->with('success_msg','Ticket status is updated successfully.');
    }


    public function all_listings(Request $request)
    {

        // return $request->all();

        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                $data = DB::table('tickets')
                    ->leftJoin('users', 'tickets.assigned_to', '=', 'users.id')
                    ->whereBetween('tickets.created_at', [$request->from_date, $request->to_date])
                    ->select('tickets.*', 'users.name as agent_name')
                    ->get();
            } else {

                $data = DB::table('tickets')
                    ->leftJoin('users', 'tickets.assigned_to', '=', 'users.id')
                    ->select('tickets.*', 'users.name as agent_name')
                    ->get();
            }

            return datatables()->of($data)->make(true);
        }



        return view('all_listings');
    }
}
