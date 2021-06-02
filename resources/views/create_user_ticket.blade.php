<x-app-layout>


    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="/dashboard">Back to Dashboard</a>

        <form method='post' action="/create-user-ticket" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select class="custom-select mr-sm-2" id="name" name="name">
                        <option value="">Name</option>
                        @foreach($users as $user)
                        <option value='{{$user->name}}' phone_no='{{$user->phone}}'>{{$user->name}}</option>

                        @endforeach

                    </select>
                </div>

            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" class="form-control" placeholder="phone" id='phone' name="phone" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="assets" name="assets">
                </div>

            </div>


            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="priority">
                        <option value="">priority</option>
                        <option value="low">low</option>
                        <option value="medium">medium</option>
                        <option value="high">high</option>
                        <option value="emergency">emergency</option>
                    </select>
                </div>
            </div>


            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <input type="text" class="form-control" placeholder="serial no" name="serial_no">
                </div>
            </div>

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <input type="text" class="form-control" placeholder="model no" name="model_no">
                </div>
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" name="assigned_to">
                        <option value="">Assigned to</option>
                        @foreach($agents as $agent)
                        <option value='{{$agent->id}}'>{{$agent->name}}</option>

                        @endforeach

                    </select>
                </div>

            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

    <script>
        $(document).ready(function() {


            $("#name").change(function() {
                $('#phone').val($('#name option:selected').attr('phone_no'));
            });

        });
    </script>

</x-app-layout>