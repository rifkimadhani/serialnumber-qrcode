<!-- Create Operation Modal -->
<div id="createOperationModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">New Operation</h5>
        <div class="divider"></div>
        <form id="createOperationForm" style="margin: 1vh .5vw 0 .5vw">
            @csrf
            <!-- <div class="input-field"> -->
            <input type="hidden" id="client_name" name="client_name" value="{{ $client->name }}" readonly>
            <!-- <label for="client_name" class="active">Client Name</label> -->
            <!-- </div> -->

            <div class="input-field">
                <select id="type" name="type" required>
                    <option value="" disabled selected>Select Operation Type</option>
                    <option value="deliver">Deliver</option>
                    <option value="returns">Returns</option>
                </select>
                <label for="type" style="padding-top: 8px; ">Operation Type</label>
            </div>

            <div class="input-field">
                <select id="device_id" name="device_id" required>
                    <option value="" disabled selected>Select Device</option>
                    @foreach($device as $d)
                    <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->model }})</small>
                    </option>
                    @endforeach
                </select>
                <label for="device_id" style="padding-top: 8px; ">Device</label>
            </div>

            <div class="input-field">
                <input type="number" id="device_total" name="device_total" required>
                <label for="device_total">Total</label>
            </div>

            <div class="input-field">
                <input type="date" id="date" name="date" required>
                <label for="date">Date</label>
            </div>

            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Add Operation</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>
    </div>
    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitCreateOpForm" class="btn-small waves-effect waves-light">Add Operation</button>
    </div>
</div>