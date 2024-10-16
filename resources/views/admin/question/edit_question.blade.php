@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa câu hỏi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
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
                    <form action="{{ route('admin.question.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="typeSelect">Chọn kiểu</label>
                            <select required name="type" class="form-control" id="typeSelect">
                                <option {{ $questionInfo->type == 0 ? 'selected' : '' }} value="0">Text</option>
                                <option {{ $questionInfo->type == 1 ? 'selected' : '' }} value="1">Image</option>
                                <option {{ $questionInfo->type == 2 ? 'selected' : '' }} value="2">Audio</option>
                                <option {{ $questionInfo->type == 3 ? 'selected' : '' }} value="3">Video</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tên câu hỏi</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName"
                                aria-describedby="" value="{{ $questionInfo->name }}" name="name"
                                placeholder="Nhập tên câu hỏi">
                        </div>
                        <div class="form-group" id="content-text">
                            <label for="">Nội dung câu hỏi</label>
                            <input type="text" class="form-control" id="productName" aria-describedby="" name="content"
                                placeholder="Nhập nội dung câu hỏi" value="{{ $questionInfo->content }}">
                        </div>
                        <div id="content-file">
                            <label for="">File câu hỏi (Để nguyên nếu không cập nhật file)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">{{ $questionInfo->content }}</label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Đáp án A</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName_en"
                                aria-describedby="" name="a" value="{{ $questionInfo->a }}"
                                placeholder="Nhập đáp án A">
                        </div>
                        <div class="form-group">
                            <label for="">Đáp án B</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName_en"
                                aria-describedby="" name="b" value="{{ $questionInfo->b }}"
                                placeholder="Nhập đáp án B">
                        </div>
                        <div class="form-group">
                            <label for="">Đáp án C</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName_en"
                                aria-describedby="" name="c" value="{{ $questionInfo->c }}"
                                placeholder="Nhập đáp án C">
                        </div>
                        <div class="form-group">
                            <label for="">Đáp án D</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName_en"
                                aria-describedby="" name="d" value="{{ $questionInfo->d }}"
                                placeholder="Nhập đáp án D">
                        </div>
                        <div class="form-group">
                            <label for="">Kết quả</label>
                            <input type="text" class="form-control" id="productDescription" aria-describedby=""
                                name="result" value="{{ $questionInfo->result }}">
                        </div>
                        <span class="small text-danger" id="error"></span> <br>

                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <input type="hidden" name="id" value="{{ $questionInfo->id }}">
                        <button id="saveAdd" class="btn btn-success mt-4" type="submit">Sửa</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    <!-- End of Content Wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        const token = "{{ csrf_token() }}";
    </script>


    <script>
        $(document).ready(function() {
            $('#typeSelect').on('change', function() {
                var selectedType = $(this).val();
                if (selectedType == '0') {
                    $('#content-text').show();
                    $('#content-file').hide();
                } else {
                    $('#content-text').hide();
                    $('#content-file').show();
                }
            });

            // Kích hoạt sự kiện change khi trang tải để hiển thị đúng trạng thái
            $('#typeSelect').trigger('change');
        });
    </script>
@endsection
