@extends('admin_dashboard.layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    Yazılar
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tüm Yazılar</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span
                                class="position-absolute top-50 product-show translate-middle-y"><i
                                    class="bx bx-search"></i></span>
                        </div>
                        <div class="ms-auto"><a href="{{ route('admin.posts.create') }}"
                                class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Yeni Yazı
                                Ekle</a></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>#id</th>
                                    <th>Başlık</th>
                                    {{-- <th>Yazı Alıntı</th> --}}
                                    <th>Kategorisi</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Durumu</th>
                                    <th>Detaylar</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <h6 class="mb-0 font-14">{{ $post->id }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $post->title }}</td>

                                        {{-- <td>{{ $post->excerpt }}</td> --}}
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div
                                                class="badge rounded-pill  @if ($post->status == 'published') {{ 'text-info bg-light-info' }} @elseif($post->status == 'draft') {{ 'text-warning bg-light-warning' }} @else {{ 'text-danger bg-light-danger' }} @endif  p-2 text-uppercase px-3">
                                                <i class='bx bxs-circle me-1'></i>{{ $post->status }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ $post->views }}"
                                                class="btn btn-primary btn-sm radius-30 px-4">Görüntüle</a>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('admin.posts.edit', $post) }}"
                                                    class=""><i class='bx bxs-edit'></i>
                                                </a>
                                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    &nbsp; &nbsp;<button type="submit" class="show-alert-delete-box" class="mt-1"
                                                        data-toggle="tooltip" title='Sil'>
                                                        <i class='bx bxs-trash'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2" style="float:right">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(e) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            e.preventDefault();
            swal({
                title: "Yazıyı Silmek İstediğinize Eminmisiz?",
                text: "Bu işlemin geri Dönüşü olmayacaktır.",
                icon: "warning",
                type: "warning",
                buttons: ["Kapat", "Sil!"],
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
