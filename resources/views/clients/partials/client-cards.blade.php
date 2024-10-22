@php
$totalClients = count($clients);
$columnsPerRow = 3;
$itemsInLastRow = $totalClients % $columnsPerRow;
@endphp



@foreach($clients as $index => $c)

@php
// Add offset to center the last row
$offsetClass = '';
if ($index >= $totalClients - $itemsInLastRow) {
if ($itemsInLastRow == 1 && $index == $totalClients - 1) {
$offsetClass = 'offset-s4';
} elseif ($itemsInLastRow == 2 && $index == $totalClients - 2) {
$offsetClass = 'offset-s2';
}
}
@endphp

<div class="col s4 {{ $offsetClass }}">
    <div class="card z-depth-2 hoverable" style="border-radius: 15px;">
        <div class="card-content" style="padding-bottom:0px; ">
            <a href="{{ route('clients.show', $c->id) }}" style="color:black;">
                <span class="card-title" style="font-size: 14pt;">
                    @foreach($c->categories as $category)
                    <span class="badge category" data-badge-caption=""><b>[ {{$category->name}} ]</b></span>
                    @endforeach
                    <strong>{{$c->name}}</strong>
                </span>
            </a>


            <div class="collection">
                <a href="#!" class="collection-item">
                    <span class="badge">{{$c->project}}</span>Project
                </a>
                <a href="#!" class="collection-item">
                    @php
                    $statusClass = '';
                    if ($c->status === 'Production') {
                    $statusClass = 'blue darken-3';
                    } elseif ($c->status === 'POC') {
                    $statusClass = 'amber';
                    }
                    @endphp
                    <span class="new badge {{$statusClass}}" data-badge-caption="">{{$c->status}}</span>Status
                </a>
                <a href="#!" class="collection-item">
                    <span class="badge">{{$c->country}}</span>Country
                </a>
                <a href="#!" class="collection-item" style="max-height:max-content">
                    <!-- <span class="badge"
                        style="max-width: 10vw; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$c->address}}</span>Address -->
                    <span class="device badge">{{$c->address}}</span>
                    <span>Address</span>
                </a>
                <a href="#!" class="collection-item ">

                    @foreach($c->devices as $device)
                    @php
                    $badgeClass = '';
                    if ($device->name === 'Quokka Box') {
                    $badgeClass = 'blue';
                    } elseif ($device->name === 'Quokka Server') {
                    $badgeClass = 'purple';
                    }
                    @endphp
                    <span class="device new badge {{ $badgeClass }}" data-badge-caption="{{ $device->name }}"></span>
                    @endforeach
                    <span>Devices</span>

                </a>
                <a href="#!" class="collection-item">
                    <span class="badge">{{$c->totalDevices()}}</span>Total Devices
                </a>
                <a href="#!" class="collection-item">
                    <span class="badge">{{$c->pic_name}}</span>PIC Name
                </a>
                <a href="#!" class="collection-item">
                    <span class="badge">{{$c->pic_contact}}</span>PIC Contact
                </a>
                <!-- <a href="#!" class="collection-item">
                    <span class="badge"
                        style="max-width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$c->notes}}</span>Notes
                </a> -->
            </div>
        </div>
        <div class="card-action right-align" style="align-self:flex-end;border-radius: 15px; ">
            <a href="#!" class="waves-effect waves-teal btn-flat hoverable edit-client black-text" data-id="{{$c->id}}"
                data-name="{{$c->name}}"
                data-category="@foreach($c->categories as $category){{$category->id}}@endforeach"
                data-project="{{$c->project}}" data-address="{{$c->address}}" data-status="{{$c->status}}"
                data-country="{{$c->country}}" data-pic_name="{{$c->pic_name}}" data-pic_contact="{{$c->pic_contact}}"
                data-notes="{{$c->notes}}" style="margin: 0px">
                Edit
            </a>

            <button class="waves-effect waves-red red-text btn-flat hoverable delete-client"
                data-id="{{$c->id}}">Delete</button>
        </div>
    </div>
</div>

@endforeach
