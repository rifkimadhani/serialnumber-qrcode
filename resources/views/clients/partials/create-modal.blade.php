<!-- Create Client Modal -->
<div id="createClientModal" class="modal">
    <div class="modal-content">
        <h5 style="margin-top: 0px;">New Client</h5>
        <!-- Arrow Down Icon -->
        <div id="createScrollIndicator" class="scroll-indicator">
            <i class="material-icons">
                <span class="material-icons">
                    keyboard_double_arrow_down
                </span>
            </i>
        </div>

        <div class="divider"></div>

        <div id="crModalForm" style="max-height: 60vh; overflow-y: auto;">
            <form id="createClientForm" style="margin: 1vh .5vw 0 .5vw;">
                @csrf
                <div class="input-field">
                    <input type="text" id="name" name="name" required>
                    <label for="name">Name</label>
                </div>
                <div class="input-field">
                    <select id="category_id" name="category_id" required>
                        <option value="" disabled selected>Client's Category</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</small>
                        </option>
                        @endforeach
                    </select>
                    <label for="category_id" style="padding-top: 8px; ">Category</label>
                </div>
                <div class="input-field ">
                    <select id="project" name="project" required>
                        <option value="" disabled selected>Choose project</option>
                        <option value="Hospitality Solution">Hospitality Solution</option>
                        <option value="Digital Signage">Digital Signage</option>
                        <option value="Briskmedia">Briskmedia</option>
                    </select>
                    <label for="project" style="padding-top: 8px; ">Project</label>
                </div>
                <div class="input-field">
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Client's Status</option>
                        <option value="POC">POC</option>
                        <option value="Production">Production</option>
                    </select>
                    <label for="status" style="padding-top: 8px;">Client's Status</label>
                </div>

                <div class="input-field">
                    <input type="text" id="country" class="autocomplete" name="country" style="margin-top: 8px;"
                        required>
                    <label for="country" style="margin-top:8px">Country</label>
                </div>
                <div class="input-field">
                    <input type="text" id="address" name="address" required>
                    <label for="address">Address</label>
                </div>
                <div class="input-field">
                    <input type="text" id="pic_name" name="pic_name">
                    <label for="pic_name">PIC Name</label>
                </div>
                <div class="input-field">
                    <input type="text" id="pic_contact" name="pic_contact">
                    <label for="pic_contact">PIC Contact</label>
                </div>
                <div class="input-field">
                    <textarea id="notes" class="materialize-textarea" name="notes"></textarea>
                    <label for="notes">Notes</label>
                </div>

                <!-- <div class="modal-footer"
                    style="position:sticky; bottom: 2.5vh; margin-bottom: 2.5vh; padding: 4px 0px !important;">
                    <button id="submitbutton" type="submit" class="btn">Create</button>
                    <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
                    <div style="background-color: inherit;">&nbsp</div>
                </div> -->

            </form>
        </div>
    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitCreateForm" class="btn-small waves-effect waves-light">Add Client</button>
    </div>
</div>