@extends('layouts.guest')

@push('styles')
<style>
    .error {
        color: #dc3545;
        font-size: 12px;
        /* font-weight: bold; */
    }

    .h1 {
        letter-spacing: -0.02em;
    }

    .dropzone {
        overflow-y: auto;
        border: 0;
        background: transparent;
    }

    .dz-preview {
        width: 100%;
        margin: 0 !important;
        height: 100%;
        padding: 5px;
        position: absolute !important;
        top: 0;
    }

    .dz-photo {
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        background: #eae7e2;
    }

    .dz-drag-hover .dropzone-drag-area {
        border-style: solid;
        border-color: #86b7fe;
    }

    .dz-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dz-image {
        width: 90px !important;
        height: 90px !important;
        border-radius: 6px !important;
    }

    .dz-remove {
        display: none !important;
    }

    .dz-delete {
        width: 24px;
        height: 24px;
        background: rgba(0, 0, 0, 0.57);
        position: absolute;
        opacity: 0;
        transition: all 0.2s ease;
        top: 10px;
        right: 10px;
        border-radius: 100px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dz-delete>svg {
        transform: scale(0.75);
        cursor: pointer;
    }

    .dz-preview:hover .dz-delete,
    .dz-preview:hover .dz-remove-image {
        opacity: 1;
    }

    .dz-message {
        height: 100%;
        margin: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #adb5bd;
    }

    .dropzone-drag-area {
        height: 200px;
        width: 150px;
        position: relative;
        padding: 0 !important;
        border-radius: 10px;
        border: 3px dashed #dbdeea;
    }

    .was-validated .form-control:valid {
        border-color: #dee2e6 !important;
        background-image: none;
    }
</style>

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-white">
                <div class="card-body">
                    <h2 class="mb-5">{{ __('Tambah Data Karyawan') }}</h2>
                    <div class="alert alert-success d-none mb-4" id="successMessage">The form was submitted
                        successfully.</div>
                    <form class="dropzone overflow-visible p-0" id="formDropzone" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Photo')}}</label>

                            <div class="col-md-6">
                                <div class="dropzone-drag-area" id="previews">
                                    <div class="dz-message text-muted opacity-50" data-dz-message>
                                        <span>Drag file here to upload</span>
                                    </div>
                                    <div class="d-none" id="dzPreviewContainer">
                                        <div class="dz-preview dz-file-preview">
                                            <div class="dz-photo">
                                                <img class="dz-thumbnail" data-dz-thumbnail>
                                            </div>
                                            <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times">
                                                    <path fill="#FFFFFF"
                                                        d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback fw-bold">Please upload an image.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-end">{{ __('ID Karyawan')
                                }}</label>

                            <div class="col-md-6">
                                <input id="employee_id" type="text"
                                    class="form-control @error('employee_id') is-invalid @enderror" name="employee_id"
                                    value="{{ old('employee_id') }}" autocomplete="employee_id" autofocus>

                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama lengkap')
                                }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('No. Telepon')
                                }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin')
                                }}</label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                        value="Laki-laki">
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="Perempuan">
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                                <div id="genderError"></div>
                                @error('gender')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat')
                                }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" rows="5" autocomplete="address"></textarea>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position" class="col-md-4 col-form-label text-md-end">{{ __('Jabatan')
                                }}</label>

                            <div class="col-md-6">
                                <select id="position"
                                    class="form-control select2 @error('position') is-invalid @enderror" name="position"
                                    value="{{ old('position') }}" autocomplete="position">
                                    <option value="">--Pilih--</option>
                                    @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <div id="positionError"></div>
                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_id" class="col-md-4 col-form-label text-md-end">{{ __('Status')
                                }}</label>

                            <div class="col-md-6">
                                <div class="radio">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_id" id="kontrak"
                                            value="1">
                                        <label class="form-check-label" for="kontrak">Kontrak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_id" id="tetap"
                                            value="2">
                                        <label class="form-check-label" for="tetap">Tetap</label>
                                    </div>
                                </div>

                                <div id="status_idError"></div>
                                @error('status_id')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="work_start_date" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal
                                Mulai Kerja')
                                }}</label>

                            <div class="col-md-6">
                                <input id="work_start_date" type="text"
                                    class="form-control @error('work_start_date') is-invalid @enderror"
                                    name="work_start_date" value="{{ old('work_start_date') }}"
                                    autocomplete="work_start_date">

                                @error('work_start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary fw-medium" id="formSubmit" type="submit">
                                    <span class="spinner-border spinner-border-sm d-none me-2"
                                        aria-hidden="true"></span>
                                    Submit
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone;
    $('#formDropzone').dropzone({
        previewTemplate: $('#dzPreviewContainer').html(),
        url:"{{url('/employee/upload')}}",
        addRemoveLinks: true,
        autoProcessQueue: false,       
        uploadMultiple: false,
        parallelUploads: 1,
        maxFiles: 1,
        acceptedFiles: '.jpeg, .jpg, .png, .gif',
        thumbnailWidth: 900,
        thumbnailHeight: 600,
        previewsContainer: "#previews",
        timeout: 0,
        init: function() 
        {
            myDropzone = this;

            // when file is dragged in
            this.on('addedfile', function(file) { 
                $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
                
            });
        },

        success: function(file, response) 
        {
            setTimeout(function() {
                $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
                // remove file
                myDropzone.removeFile(file);
            }, 600);
        },
        error: function(file, response) 
        {
            
            setTimeout(function() {
                $('#errorMessage').removeClass('d-none');
            }, 600);
        }

    });
    
    function submitForm(form) {

        $.ajax({
            type: 'POST',
            url: "{{ route('employee.store') }}",
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#formSubmit').prop('disabled', true);
                $('#formSubmit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            success: function(response) {

                if (myDropzone.getQueuedFiles().length > 0) {
                    // console.log(response.id);
                    myDropzone.options.url = "{{url('/employee/upload') }}" + '/' + response.id;
                    myDropzone.processQueue();
                }
                // show success message
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your data has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#successMessage').removeClass('d-none');
                    // clear form
                    $('#formDropzone')[0].reset();

                    // clear error message
                    $('#errorMessage').addClass('d-none');

                    // clear validation
                    $('#formDropzone').find('.is-invalid').removeClass('is-invalid');
                    $('#formDropzone').find('.is-valid').removeClass('is-valid');
                    $('#formDropzone').find('.invalid-feedback').html('').hide();

                    // clear preview
                    $('#dzPreviewContainer').html('');
                    // clear select2
                    $('.select2').val(null).trigger('change');
                    
                }, 600);
            },
            error: function(xhr, status, error) {
                // show error message
                setTimeout(function() {
                    $('#errorMessage').removeClass('d-none');
                }, 600);

                // looping show error
                console.log('eror ajax');
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('input[name=' + key + '], select[name=' + key + '], textarea[name=' + key + ']').addClass('is-invalid').next('.invalid-feedback').html(value).show();
                })
            },
            complete: function() {
                $('#formSubmit').prop('disabled', false);
                $('#formSubmit').html('Submit');
            }
        });
       
    }

 
    var mySelect2 = $('.select2')
    //initiate select
    mySelect2.select2({
        placeholder: '--Pilih--',
        closeOnSelect: true,
        theme: 'bootstrap-5',
        allowClear: true,
        style: {
            backgroundColor: '#f8fafc',
        }
        
    });

    //global var for select 2 label
    var select2label;

    $('#formDropzone').validate({
        rules: {
            employee_id: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 13,
                number: true,
                digits: true,
            },
            address: {
                required: true,
            },
            gender: {
                required: true,
            },
            position: {
                required: true,
            },
            status_id: {
                required: true,
            },
            work_start_date: {
                required: true,
            }
        },
        messages: {
            employee_id: {
                required: "Please enter your employee id"
            },
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
                minlength: "Please enter a valid phone number",
                maxlength: "Please enter a valid phone number",
                number: "Please enter a valid phone number",
                digits: "Please enter a valid phone number",
            },
            address: {
                required: "Please enter your address",
            },
            gender: {
                required: "Please select your gender",
            },
            position: {
                required: "Please select your position",
                },
            status_id: {
                required: "Please select your status",
            },
            work_start_date: {
                required: "Please enter your work start date",
            }
        },
        errorElement: "div",
    errorPlacement: function ( error, element ) {
            // Menyisipkan class invalid-feedback di element error
        //  console.log(error[0].innerText);
            if (element.prop("type") === "select-one") {
                $('#'+ element.attr('name') + 'Error').append(error);
                select2label = error
            } else if(element.prop("type") === "radio") {
                // error.insertAfter( element.parent(".radio") );
            
                $('input[name="' + element.attr('name') + '"]').addClass( "is-invalid" ).removeClass( "is-valid" );
                $('#'+ element.attr('name') + 'Error').append(error);

            }else{
                error.addClass("invalid-feedback" );
                error.insertAfter( element );
            }
    },
    //menyisipkan class is-invalid pada element form yang valuenya error
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
        
    },

    //menyisipkan class is-valid pada element form yang valuenya sudah benar
    unhighlight: function (element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
        $('input[name="'+element.name+'"]').removeClass('is-invalid');

    },
    submitHandler: function(form) {

           submitForm(form);
        }
    });

    // Datepicker
    $('input[name="work_start_date"]').daterangepicker({
        autoUpdateInput: true,
        singleDatePicker: true,
        showDropdowns: false,
        autoApply: true,
        minYear: 2000,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: 'DD/MM/YYYY',
        }
    });

    $('input[name="work_start_date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });

    
    mySelect2.on("change", function(e) {
        
        $(this).removeClass('is-invalid').addClass('is-valid');
        $('#'+e.target.name+'-error').html('');
    });

</script>

@endpush