@extends('doctor.layouts.app')
@section('content')

<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Nhập Kết Quả Cận Lâm Sàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        <form action="{{ route('doctor.lab.storeLabResults', ['id' => request()->route('id')]) }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
    
            <div id="lab_section" class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Danh Sách Xét Nghiệm</h4>
            
                @php
                    $hasClinicalTest = $clinicalTestOrderDetails->whereNotNull('clinical_test_id')->isNotEmpty();
                    $hasUltrasound = $clinicalTestOrderDetails->whereNotNull('ultrasound_id')->isNotEmpty();
                    $hasImaging = $clinicalTestOrderDetails->whereNotNull('diagnostic_imaging_id')->isNotEmpty();
                @endphp
            
                @if ($hasClinicalTest)
                    <h5 class="fw-bold text-primary">Xét nghiệm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên xét nghiệm</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinicalTestOrderDetails->whereNotNull('clinical_test_id') as $detail)
                                <tr>
                                    <td>{{ $detail->clinicalTest->name }}</td>
                                    <td>
                                        <textarea name="results[{{ $detail->id }}]" class="form-control" required>
                                            {{ old("results.$detail->id", $detail->result) }}
                                        </textarea>
                                    </td>
                                    <td>
                                        <!-- Input cho phép chọn nhiều file -->
                                        <input type="file" name="files[{{ $detail->id }}]" accept="image/*, .pdf">
            
            
                                        @if (!empty($filePaths[0]))
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($filePaths as $file)
                                                        <a href="{{ asset('storage/' . trim($file)) }}" target="_blank" class="me-2">
                                                            <img src="{{ asset('storage/' . trim($file)) }}" width="100" height="100" class="border rounded">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                @if ($hasUltrasound)
                    <h5 class="fw-bold text-primary">Siêu âm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên siêu âm</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinicalTestOrderDetails->whereNotNull('ultrasound_id') as $detail)
                                <tr>
                                    <td>{{ $detail->ultrasound->name }}</td>
                                    <td>
                                        <textarea name="results[{{ $detail->id }}]" class="form-control" required>
                                            {{ old("results.$detail->id", $detail->result) }}
                                        </textarea>
                                    </td>
                                    <td>
                                        <input type="file" name="files[{{ $detail->id }}]" accept="image/*, .pdf">
            
                                        @if (!empty($filePaths[0]))
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($filePaths as $file)
                                                        <a href="{{ asset('storage/' . trim($file)) }}" target="_blank" class="me-2">
                                                            <img src="{{ asset('storage/' . trim($file)) }}" width="100" height="100" class="border rounded">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                @if ($hasImaging)
                    <h5 class="fw-bold text-primary">Chẩn đoán hình ảnh</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên chẩn đoán hình ảnh</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinicalTestOrderDetails->whereNotNull('diagnostic_imaging_id') as $detail)
                                <tr>
                                    <td>{{ $detail->diagnosticImaging->name }}</td>
                                    <td>
                                        <textarea name="results[{{ $detail->id }}]" class="form-control" required>
                                            {{ old("results.$detail->id", $detail->result) }}
                                        </textarea>
                                    </td>
                                    <td>
                                        <input type="file" name="files[{{ $detail->id }}]" accept="image/*, .pdf">
            
                                        @if (!empty($detail->file))
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div>
                                                    <a href="{{ asset('storage/' . $detail->file) }}" target="_blank">
                                                        @if (Str::endsWith($detail->file, ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset('storage/' . $detail->file) }}" width="100" height="100" class="border rounded">
                                                        @else
                                                            📄 <span>{{ basename($detail->file) }}</span>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
    
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">Lưu Kết Quả</button>
            </div>
        </form>
    </div>
</main>

@endsection
