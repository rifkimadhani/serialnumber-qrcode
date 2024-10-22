<!-- Create App Modal -->
<div id="createAppModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Add App</h5>
        <div class="divider"></div>
        <form id="createAppForm" style="margin: 1vh .5vw 0 .5vw">
            @csrf
            <!-- <div class="input-field">
                <input type="text" id="type" name="type">
                <label for="type">Type</label>
            </div> -->
            <div class="input-field">
                <select id="type" name="type" required>
                    <option value="" disabled selected>App's Type</option>
                    <option value="web">Web</option>
                    <option value="android">Android</option>
                    <option value="mobile">Mobile</option>
                    <option value="desktop">Desktop</option>

                </select>
                <!-- <label for="status">Client's Status</label> -->
            </div>
            <div class="input-field">
                <input type="text" id="name" name="name" style="margin-top: 8px;" required>
                <label for="name" style="margin-top:8px">App's Name</label>
            </div>
            <div class="input-field">
                <input type="text" id="version" name="version" required>
                <label for="version">Version</label>
            </div>
            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Create</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>
    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitCreateAppForm" class="btn-small waves-effect waves-light">Create</button>
    </div>
</div>