@extends('layouts.template')

@section('title', 'ME | Data Devices')

@section('content')

<div class="container" style="margin-top: 5vh;">

    <div class="card z-depth-2" style="border-radius: 7px;">
        <div class="card-content">
            <div class="card-title">
                <div class="row" style="display: flex; justify-content: space-between; margin-right: .3em">
                    <div class="col s6" style="display: flex; justify-content: flex-start;gap:10px">
                        <p><strong>Devices List</strong></p>
                    </div>

                    <div class="col s6" style="display: flex; justify-content: flex-end;">
                        <button class="btn waves-effect waves-light hoverable modal-trigger"
                            style="background-color: #0C3E7A;font-size: 11px;" data-target="createDeviceModal">Add
                            Device</button>
                    </div>

                </div>
            </div>

            <div class="divider"></div>

            <section class="section" style="padding-bottom: 1px">
                <table id="devicesTable" class="display table-responsive striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Device ID</th>
                            <th>Device Name</th>
                            <th>Model</th>
                            <th>Stocks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </div>
    </div>

</div>

<!-- Modals -->
@include('devices.partials.create-modal')
@include('devices.partials.edit-modal')
@include('devices.partials.delete-modal')

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- js materializecss -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- jquery with datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#devicesTable').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        // responsive: true,
        // autoWidth: false,
        pageLength: 10,
        order: [
            [1, 'asc']
        ],
        ajax: '{{ route("devices.data") }}',
        columns: [{
                data: 'id',
                className: 'center',
            },
            {
                data: 'name',

            },
            {
                data: 'model',
            },
            {
                data: 'stock',
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
                className: 'center',
            }
        ],
        drawCallback: function() {
            // Reinitialize MaterializeCSS select
            $('.materialboxed').materialbox();
            $('select').formSelect(); // This applies Materialize styling to the dropdown
            document.querySelectorAll('.material-placeholder').forEach(function(element) {
                element.style.cssText =
                    "display: grid; place-items: center; width:fit-content;";
            });
        }
    });

    // Initialize Modals (add onOpenEnd to reset form)
    $('.modal').modal({
        onOpenEnd: function(modal) {
            // Reset the form when the modal is opened
            $('#createDeviceForm')[0].reset();
            // Reset labels for Materialize forms
            $('#createDeviceForm label').removeClass('active');
        },
    });

    $('#submitCreateDeviceForm').on('click', function() {
        $('#createDeviceForm').submit();
    });
    $('#submitEditDeviceForm').on('click', function() {
        $('#editDeviceForm').submit();
    });

    // Create Device Form Submission
    $('#createDeviceForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "{{ route('devices.store') }}",
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                table.ajax.reload();
                $('#createDeviceModal').modal('close');
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

    // Edit Device
    $(document).on('click', '.edit-device', function() {
        $('#edit_device_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_model').val($(this).data('model'));
        $('#edit_stock').val($(this).data('stock'));

        $('#editDeviceModal').modal('open');
        M.updateTextFields();
    });

    // Edit Device submit
    $('#editDeviceForm').on('submit', function(e) {
        e.preventDefault();
        let deviceId = $('#edit_device_id').val();

        $.ajax({
            type: 'PUT',
            url: '{{ route("devices.update", ":id") }}'.replace(':id', deviceId),
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                $('#editDeviceModal').modal('close');
                table.ajax.reload();
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

    // Handle Delete Device
    var deleteDeviceId = null;
    $(document).on('click', '.delete-device', function() {
        deleteDeviceId = $(this).data('id');
        $('#deleteDeviceModal').modal('open');
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (deleteDeviceId) {
            $.ajax({
                method: 'DELETE',
                url: '{{ route("devices.destroy", ":id") }}'.replace(':id', deleteDeviceId),
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    M.toast({
                        html: response.success
                    });
                    table.ajax.reload();
                    $('#deleteDeviceModal').modal('close');
                },
                error: function(xhr) {
                    M.toast({
                        html: "Failed to delete device."
                    });
                }
            });
        }
    });

});
</script>


@endsection