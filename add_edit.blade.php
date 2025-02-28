@include('components/head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('components/top_bar')

    @include('components/side_menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{!! \Session::get('success') !!}</p>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{!! \Session::get('error') !!}</p>
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">&nbsp;</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">{{ @$row ? 'Edit' : 'Add' }}
                                    {{ __('schools/words.school') }}</h3>
                                <span style="float:right !important"><a
                                        href="javascript:history.go(-1);">Back</a></span>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" id="school_form" action="{{ url('/schools/save/' . @$row->id) }}"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <h4>{{ __('words.location_info') }}</h4>
                                    <div class="row">
                                        @php
                                            $user_role = Session::get('user_role');
                                            $readonly = '';
                                            $opt_disabled = '';
                                            if ($user_role == 'Teacher' || $user_role == 'DPO') {
                                                $readonly = 'readonly';
                                                $opt_disabled = 'disabled';
                                            } //
                                        @endphp
                                        @if ($districts)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('words.district') }} Name <span
                                                        class="text-danger">*</span></label>
                                                <select name="district_id" class="form-control"
                                                    onchange="distt_change(this.value)" required>
                                                    <option value="">-- Please Select --</option>
                                                    @foreach ($districts as $each_district)
                                                        <option value="{{ $each_district->id }}"
                                                            {{ @$row->district_id == $each_district->id ? 'selected' : '' }}
                                                            {{ @$user_role == 'Teacher' && @$row->district_id != $each_district->id ? 'disabled' : '' }}
                                                            {{ @$row ? $opt_disabled : '' }}>
                                                            {{ $each_district->district_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        @if ($tehsils)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('words.tehsil') }} Name <span
                                                        class="text-danger">*</span></label>
                                                <select name="tehsil_id" id="tehsil_id" class="form-control"
                                                    onchange="tehsil_change(this.value)" required>
                                                    @foreach ($tehsils as $each_tehsil)
                                                        <option value="{{ $each_tehsil->id }}"
                                                            {{ @$row->tehsil_id == $each_tehsil->id ? 'selected' : '' }}
                                                            >
                                                            {{ $each_tehsil->tehsil_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        @if ($uc)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('words.uc') }} Name <span
                                                        class="text-danger">*</span></label>
                                                <select name="uc_id" id="uc_id" class="form-control"
                                                    onchange="uc_change(this.value)" required>
                                                    @foreach ($uc as $each_uc)
                                                        <option value="{{ $each_uc->id }}"
                                                            {{ @$row->uc_id == $each_uc->id ? 'selected' : '' }}>
                                                            {{ $each_uc->uc_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        @if ($vc)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('words.vc') }} Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="vc_name" class="form-control"
                                                    value="{{ @$row->vc_name }}" required>
                                                {{-- <select name="vc_id" id="vc_id" class="form-control" required>
                    @foreach ($vc as $each_vc)
                    <option value="{{ $each_vc->id }}" {{ @$row->vc_id == $each_vc->id ? 'selected' : '' }}
                    >{{ $each_vc->vc_name }}</option>
                    @endforeach
                    </select> --}}
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        @if ($areas)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('words.area') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="area_id" id="area_id" class="form-control" required>
                                                    @foreach ($areas as $each_area)
                                                        <option value="{{ $each_area->id }}"
                                                            {{ @$row->area_id == $each_area->id ? 'selected' : '' }}>
                                                            {{ $each_area->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.mohalla') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="mohalla" class="form-control"
                                                placeholder="{{ __('words.mohalla') }}"
                                                value="{{ @$row->mohalla }}" required>
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.landmark') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="landmark" class="form-control"
                                                placeholder="{{ __('words.landmark') }}"
                                                value="{{ @$row->landmark }}" required>
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.x_cord') }}</label>
                                            <input type="text" pattern="^\d*(\.\d{0,8})?$" name="x_cord"
                                                class="form-control" placeholder="{{ __('words.x_cord') }}"
                                                value="{{ @$row->x_cord }}">
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.y_cord') }}</label>
                                            <input type="text" pattern="^\d*(\.\d{0,8})?$" name="y_cord"
                                                class="form-control" placeholder="{{ __('words.y_cord') }}"
                                                value="{{ @$row->y_cord }}">
                                        </div>
                                        <!-- /.col 4 -->
                                        {{-- <div class="col-md-4 col-sm-6 col-xs-12">
                  <label>{{ __('words.map_url') }}</label>
                  <input type="text" name="map_url" class="form-control" placeholder="{{ __('words.map_url') }}"
                    value="{{ @$row->map_url }}">
                </div> --}}
                                        <!-- /.col 4 -->
                                    </div>
                                    <!-- /.row -->
                                    <h4>School Information</h4>
                                    <div class="row">
                                        @php
                                            $sch_type_show = '';
                                            if (@$row && ($user_role == 'DPO' || $user_role == 'Teacher')) {
                                                $sch_type_show = 'd-none';
                                            }
                                        @endphp
                                        <div class="col-md-4 col-sm-6 col-xs-12 {{ $sch_type_show }}">
                                            <label>{{ __('schools/words.school') }} Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="sch_type" class="form-control" required>
                                                {{-- @if ($user_role != 'DPO') --}}
                                                <option value="GCS"
                                                    {{ @$row->sch_type == 'GCS' ? 'selected' : '' }}
                                                    {{ @$row ? $opt_disabled : '' }}>GCS</option>
                                                {{-- @endif --}}
                                                <option value="BECS"
                                                    {{ @$row->sch_type == 'BECS' ? 'selected' : '' }}
                                                    {{ @$row ? $opt_disabled : '' }}>BECS</option>
                                                <option value="NCHD"
                                                    {{ @$row->sch_type == 'NCHD' ? 'selected' : '' }}
                                                    {{ @$row ? $opt_disabled : '' }}>NCHD</option>
                                                <option value="HCIP"
                                                    {{ @$row->sch_type == 'HCIP' ? 'selected' : '' }}
                                                    {{ @$row ? $opt_disabled : '' }}>HCIP</option>
                                            </select>
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('schools/words.school') }} Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="sch_name" id="sch_name"
                                                class="form-control"
                                                placeholder="{{ __('schools/words.school') }} Name"
                                                value="{{ @$row->sch_name }}" required {{ $readonly }}
                                                >
                                        </div>
                                        <!-- /.col 4 -->
                                        {{-- <div class="col-md-4 col-sm-6 col-xs-12">
                  <label>EMIS Code</label>
                  <input type="text" name="code" class="form-control" placeholder="EMIS Code" value="{{ @$row->code }}"
                required {{ @$row ? 'readonly disabled' : '' }}>
              </div> --}}
                                        <!-- /.col 4 -->
                                        @if (@$row)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>EMIS New Code</label>
                                                <input type="text" name="new_code" class="form-control"
                                                    placeholder="EMIS Code" value="{{ @$row->new_code }}"
                                                    required {{ @$row ? 'readonly disabled' : '' }}>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        {{-- @if ($user_role == 'Super Admin' || $user_role == 'DPO') --}}
                                        @php
                                        $prog_show_hide = '';
                                        $disabled = '';
                                        if($user_role == 'Teacher' || $user_role == 'DPO'){
                                            $prog_show_hide = 'd-none';
                                            $disabled = 'disabled';
                                        }
                                        @endphp
                                            @if (@$programs)
                                                <div class="col-md-4 col-sm-6 col-xs-12 {{ $prog_show_hide }}">
                                                    <label>Program / Scheme <span
                                                            class="text-danger">*</span></label>
                                                    <select name="program" class="form-control" id="program" onchange="program_chg()">
                                                        <option value="" selected>Please Select</option>
                                                        @foreach ($programs as $program)
                                                            <option value="{{ $program->name }}"
                                                                title="{{ $program->code }}"
                                                                {{ @$row->program == $program->name ? 'selected' : '' }} {{ $disabled }}
                                                                >
                                                                {{ $program->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="program_code" id="program_code">
                                                </div>
                                                <!-- /.col 4 -->
                                            @endif
                                        {{-- @endif --}}
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Establishment Date <span class="text-danger">*</span></label>
                                            <input type="date" name="establishment_date" class="form-control"
                                                placeholder="Establishment Date"
                                                value="{{ @$row->establishment_date }}" required
                                                max="{{ date('Y-m-d') }}">
                                        </div>
                                        <!-- /.col 4 -->
                                        @if ($sch_levels)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>{{ __('schools/words.sch_level') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="level_id" class="form-control" required>
                                                    @foreach ($sch_levels as $sch_level)
                                                        <option value="{{ $sch_level->id }}"
                                                            {{ @$row->level_id == $sch_level->id ? 'selected' : '' }}
                                                            {{ !@$row && $sch_level->id == '1' ? 'selected' : '' }}>
                                                            {{ $sch_level->level_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.col 4 -->
                                        @endif
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('schools/words.ownership') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="ownership" class="form-control" required>
                                                <option value="Owner"
                                                    {{ @$row->ownership == 'Owner' ? 'selected' : '' }}>Owner
                                                </option>
                                                <option value="Rented"
                                                    {{ @$row->ownership == 'Rented' ? 'selected' : '' }}>Rented
                                                </option>
                                            </select>
                                        </div>
                                        <!-- /.col 4 -->
                                        {{-- @if (@$row != '')
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="1" {{ @$row->status == '1' ? 'selected' : '' }} >Functional</option>
              <option value="0" {{ @$row->status == '0' ? 'selected' : '' }}>Non Functional</option>
              </select>
          </div>
          <!-- /.col 4 -->
          @else
          <input type="hidden" name="status" value="1">
          @endif --}}
                                        <input type="hidden" name="status" value="1">
                                    </div>
                                    <!-- /.row -->
                                    <div class="row mt-2">
                                        <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                                            @php
                                                $attachment_required = 'required';
                                                if (($user_role == 'Teacher' || $user_role == 'DPO') && @$row != '') {
                                                    $attachment_required = '';
                                                }
                                                if (@$row && $row->attachment != '') {
                                                    $attachment_required = '';
                                                } //
                                            @endphp
                                            <label>{{ __('words.attachment') }} {!! @$row->sch_type == 'GCS' ? '' : '' !!}
                                                {!! $attachment_required != '' ? '<span class="text-danger">*</span>' : '' !!}</label>
                                            <div class="img_preview_div">
                                                @php
                                                    $img_preview = url('/assets/images/no_image.png');
                                                    if (@$row->attachment != '' && @$row->attachment != 'NULL') {
                                                        $img_preview = url('/uploads/schools_images/' . $row->attachment);
                                                    }
                                                @endphp
                                                <img src="{{ $img_preview }}" id="attachment_image_preview"
                                                    class="img-fluid mb-2 img_preview w-100 h-100">
                                                <br>
                                            </div>
                                            <input type="file" name="img_attachment" id="attachment"
                                                class="form-control" accept="image/*" style="opacity: 0;"
                                                onchange="readURL(this, 'attachment_image_preview');"
                                                {{ @$row->sch_type == 'GCS' ? '' : '' }}
                                                {{ $attachment_required }}>
                                            <label for="attachment" class="btn btn-success">Click here to upload
                                                image</label>
                                            <span class="text-danger" id="attachment_image_error"></span>
                                            {{-- {{ (@$row) ? '' : 'required' }} --}}
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                                            <label>{{ __('words.school_image') }}</label>
                                            <div class="img_preview_div">
                                                @php
                                                    $img_preview = url('/assets/images/no_image.png');
                                                    if (@$row->school_image != '' && @$row->school_image != 'NULL') {
                                                        $img_preview = url('/uploads/schools_images/' . $row->school_image);
                                                    }
                                                @endphp
                                                <img src="{{ $img_preview }}" id="school_image_preview"
                                                    class="img-fluid mb-2 img_preview w-100 h-100">
                                                <br>
                                            </div>
                                            <input type="file" name="img_school_image" id="school_image"
                                                class="form-control" accept="image/*" style="opacity: 0;"
                                                onchange="readURL(this, 'school_image_preview');">
                                            <label for="school_image" class="btn btn-success">Click here to upload
                                                image</label>
                                            <span class="text-danger" id="school_image_error"></span>
                                            {{-- {{ (@$row) ? '' : 'required' }} --}}
                                        </div>
                                        <!-- /.col 4 -->
                                    </div>
                                    <!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.vec') }}</label>
                                            <select name="vec" class="form-control"
                                                onchange="vec_change(this.value)">
                                                <option value="1" {{ @$row->vec == '1' ? 'selected' : '' }}>
                                                    Functional</option>
                                                <option value="0" {{ @$row->vec == '0' ? 'selected' : '' }}>
                                                    Non Functional</option>
                                            </select>
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.vec_head') }}</label>
                                            <input type="text" name="vec_chariman" class="form-control"
                                                value="{{ @$row->vec_chariman }}">{{-- required --}}
                                        </div>
                                        <!-- /.col 4 -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>{{ __('words.vec_contact') }}</label>
                                            <input type="text" name="vec_contact" class="form-control"
                                                value="{{ @$row->vec_contact }}">{{-- required --}}
                                        </div>
                                        <!-- /.col 4 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="btn_submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    @include('components/footer')

</div>
<!-- ./wrapper -->
@include('components/scripts')
@include('components/schools_scripts')
<script type="text/javascript">
    function vec_change(val) {
        console.log(val)
        if (val == '1') {
            $('[name="vec_chariman"]').attr('required', true);
            $('[name="vec_contact"]').attr('required', true);
        } else {
            $('[name="vec_chariman"]').attr('required', false);
            $('[name="vec_contact"]').attr('required', false);
        }
    } //
</script>
<script>
    function validateImgSize(inputId, errDivId) {
        const fileSize_school_applicant_image = document.getElementById(inputId).files[0].size / 1000; // in MiB
        // alert(fileSize_school_applicant_image);
        if (fileSize_school_applicant_image > 120) { // check for 200 kb
            $("#" + errDivId).html('File size must not exceed 100 KB. Please Upload Compressed Image');
            $("#btn_submit").attr('disabled', true); //for clearing with Jquery
        } else {
            $("#" + errDivId).html('');
            //alert('file size is ok');
            $("#btn_submit").attr('disabled', false); //for clearing with Jquery
        }
    } //        
</script>
<script type="text/javascript" src="{{ asset('public/assets') }}/image_compressor/modernizr.js"></script>
<script type="text/javascript" src="{{ asset('public/assets') }}/image_compressor/compress.js"></script>
<script type="text/javascript">
    const compress = new Compress()
    compress.attach('#attachment', {
        size: 4,
        quality: .75
    }).then((results) => {
        // Example mimes:
        // image/png, image/jpeg, image/jpg, image/gif, image/bmp, image/tiff, image/x-icon,  image/svg+xml, image/webp, image/xxx, image/png, image/jpeg, image/webp
        // If mime is not provided, it will default to image/jpeg
        const img1 = results[0]
        // console.log('img1',img1)
        const base64str = img1.data
        const imgExt = img1.ext
        const file = Compress.convertBase64ToFile(base64str, imgExt)
        var ext_only = imgExt.split('/')[1];
        var file_compressed = new File([file], 'filename.' + ext_only, {
            type: 'mime/type'
        })
        var input = document.createElement('input')
        input.type = 'file'
        // input.multiple = true
        input.files = createFileList(file_compressed)
        input.name = 'attachment'
        input.hidden = true
        $('#school_form').append(input);
        // $('#student_image').val('');
        // -> Blob {size: 457012, type: "image/png"}
    });
    const compress2 = new Compress()
    compress2.attach('#school_image', {
        size: 4,
        quality: .75
    }).then((results) => {
        // Example mimes:
        // image/png, image/jpeg, image/jpg, image/gif, image/bmp, image/tiff, image/x-icon,  image/svg+xml, image/webp, image/xxx, image/png, image/jpeg, image/webp
        // If mime is not provided, it will default to image/jpeg
        const img2 = results[0]
        // console.log('img2',img2)
        const base64str2 = img2.data
        const img2Ext = img2.ext
        const file2 = Compress.convertBase64ToFile(base64str2, img2Ext)
        var ext_only = img2Ext.split('/')[1];
        var file_compressed = new File([file2], 'filename2.' + ext_only, {
            type: 'mime/type'
        })
        var input = document.createElement('input')
        input.type = 'file'
        // input.multiple = true
        input.files = createFileList(file_compressed)
        input.name = 'school_image'
        input.hidden = true
        $('#school_form').append(input);
        // $('#formb_image').val('');
    });

    function createFileList(a) {
        a = [].slice.call(Array.isArray(a) ? a : arguments)
        for (var c, b = c = a.length, d = !0; b-- && d;) d = a[b] instanceof File
        if (!d) throw new TypeError('expected argument to FileList is File or array of File objects')
        for (b = (new ClipboardEvent('')).clipboardData || new DataTransfer; c--;) b.items.add(a[c])
        return b.files
    } //
    $('#school_form').submit(function() {
        // your code here
        $('#attachment').val('');
        $('#school_image').val('');
    });

    function program_chg() {
        $('#program_code').val($('#program :selected').attr('title'));
    }
</script>
<style type="text/css">
    #sch_name {
        text-transform: uppercase
    }

    //
</style>
