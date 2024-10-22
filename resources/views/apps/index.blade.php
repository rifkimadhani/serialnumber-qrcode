@extends('layouts.template')

@section('title', 'ME | Data Apps')

@section('content')

<div class="container" style="margin-top: 5vh;">

    <div class="card z-depth-2" style="border-radius: 7px;">
        <div class="card-content">
            <div class="card-title">
                <div class="row" style="display: flex; justify-content: space-between; margin-right: .3em">
                    <div class="col s6" style="display: flex; justify-content: flex-start;gap:10px">
                        <p><strong>Apps List</strong></p>
                    </div>

                    <div class="col s6" style="display: flex; justify-content: flex-end;">
                        <button class="btn waves-effect waves-light hoverable modal-trigger"
                            style="background-color: #0C3E7A;font-size: 11px;" data-target="createAppModal">Add
                            App</button>
                    </div>

                </div>
            </div>

            <div class="divider"></div>

            <section class="section" style="padding-bottom: 1px">
                <table id="appsTable" class="display table-responsive striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>App ID</th>
                            <th>App Name</th>
                            <th>Version</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </div>
    </div>

</div>

<!-- Modals -->
@include('apps.partials.create-modal')
@include('apps.partials.edit-modal')
@include('apps.partials.delete-modal')

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- js materializecss -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- jquery with datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#appsTable').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        // responsive: true,
        // autoWidth: false,
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        ajax: '{{ route("apps.data") }}',
        columns: [{
                data: 'id',
                className: 'center',
            },
            {
                data: 'name',

            },
            {
                data: 'version',
            },
            {
                data: 'type',
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
            $('#createAppForm')[0].reset();
            // Reset labels for Materialize forms
            $('#createAppForm label').removeClass('active');
        },
    });

    $('#submitCreateAppForm').on('click', function() {
        $('#createAppForm').submit();
    });
    $('#submitEditAppForm').on('click', function() {
        $('#editAppForm').submit();
    });

    // Create App Form Submission
    $('#createAppForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "{{ route('apps.store') }}",
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                table.ajax.reload();
                $('#createAppModal').modal('close');
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

    // Edit App
    $(document).on('click', '.edit-app', function() {
        $('#edit_app_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_version').val($(this).data('version'));
        $('#edit_type').val($(this).data('type')).formSelect();

        $('#editAppModal').modal('open');
        M.updateTextFields();
    });

    // Edit App submit
    $('#editAppForm').on('submit', function(e) {
        e.preventDefault();
        let appId = $('#edit_app_id').val();

        $.ajax({
            type: 'PUT',
            url: '{{ route("apps.update", ":id") }}'.replace(':id', appId),
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success
                });
                $('#editAppModal').modal('close');
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

    // Handle Delete App
    var deleteAppId = null;
    $(document).on('click', '.delete-app', function() {
        deleteAppId = $(this).data('id');
        $('#deleteAppModal').modal('open');
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (deleteAppId) {
            $.ajax({
                method: 'DELETE',
                url: '{{ route("apps.destroy", ":id") }}'.replace(':id', deleteAppId),
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    M.toast({
                        html: response.success
                    });
                    table.ajax.reload();
                    $('#deleteAppModal').modal('close');
                },
                error: function(xhr) {
                    M.toast({
                        html: "Failed to delete app."
                    });
                }
            });
        }
    });

});
</script>


@endsection