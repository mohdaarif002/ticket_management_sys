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

        <form method='post' action="/create-authorise-person" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="First name" name="first_name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="Last name" name="last_name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">

                    <input type="email" name="email" class="form-control" placeholder="Email Id" id="inputEmail4">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" class="form-control" placeholder="phone" name="phone">
                </div>
            </div>

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="role">

                        @if($user->user_type =='subadmin')
                        <option value="user" selected>user</option>
                        @else
                        <option value="">Role</option>
                        <option value="subadmin">subadmin</option>
                        <option value="agent">agent</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="profile_pic">Profile Pic</label>
                <input type="file" class="form-control-file" id="profile_pic" name="profile_pic">
            </div>

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                        <option value="active" selected>active</option>
                        <option value="inactive">inactive</option>

                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

</x-app-layout>