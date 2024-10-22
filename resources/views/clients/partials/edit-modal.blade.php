<!-- Edit Client Modal -->
<div id="editClientModal" class="modal">
    <div class="modal-content">
        <h5 style="margin-top: 0px;">Update Client</h5>
        <!-- Arrow Down Icon -->
        <div id="editScrollIndicator" class="scroll-indicator">
            <i class="material-icons">
                <span class="material-icons">
                    keyboard_double_arrow_down
                </span>
            </i>
        </div>
        <div class="divider"></div>

        <div id="edModalForm" style="max-height: 60vh; overflow-y: auto;">
            <form id="editClientForm" style="margin: 1vh .5vw 0 .5vw">
                @csrf
                @method('PUT')

                <input type="hidden" id="edit_client_id" name="id">
                <div class="input-field ">
                    <input type="text" id="edit_name" name="name" required>
                    <label for="edit_name">Name</label>
                </div>
                <div class="input-field">
                    <select id="edit_category_id" name="category_id" required>
                        <option value="" disabled selected>Client's Category</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</small>
                        </option>
                        @endforeach
                    </select>
                    <label for="edit_category_id" style="padding-top: 8px; ">Category</label>
                </div>
                <div class="input-field ">
                    <select id="edit_project" name="project" required>
                        <option value="" disabled selected>Choose project</option>
                        <option value="Hospitality Solution">Hospitality Solution</option>
                        <option value="Digital Signage">Digital Signage</option>
                        <option value="Briskmedia">Briskmedia</option>
                    </select>
                    <label for="edit_project" style="padding-top: 8px; ">Project</label>
                </div>
                <div class="input-field ">
                    <select id="edit_status" name="status" required>
                        <option value="" disabled selected>Choose status</option>
                        <option value="POC">POC</option>
                        <option value="Production">Production</option>
                    </select>
                    <label for="edit_status" style="padding-top: 8px; ">Client's Status</label>
                </div>
                <div class="input-field ">
                    <input type="text" id="edit_country" class="autocomplete" name="country" style="margin-top: 8px;"
                        required>
                    <label for="edit_country" style="margin-top:8px; margin-bottom:8px;">Country</label>
                </div>

                <div class="input-field ">
                    <input type="text" id="edit_address" name="address" required>
                    <label for="edit_address">Address</label>
                </div>
                <div class="input-field ">
                    <input type="text" id="edit_pic_name" name="pic_name">
                    <label for="edit_pic_name">PIC Name</label>
                </div>
                <div class="input-field ">
                    <input type="text" id="edit_pic_contact" name="pic_contact">
                    <label for="edit_pic_contact">PIC Contact</label>
                </div>
                <div class="input-field ">
                    <textarea id="edit_notes" class="materialize-textarea" name="notes"></textarea>
                    <label for="edit_notes">Notes</label>
                </div>


                <!-- <div class="modal-footer"
                    style="position:sticky; bottom: 2.5vh; margin-bottom: 2.5vh; padding: 4px 0px !important;">
                    <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
                    <button type="submit" class="btn-small waves-effect waves-light">Update</button>
                    <div style="background-color: inherit; bottom:0">
                        <p style="margin: 0px; line-height:3vh">&nbsp</p>
                    </div>
                </div> -->
            </form>
        </div>
    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitEditForm" class="btn-small waves-effect waves-light">Update</button>
    </div>
</div>