<!-- Create Device Modal -->
<div id="createDeviceModal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px;">
        <h5 style="margin-top: 0px;">Add Device</h5>
        <div class="divider"></div>
        <form id="createDeviceForm" style="margin: 1vh .5vw 0 .5vw">
            @csrf
            <div class="input-field">
                <input type="text" id="name" name="name" style="margin-top: 8px;" required>
                <label for="name" style="margin-top:8px">Device's Name</label>
            </div>
            <!-- <div class="input-field">
                <select id="model" name="model" required>
                    <option value="" disabled selected>Select Model</option>
                    @foreach($devices as $d)
                    <option value="{{$d->model}}">{{$d->model}}</option>
                    @endforeach
                </select>
                <label for="status">Device's Model</label>
            </div> -->
            <div class="input-field">
                <input type="text" id="model" name="model" required>
                <label for="model">Model</label>
            </div>
            <div class="input-field">
                <input type="number" id="stock" name="stock">
                <label for="stock">Stock</label>
            </div>
            <!-- <div class="modal-footer">
                <button type="submit" class="btn">Create</button>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
            </div> -->
        </form>
    </div>

    <div class="modal-footer" style="margin: 1vh 0">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
        <button id="submitCreateDeviceForm" class="btn-small waves-effect waves-light">Create</button>
    </div>
</div>