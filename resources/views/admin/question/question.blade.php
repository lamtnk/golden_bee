@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách câu hỏi</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.question.show_add') }}">Thêm câu hỏi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên câu hỏi</th>
                                    <th>Nội dung câu hỏi</th>
                                    <th class="col-3">Các đáp án</th>
                                    <th class="col-2">Kết quả</th>
                                    <th>Kiểu</th>
                                    <th>Trạng thái</th>
                                    <th class="col-2">Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên câu hỏi</th>
                                    <th>Nội dung câu hỏi</th>
                                    <th>Các đáp án</th>
                                    <th>Kết quả</th>
                                    <th>Kiểu</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($questions as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->name }}</td>
                                        @if ($item->type == 0)
                                            <td>{{ $item->content }}</td>
                                        @else
                                            <td><a target="_blank" href="{{ $item->content_url }}">Click vào để xem nội
                                                    dung</a></td>
                                        @endif
                                        <td>{{ json_encode($item->choice, JSON_UNESCAPED_UNICODE) }}</td>
                                        <td>{{ $item->result }}</td>
                                        <td>{{ $item->type($item->type) }}</td>
                                        <td>{{ $item->activate == 0 ? 'Khóa' : 'Khả dụng' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-secondary"
                                                href="{{ route('admin.question.show_edit', ['id' => $item->id]) }}">Sửa</a>
                                            <a class="btn btn-danger"
                                                onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa câu hỏi {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.question.delete', ['id' => $item->id]) }}'; }">
                                                Xóa</a>
                                            @if ($item->activate == true)
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.question.activate', ['id' => $item->id, 'activate' => 0]) }}">
                                                    Khóa</a>
                                            @else
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.question.activate', ['id' => $item->id, 'activate' => 1]) }}">
                                                    Mở</a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->
@endsection
