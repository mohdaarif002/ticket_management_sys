<x-app-layout>

    @section('css')

    <!-- <link rel="stylesheet" href="style.css"> -->

    @endsection

    <div class="container">
        <div class="row daterange-picker-inputs">
            <div class="col-3">
                <input type="text" id="from_date" name="from_date" placeholder="from date" readonly>
            </div>
            <div class="col-3">
                <input type="text" id="to_date" name="to_date" placeholder="to date" readonly>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary" name='filter' id='filter'>filter</button>
                <button type="button" class="btn btn-info " name='refresh' id='refresh'>refresh</button>
            </div>
            <div class="col-3"></div>

        </div>
    </div>

    <hr>
    <div class="container table-responsive">

        <table id="all_listings" class="table table-bordered table-condensed table-striped display">
            <thead>
                <tr>
                    <th>Listing Id</th>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Assets</th>
                    <th>Priority</th>
                    <th>Serial No</th>
                    <th>Model No</th>
                    <th>Status</th>
                    <th>Assigned to</th>


                </tr>
            </thead>
         
        </table>

    </div>

    @push('scripts')

    <script>
        $(function() {
            $("#from_date").datepicker({

                todayBtn: 'linked',
                format: "yyyy-mm-dd",
                autoclose: true,
            });

            $("#to_date").datepicker({

                todayBtn: 'linked',
                format:"yyyy-mm-dd",
                autoclose: true,
            });


            load_data();

            function load_data(from_date = '', to_date = '') {

                $('#all_listings').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{route('listings')}}",
                        data: {from_date: from_date,  to_date: to_date}
                          
                        },
                        columns: [{
                                data: 'id',
                               
                            },
                            {
                                data: 'name',
                                
                            },
                            {
                                data: 'phone',
                              
                            },
                            {
                                data: 'assets',
                               
                            },
                            {
                                data: 'priority',
                                
                            },
                            {
                                data: 'serial_no',
                            },
                            {
                                data: 'model_no',
                                
                            },
                            {
                                data: 'status',
                            },
                            {
                                data: 'agent_name',
                            }
                        ]
                    
                });
            }



            $("#filter").click(function() {

                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();

                if (from_date != '' && to_date != '') {

                    $('#all_listings').DataTable().destroy();


                    load_data(from_date, to_date);

                } else {

                    alert('both date is required to filter');
                }

            });



            $("#refresh").click(function() {

                $("#from_date").val('');
                $("#to_date").val('');

                $('#all_listings').DataTable().destroy();

                load_data();


            });

        });
    </script>

    @endpush
</x-app-layout>