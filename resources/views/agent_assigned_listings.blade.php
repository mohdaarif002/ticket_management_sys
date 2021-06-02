<x-app-layout>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Listing Id</th>
                <th scope="col">User</th>
                <th scope="col">Phone</th>
                <th scope="col">Assets</th>
                <th scope="col">Priority</th>
                <th scope="col">Serial No</th>
                <th scope="col">Model No</th>
                <th scope="col">Status</th>
                <th scope="col">Update Status</th>
            </tr>
        </thead>
        <tbody>

            @foreach($listings as $listing)
            <?php $i = 1; ?>

            <tr>
                <th scope="row">{{$listing->id}}</th>
                <td>{{$listing->name}}</td>
                <td>{{$listing->phone}}</td>
                <td>{{$listing->assets}}</td>
                <td>{{$listing->priority}}</td>
                <td>{{$listing->serial_no}}</td>
                <td>{{$listing->model_no}}</td>
                <td>{{$listing->status}}</td>
                <td>
                    <form method='post' action="/update-ticket-status" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="listing_id" value='{{$listing->id}}'>
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                                <select class="custom-select mr-sm-2" name="new_status">
                                    <option value="">status</option>
                                    <option value="pending">pending</option>
                                    <option value="approved">approved</option>
                                    <option value="ready_to_dispatch">ready_to_dispatch</option>
                                    <option value="dispatched">dispatched</option>
                                    <option value="closed">closed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>

                    </form>

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>






</x-app-layout>