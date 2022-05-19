@extends('admin_dashboard.layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/1gzk1tfze0mxbn2mlpanob6qs78x7l9b2hartbd6y2o9ksjp/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Yazı Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Oluştur</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Yeni Yazı Ekle</h5>
                    <hr />
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Başlık</label>
                                            <input type="text" value="{{ old('title') }}" class="form-control"
                                                id="title" placeholder="Başlık Giriniz" name="title" required>
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Seo Url</label>
                                            <input type="text" value="{{ old('slug') }}" class="form-control" id="slug"
                                                name="slug" placeholder="Seo Url ini giriniz" required>
                                            @error('slug')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="excerpt" class="form-label">Alıntı</label>
                                            <input type="text" value="{{ old('excerpt') }}" class="form-control"
                                                id="excerpt" name="excerpt" placeholder="Alıntı Giriniz" required>
                                            @error('excerpt')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Kategorisi</label>
                                            <select name="category_id" value="{{ old('category_id') }}" id="category_id"
                                                class="single-select" required>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $key }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Kapak
                                                Görseli</label>
                                            <input id="thumbnail" value="{{ old('thumbnail') }}" required
                                                name="thumbnail" type="file">
                                            @error('thumbnail')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="post_content" class="form-label">Yazı Detayı</label>
                                            <textarea class="form-control" name="body" id="post_content" rows="3">
                                           {{ old('body') }}
                                            </textarea>
                                        </div>
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                            <button type="submit" class="btn btn-primary mt-3">Yazı ekle</button>

                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            tinymce.init({
                selector: '#post_content',
                plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
                height: '500',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
                toolbar_mode: 'floating',
                image_title: true,
                automatic_uploads: true,

                images_upload_handler: function(blobinfo, success, failure) {
                    let formData = new FormData();
                    let _token = $("input[name='_token']").val();
                    let xhr = new XMLHttpRequest();
                    xhr.open('post', "{{ route('admin.upload_tinymce_image') }}");
                    xhr.onload = () => {
                        if (xhr.status !== 200) {
                            failure("Http Error: " + xhr.status);
                            return
                        }
                        let json = JSON.parse(xhr.responseText)
                        if (!json || typeof json.location != 'string') {
                            failure("Invalid Json: " + xhr.responseText);
                            return
                        }
                        success(json.location)
                    }
                    formData.append('_token', _token);
                    formData.append('file', blobinfo.blob(), blobinfo.filename());
                    xhr.send(formData);
                }
            });
            setTimeout(() => {
                $(".general-message").fadeOut();
            }, 5000);
        });
    </script>
@endsection
