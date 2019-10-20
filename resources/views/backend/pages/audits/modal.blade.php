<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3 class="modal-title">History</h3>
</div>
<div class="modal-body">
    
    @if ($audit)
    <ul class="wrap-profile">
        <?php
        $name = isset($data->name) ? $data->name : $data->title;
        ?>
        <li>ID: <b>{{ $data->id }}</b></li>
        <li>Name / Title : <b>{!! $name !!}</b></li>
    </ul>
    @if (count($audit->getModified()))
    <div class="row">
        <div class="col-md-2 wrap-item">
            <h4 class="transparent">transparent</h4>
            <ul class="wrap-column default">
                @foreach ($audit->getModified() as $key => $item)
                <li>{{ $key }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-5 wrap-item">
            <h4>Old</h4>
            <ul class="wrap-old default">
                @foreach ($audit->getModified() as $key => $item)
                <li>{{ isset($item['old']) ? $item['old'] : '-' }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-5 wrap-item">
            <h4>New</h4>
            <ul class="wrap-new default">
                @foreach ($audit->getModified() as $key => $item)
                <li>{{ @$item['new'] }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @else
    <h4>No result.</h4>
    @endif

</div>