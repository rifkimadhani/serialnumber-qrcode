<!-- Edit Operation Modal -->
<div id="editOperationModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Update Operation</h5>
        <div class="divider"></div>
        <form id="editOperationForm" style="margin: 1vh .5vw 0 .5vw;">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_operation_id" name="id">

            <!-- <div class="input-field"> -->
            <input disabled type="hidden" id="edit_client_name" value="{{ $client->name }}" readonly>
            <!-- <label for="edit_client_name">Client Name</label> -->
            <!-- </div> -->

            <div class="input-field">
                <select id="edit_type" name="type" required>
                    <option value="" disabled selected>Select Operation Type</option>
                    <option value="deliver">Deliver</option>
                    <option value="returns">Returns</option>
                </select>
                <label for="edit_type" style="padding-top: 8px; ">Operation Type</label>
            </div>

            <div class="input-field">
                <select id="edit_device_id" name="device_id" required>
                    <option value="" disabled>Select Device</option>
                    @foreach($device as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
                <label for="edit_device_id" style="padding-top: 8px;">Device</label>
            </div>

            <div class="input-field">
                <input type="number" id="edit_device_total" name="device_total" required>
                <label for="edit_device_total">Total</label>
            </div>

            <div class="input-field">
                <input type="date" id="edit_date" name="date" required>
                <label for="edit_date">Date</label>
            </div>

            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Update</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>
    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitEditOpForm" class="btn-small waves-effect waves-light">Update</button>
    </div>

</div>