<x-app-layout>
    <!-- here we need to add dashboard details to everyone -->

<?php



$activated_tickets=count(App\Models\Ticket::whereDate('created_at', '=', date('Y-m-d'))->get());
$unresolved_tickets=count(App\Models\Ticket::where('status','!=','closed')->whereDate('created_at', '=', date('Y-m-d'))->get());

$closed_tickets=count(App\Models\Ticket::where('status','closed')->whereDate('created_at', '=', date('Y-m-d'))->get());
$active_agents=count(App\Models\User::where('user_type','agent')->where('status','active')->get());

?>
  <h6 style="text-align: center; ">All data are on per day basis.</h6>
    <div class="row">
        
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Activated tickets</h5>
                    <p class="card-text">{{$activated_tickets}}</p>
                   
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Unresolved tickets</h5>
                    <p class="card-text">{{$unresolved_tickets}}</p>
             
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Closed tickets</h5>
                    <p class="card-text">{{$closed_tickets}}</p>
                    
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Active agents</h5>
                    <p class="card-text">{{$active_agents}}</p>
                   
                </div>
            </div>
        </div>

    </div>


    @if($user->user_type=='admin')
    <a href="/create-authorise-person">Create an Agent/Subadmin</a>
    @endif

    @if($user->user_type=='subadmin')

    <a href="/create-authorise-person">Create an user</a> <br />
    <a href="/create-user-ticket">Create a ticket</a> <br />
    <a href="/all-listings">All listings</a> <br />


    @endif

    @if($user->user_type=='agent')
    <a href="/agent-assigned-listings">View the assigned listings</a>
    @endif

</x-app-layout>