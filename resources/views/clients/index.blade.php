@extends('layouts.template')

@section('title', 'ME | Data Client')

@section('content')
<div style="margin: 5vh 5vw;">
    <div class="row" style="margin-bottom: 0px;">
        <div class="col s12 l12 sticky">
            <div class="card-panel z-depth-1" style="border-radius: 7px;">
                <!-- <div class="card-content"> -->
                <!-- <div class="card-title" style="margin-bottom: 0px;"> -->

                <div class="row" style="display: flex; justify-content: space-between; margin-bottom: 0px">
                    <div class="col s6"
                        style="display: flex; justify-content: flex-start; align-items:center; font-size: xx-large;">
                        <strong>Client List</strong>
                    </div>

                    <div class="col s4 offset-s2" style="display: flex; justify-content: flex-end;">

                        <div class="input-field search" style="margin: 0px; flex-grow: 1;">
                            <i class="material-icons prefix blue-text text-darken-4" style="margin-left:5px;">
                                search
                            </i>
                            <input type="text" id="search-client" placeholder="Search by Client Name or Country"
                                class="validate"
                                style="border-bottom: none; box-shadow: none; margin: 0px 0px 0px 2.5rem">
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>

        <div class="col l12">
            <div class="card z-depth-2" style="border-radius: 7px;">
                <div class="card-content" style="padding-top: 0px;">
                    <div class="row" style="display: flex; align-items: center; margin-bottom: 0px">
                        <div class="col s3" style="margin: 1vh 1vw; border-radius:7px;">
                            <div class="input-field sort">
                                <select id="sort-clients">
                                    <option value="name" selected>Sort By Name</option>
                                    <option value="status">Sort By Status</option>
                                    <option value="country">Sort By Country</option>
                                    <!-- <option value="devices">Sort By Total Devices</option> -->
                                </select>
                                <label style="display:none">Sort by</label>
                            </div>
                        </div>

                        <div class="col s3 offset-s6">
                            <div style="margin-right:.3em; display: flex; justify-content: flex-end;">
                                <button class="btn waves-effect waves-light hoverable modal-trigger"
                                    style="background-color: #0C3E7A;font-size: 11px; align-items: center;margin-top:10px"
                                    data-target="createClientModal">Add
                                    Client
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>

                    <!-- Search input -->
                    <div class="row">

                    </div>

                    <!-- Clients list -->
                    <div id="clients-list" class="row">
                        @include('clients.partials.client-cards', ['clients' => $clients])
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>

<!-- Modals -->
@include('clients.partials.create-modal')
@include('clients.partials.edit-modal')
@include('clients.partials.delete-modal')

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- js materializecss -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@include('clients.partials.country-list')

<script>
$(document).ready(function() {
    // Initialize Modals
    $('.modal').modal({
        onOpenEnd: function(modal) {
            // Reset the form when the modal is opened
            $('#createClientForm')[0].reset();
            $('#crModalForm').scrollTop(0);
            // Reset labels for Materialize forms
            $('#createClientForm label').removeClass('active');
        },
        preventScrolling: false
    });

    $('#submitCreateForm').on('click', function() {
        $('#createClientForm').submit();
    });
    $('#submitEditForm').on('click', function() {
        $('#editClientForm').submit();
    });

    M.textareaAutoResize($('#notes'));
    M.textareaAutoResize($('#edit_notes'));
    $('select').formSelect();

    // Search Client by Name using AJAX
    $('#search-client').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: '{{ route("clients.search") }}',
            type: 'GET',
            data: {
                query: query
            },
            success: function(response) {
                // Update the clients-list div with the new content
                $('#clients-list').html(response);
            },
            error: function() {
                M.toast({
                    html: 'Search failed!'
                });
            }
        });
    });

    // Create Client Form Submission (Add Client)
    $('#createClientForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "{{ route('clients.store') }}",
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success,
                    classes: 'toast-s z-depth-5'
                });
                // Refresh the client list without reloading the page
                $('#clients-list').load(location.href + " #clients-list > *");
                $('#createClientModal').modal('close');
                $('#createClientForm')[0].reset(); // Reset form fields
            },
            error: function(xhr) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    M.toast({
                        html: errors[field][0],
                        classes: 'toast-e z-depth-5'
                    });
                }
            }
        });
    });

    // Handle Edit Client Button Click
    $(document).on('click', '.edit-client', function() {
        // Fill the edit form with client data from the card
        $('#edit_client_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_project').val($(this).data('project'));
        $('#edit_status').val($(this).data('status'));
        $('#edit_country').val($(this).data('country'));
        $('#edit_address').val($(this).data('address'));
        $('#edit_pic_name').val($(this).data('pic_name'));
        $('#edit_pic_contact').val($(this).data('pic_contact'));
        $('#edit_notes').val($(this).data('notes'));

        $('select').formSelect();
        M.textareaAutoResize($('#edit_notes'));
        $('#editClientModal').modal('open');
        M.updateTextFields();
    });

    // Edit Client Form Submission (Update Client)
    $('#editClientForm').on('submit', function(e) {
        e.preventDefault();
        let clientId = $('#edit_client_id').val();
        $.ajax({
            type: 'PUT',
            url: "{{ url('clients') }}/" + clientId,
            data: $(this).serialize(),
            success: function(response) {
                M.toast({
                    html: response.success,
                    classes: 'toast-s z-depth-5 rounded left-align'
                });
                // Refresh the client list without reloading the page
                $('#clients-list').load(location.href + " #clients-list > *");
                $('#editClientModal').modal('close');
            },
            error: function(xhr) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    M.toast({
                        html: errors[field][0],
                        classes: 'toast-e z-depth-5'
                    });
                }
            }
        });
    });

    // Handle Delete Client
    var deleteClientId = null;
    $(document).on('click', '.delete-client', function() {
        deleteClientId = $(this).data('id');
        $('#deleteClientModal').modal('open');
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (deleteClientId) {
            $.ajax({
                method: 'POST',
                url: "{{ url('clients') }}/" + deleteClientId,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    M.toast({
                        html: response.success,
                        classes: 'toast-s z-depth-5'
                    });
                    // Refresh the client list without reloading the page
                    $('#clients-list').load(location.href + " #clients-list > *");

                    $('#deleteClientModal').modal('close');
                },
                error: function(xhr) {
                    M.toast({
                        html: "Failed to delete client.",
                        classes: 'toast-e z-depth-5'
                    });
                }
            });
        }
    });


    // sorting
    // Sort function with AJAX reload
    function sortClients(attribute) {
        $.ajax({
            url: '{{ route("clients.sort") }}', // Define a route to handle the sorting
            type: 'GET',
            data: {
                sort_by: attribute
            }, // Send the selected sorting attribute
            success: function(response) {
                // Replace only the #clients-list div with the sorted clients
                $('#clients-list').html(response);
            },
            error: function() {
                M.toast({
                    html: 'Failed to sort clients!'
                });
            }
        });
    }

    // Event listener for sorting
    $('#sort-clients').on('change', function() {
        let sortBy = $(this).val();
        sortClients(sortBy);
    });

    // Initial sorting (by name)
    sortClients('name');

    // // Hide scroll indicator when user scrolls
    // var formElement = $('#createClientModal');
    // formElement.on('scroll', function() {
    //     var scrollPosition = formElement.scrollTop();
    //     var scrollHeight = formElement[0].scrollHeight;
    //     var clientHeight = formElement[0].clientHeight;

    //     // If user scrolls down, hide the arrow
    //     if (scrollPosition > 0) {
    //         $('#createScrollIndicator').fadeOut();
    //     } else if (scrollHeight > clientHeight) {
    //         // Show the arrow when at the top if the content is overflowed
    //         $('#createScrollIndicator').fadeIn();
    //     }
    // });

    // Apply to both create and edit modals
    handleScroll($('#crModalForm'), $('#createScrollIndicator'));
    handleScroll($('#edModalForm'), $('#editScrollIndicator'));

    // Function to handle scroll behavior for a specific form
    function handleScroll(formElement, scrollIndicator) {
        formElement.on('scroll', function() {
            var scrollPosition = formElement.scrollTop();
            var scrollHeight = formElement[0].scrollHeight;
            var clientHeight = formElement[0].clientHeight;

            // Debugging logs to check scroll positions
            console.log('Scroll Position:', scrollPosition);
            console.log('Scroll Height:', scrollHeight);
            console.log('Client Height:', clientHeight);

            // If user scrolls down, hide the arrow
            if (scrollPosition > 0) {
                console.log("Hiding arrow");
                scrollIndicator.fadeOut(); // Hides the arrow when scrolled down
            } else {
                // Show the arrow if the content is overflowed and scroll is at the top
                if (scrollHeight > clientHeight) {
                    console.log("Showing arrow");
                    scrollIndicator.fadeIn(); // Show the arrow only when there's overflow
                } else {
                    scrollIndicator.fadeOut(); // If no overflow, hide the arrow
                }
            }

            if (formElement[0].scrollHeight <= formElement[0].clientHeight) {
                scrollIndicator.hide();
            }
        });
    }
});
</script>




@endsection