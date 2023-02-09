<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div data-work_type = "1" class="card card-primary card-full">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.admin.position.full') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($fullTime && count($fullTime) > 0)
                        @php
                            $name = 1;
                        @endphp
                        @foreach($fullTime as $item)
                        <div class="card-item">
                            <div class="form-group">
                                <label class="label-name" for="name">Ca {{$name}}</label>
                            </div>
                            <div class="row row-shift">
                                <input type="hidden" class="id" name="id" value="{{$item->id}}">
                                <input type="hidden" class="name" name="name" value="{{$name}}">
                                <input type="hidden" class="work_type" name="work_type" value="1">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.start') }}</label>
                                        <input type="time" disabled value="{{$item->start}}" class="form-control start">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.end') }}</label>
                                        <input type="time" disabled value="{{$item->end}}" class="form-control end">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group form-group-button">
                                        <button class="create display-none"><i class="fas fa-plus"></i></button>
                                        <button class="delete display-none"><i class="fas fa-times"></i></button>
                                        <button class="edit"><i class="fas fa-pen"></i></button>
                                        <button data-url="{{route('restaurant.shift.store')}}" class="save display-none"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $name++;
                        @endphp
                        @endforeach
                    @else
                        <div class="card-item">
                            <div class="form-group">
                                <label class="label-name" for="name">Ca 1</label>
                            </div>
                            <div class="row row-shift">
                                <input type="hidden" class="name" name="name" value="1">
                                <input type="hidden" class="work_type" name="work_type" value="1">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.start') }}</label>
                                        <input type="time" class="form-control start">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.end') }}</label>
                                        <input type="time" class="form-control end">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group form-group-button">
                                        <button class="create"><i class="fas fa-plus"></i></button>
                                        <button class="delete"><i class="fas fa-times"></i></button>
                                        <button class="edit display-none"><i class="fas fa-pen"></i></button>
                                        <button data-url="{{route('restaurant.shift.store')}}" class="save"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div data-work_type = "0" class="card card-secondary card-part">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.admin.position.part') }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($partTime && count($partTime) > 0)
                        @php
                            $name = 1;
                        @endphp
                        @foreach($partTime as $item)
                        <div class="card-item">
                            <div class="form-group">
                                <label class="label-name" for="name">Ca {{$name}}</label>
                            </div>
                            <div class="row row-shift">
                                <input type="hidden" class="id" name="id" value="{{$item->id}}">
                                <input type="hidden" class="name" name="name" value="{{$name}}">
                                <input type="hidden" class="work_type" name="work_type" value="0">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.start') }}</label>
                                        <input type="time" disabled value="{{$item->start}}" class="form-control start">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.end') }}</label>
                                        <input type="time" disabled value="{{$item->end}}" class="form-control end">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group form-group-button">
                                        <button class="create display-none"><i class="fas fa-plus"></i></button>
                                        <button class="delete display-none"><i class="fas fa-times"></i></button>
                                        <button class="edit"><i class="fas fa-pen"></i></button>
                                        <button data-url="{{route('restaurant.shift.store')}}" class="save display-none"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $name++;
                        @endphp
                        @endforeach
                    @else
                        <div class="card-item">
                            <div class="form-group">
                                <label class="label-name" for="name">Ca 1</label>
                            </div>
                            <div class="row row-shift">
                                <input type="hidden" class="name" name="name" value="1">
                                <input type="hidden" class="work_type" name="work_type" value="0">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.start') }}</label>
                                        <input type="time" class="form-control start">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.admin.shift.form.end') }}</label>
                                        <input type="time" class="form-control end">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group form-group-button">
                                        <button class="create"><i class="fas fa-plus"></i></button>
                                        <button class="delete"><i class="fas fa-times"></i></button>
                                        <button class="edit display-none"><i class="fas fa-pen"></i></button>
                                        <button data-url="{{route('restaurant.shift.store')}}" class="save"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>

@section('addjs')
    @include('restaurant.admin.shift.script')
@stop