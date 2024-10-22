<!-- Edit Device Modal -->
<div id="editDeviceModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Update Device</h5>

        <div class="divider"></div>

        <form id="editDeviceForm" style="margin: 1vh .5vw 0 .5vw;">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_device_id" name="id">

            <div class="input-field ">
                <input type="text" id="edit_name" name="name" style="margin-top: 8px;" required>
                <label for="edit_name" style="margin-top:8px; margin-bottom:8px;">Device's Name</label>
            </div>

            <div class="input-field ">
                <input type="text" id="edit_model" name="model" required>
                <label for="edit_model">Model</label>
            </div>
            <div class="input-field ">
                <input type="number" id="edit_stock" name="stock" required>
                <label for="edit_stock">Stock</label>
            </div>


            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Update</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>

    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitEditDeviceForm" class="btn-small waves-effect waves-light">Update</button>
    </div>
</div>