@extends('layouts.template')

@section('title', 'ME | Data Client')

@section('content')
<div style="margin: 5vh 5vw;">
    <!-- <div class="card z-depth-2" style="border-radius: 7px;"> -->
    <!-- <div class="card-content"> -->

    <div class="row" style="margin-bottom:0px">
        <div class="col s12 l12">
            <!-- <button onclick="location.href='{{url('/clients')}}'" class="btn-small waves-effect waves-light"
                style="background-color: #0C3E7A;">
                <i class="material-icons left">
                    arrow_back_ios
                </i>
                Client List
            </button> -->

            <div class="card-panel z-depth-1" style="border-radius: 7px;">
                <div class="row" style="margin: 0px;">
                    <div class="col s11" style="padding-left: 0px;">
                        <div class="valign-wrapper">
                            <a href="{{url('/clients')}}" class="menu-back waves-effect waves-light">
                                <i class="material-icons left" style="font-size: xx-large;">
                                    arrow_back_ios
                                </i>
                            </a>
                            <strong style="font-size: xx-large;">{{ $client->name }}</strong>
                        </div>
                    </div>
                    <div class="col s1">
                        <span style="font-size: xx-large;">
                            <i class="material-icons right" style="font-size: xxx-large; color:#0C3E7A;">apartment</i>
                        </span>

                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="divider"></div> -->
    </div>

    <div class="row">
        <div class="col s12 l6">
            <div class="card z-depth-2" style="border-radius: 7px;">
                <div class="card-content">

                    <div class="card-title">
                        <div class="row" style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                            <div class="col s6"
                                style="display: flex; justify-content: flex-start; align-items: center; ">
                                <p>Client Information</p>
                            </div>

                            <div class="col s6"
                                style="display: flex; justify-content: flex-end; align-items: center; color: gray;">
                                <i class="material-icons">info_outline</i>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m8">
                            <div class="collection">
                                <a href="#!" class="collection-item">
                                    @foreach ($client->categories as $category)
                                    <span class="badge">{{ $category->name }}</span>Category
                                    @endforeach
                                </a>
                                <a href="#!" class="collection-item">
                                    <span class="badge">{{$client->status}}</span>Status
                                </a>
                                <a href="#!" class="collection-item">
                                    <span class="badge">{{$client->country}}</span>Country
                                </a>
                                <a href="#!" class="collection-item">
                                    <span class="badge"
                                        style="max-width: 23vw; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$client->address}}</span>Address
                                </a>
                                <a href="#!" class="collection-item">
                                    <span class="badge">{{$client->pic_name}}</span>PIC Name
                                </a>
                                <a href="#!" class="collection-item">
                                    <span class="badge">{{$client->pic_contact}}</span>PIC Contact
                                </a>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <ul class="collapsible">
                                <li class="active">
                                    <div class="collapsible-header" style="padding: .4rem; box-shadow: 0;">
                                        <i class="material-icons">notes</i>Notes
                                    </div>
                                    <div class="collapsible-body" style="padding: 10px;">
                                        <span style="font-size: 10pt;">
                                            {{$client->notes}}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 0px;" id="clients-detail">

                        <div class="col s12 m6">
                            <p style="font-size: large;">Device Lists</p>

                            <div class="collection">
                                @foreach ($client->totalDevicesPerDevice() as $deviceData)
                                <a href="#!" class="collection-item">
                                    <span class="new badge" data-badge-caption="device">
                                        {{ $deviceData['total'] }}
                                    </span>
                                    <span class="black-text">{{ $deviceData['name'] }}</span>
                                    <small>[{{ $deviceData['model'] }}]</small>
                                </a>
                                @endforeach

                                <a href="#!" class="collection-item">
                                    <span class="new badge"
                                        data-badge-caption="devices">{{$client->totalDevices()}}</span>
                                    <span class="black-text"><b>TOTAL</b></span>
                                </a>
                            </div>

                        </div>

                        <div class="col s12 m6">
                            <p style="font-size: large;">Software Installed</p>

                            <div class="collection">
                                @foreach ($client->apps as $app)
                                <a href="#!" class="collection-item">
                                    <span class="new badge" data-badge-caption="{{ $app->version }}">Version:</span>
                                    <span class="black-text">{{ $app->name }}</span>
                                    <small style="text-transform: capitalize;">[{{ $app->type }}]</small>
                                </a>
                                @endforeach
                                <div class="collection-item">
                                    <button class="btn-small waves-effect waves-light hoverable modal-trigger"
                                        data-target="addAppModal"
                                        style="max-height:1.5rem; line-height: 1.5rem; background-color: #0C3E7A; padding: 0 0.5rem;">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="right-align">
                                <button class="btn-small waves-effect waves-light hoverable modal-trigger"
                                    data-target="addAppModal">
                                    Add App
                                </button>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 l6">
            <div class="card z-depth-2" style="border-radius: 7px; padding-bottom:0px;">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row" style="display: flex; justify-content: space-between; margin-right: .3em">
                            <div class="col s6" style="display: flex; justify-content: flex-start; gap: 10px">
                                <p>Timeline</p>
                            </div>

                            <div class="col s6" style="display: flex; justify-content: flex-end;">
                                <button class="btn waves-effect waves-light hoverable modal-trigger"
                                    style="background-color: #0C3E7A;font-size: 11px;"
                                    data-target="createOperationModal">Add
                                    Activity</button>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- <h5>Timeline</h5> -->
                    <!-- Add Operation Button -->
                    <!-- <button class="btn waves-effect waves-light modal-trigger" data-target="createOperationModal"> -->
                    <!-- Add Operation -->
                    <!-- </button> -->
                    <!-- Operations Table with DataTables -->
                    <table id="operationsTable" class="display striped highlight responsive-table" width="100%">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Device</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Operation Modals -->
@include('clients.partials.create-operation-modal')
@include('clients.partials.edit-operation-modal')
<!-- Add App Modal -->
<div id="addAppModal" class="modal" style="overflow-y: unset; width: max-content;">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Add App to {{$client->name}}</h5>
        <div class="divider"></div>
        <form id="addAppForm" style="margin: 1vh .5vw 0 .5vw">
            @csrf
            <!-- Hidden Input for client_id (comes from the page) -->
            <input type="hidden" id="client_id" name="client_id" value="{{ $client->id }}">

            <!-- Select Dropdown for Apps -->
            <div class="input-field">
                <select id="app_id" name="app_id" required>
                    <option value="" disabled selected>Select an App</option>
                    @foreach ($apps as $app)
                    <option value="{{ $app->id }}">{{ $app->name }} ({{ $app->version }})</option>
                    @endforeach
                </select>
                <label for="app_id" style="padding-top: 8px; ">App</label>
            </div>

            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Add App</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>
    </div>
    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitAddAppForm" class="btn-small waves-effect waves-light">Add App</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- js materializecss -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#operationsTable').DataTable({
        processing: true,
        responsive: true,
        autoWidth: false,
        serverSide: true,
        pageLength: 4,
        lengthMenu: [
            [4, 10, 25, 50, -1],
            [4, 10, 25, 50, 'All']
        ],
        order: [
            [3, 'desc']
        ],
        ajax: {
            url: '{{ route("clients.operations.data", $client->id) }}', // Route for fetching operation data
            type: 'GET'
        },
        columns: [{
                data: 'type',
                className: 'data-uppercase',
                // width: '20%'
            },
            {
                data: 'device.name',
                // width: '20%'

            },
            {
                data: 'device_total',
                className: 'center',
                // width: '20%'
            },
            {
                data: 'date',
                className: 'center',
                // width: '20%'
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
                className: 'center',
                // width: '20%'
            }
        ],
        scrollY: '30vh', // Set height for the table body
        scrollCollapse: true, // Allow shrinking of the table when not enough data
        autoWidth: true, // Automatically adjust column widths
        fixedHeader: true,
        drawCallback: function() {
            // Reinitialize MaterializeCSS select
            $('.materialboxed').materialbox();
            $('select').formSelect(); // This applies Materialize styling to the dropdown
        }
    });

    $('.collapsible').collapsible();
    $('.datepicker').datepicker();

    // Initialize Modals
    $('.modal').modal({
        onOpenEnd: function(modal) {
            $('#createOperationForm')[0].reset();
            $('#createOperationForm label').removeClass('active');
        },
    });

    $('#submitCreateOpForm').on('click', function() {
        $('#createOperationForm').submit();
    });
    $('#submitEditOpForm').on('click', function() {
        $('#editOperationForm').submit();
    });
    $('#submitAddAppForm').on('click', function() {
        $('#addAppForm').submit();
    });

    $('#createOperationForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: '{{ route("operations.store", $client->id) }}', // Replace with correct route
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                $('#clients-detail').load(location.href + " #clients-detail > *");
                $('#createOperationModal').modal('close'); // Close modal
                table.ajax.reload(); // Reload the operations table
            },
            error: function(xhr) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    M.toast({
                        html: errors[field][0]
                    });
                }
            }
        });
    });

    // Handle Edit Operation button click
    $(document).on('click', '.edit-operation', function() {
        // Get operation data from the button's data attributes
        var operationId = $(this).data('id');
        var type = $(this).data('type');
        var deviceId = $(this).data('device_id');
        var deviceTotal = $(this).data('device_total');
        var date = $(this).data('date');

        // Fill the form with the operation's existing data
        $('#edit_operation_id').val(operationId);
        $('#edit_type').val(type).formSelect();
        $('#edit_device_id').val(deviceId).formSelect();
        $('#edit_device_total').val(deviceTotal);
        $('#edit_date').val(date);

        // Update Materialize text fields and open the modal
        M.updateTextFields();
        $('#editOperationModal').modal('open');
    });

    // Handle Edit Operation form submission (Update)
    $('#editOperationForm').on('submit', function(e) {
        e.preventDefault();
        var operationId = $('#edit_operation_id').val(); // Get the operation ID

        $.ajax({
            method: 'PUT',
            url: '{{ route("operations.update", ["clientId" => $client->id, "operationId" => ":operationId"]) }}'
                .replace(':operationId', operationId),
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                M.toast({
                    html: response.success
                });
                $('#clients-detail').load(location.href + " #clients-detail > *");
                table.ajax.reload(); // Reload the operations table
                $('#editOperationModal').modal('close'); // Close modal
            },
            error: function(xhr) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    M.toast({
                        html: errors[field][0]
                    });
                }
            }
        });
    });

    // Handle Delete Operation
    $(document).on('click', '.delete-operation', function() {
        var operationId = $(this).data('id'); // Get the operation ID

        if (confirm('Are you sure you want to delete this operation?')) {
            $.ajax({
                method: 'DELETE',
                url: '{{ route("operations.destroy", ["clientId" => $client->id, "operationId" => ":operationId"]) }}'
                    .replace(':operationId', operationId),
                data: {
                    _token: "{{ csrf_token() }}" // Include CSRF token for protection
                },
                success: function(response) {
                    M.toast({
                        html: response.success
                    });
                    $('#clients-detail').load(location.href + " #clients-detail > *");
                    table.ajax.reload(); // Reload the operations table
                },
                error: function(xhr) {
                    M.toast({
                        html: 'Failed to delete operation.'
                    });
                }
            });
        }
    });

    // Handle Add App form submission
    $('#addAppForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: '{{ route("clients.storeApp", $client->id) }}',
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                $('#addAppModal').modal('close');
                $('#addAppForm')[0].reset();

                // Optionally reload or refresh the list of apps
                $('#clients-detail').load(location.href + " #clients-detail > *");
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    M.toast({
                        html: errors[field][0]
                    });
                }
            }
        });
    });


});
</script>






@endsection
