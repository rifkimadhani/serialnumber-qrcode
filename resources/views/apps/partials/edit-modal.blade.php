<!-- Edit App Modal -->
<div id="editAppModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Update App</h5>

        <div class="divider"></div>

        <form id="editAppForm" style="margin: 1vh .5vw 0 .5vw;">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_app_id" name="id">

            <div class="input-field">
                <select id="edit_type" name="type" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="web">Web</option>
                    <option value="android">Android</option>
                    <option value="mobile">Mobile</option>
                    <option value="desktop">Desktop</option>

                </select>
                <label for="edit_type" style="padding-top: 8px; ">App's Type</label>
            </div>
            <div class="input-field ">
                <input type="text" id="edit_name" name="name" style="margin-top: 8px;" required>
                <label for="edit_name" style="margin-top:8px; margin-bottom:8px;">App's Name</label>
            </div>

            <div class="input-field ">
                <input type="text" id="edit_version" name="version" required>
                <label for="edit_version">Version</label>
            </div>


            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Update</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>

    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitEditAppForm" class="btn-small waves-effect waves-light">Update</button>
    </div>
</div>