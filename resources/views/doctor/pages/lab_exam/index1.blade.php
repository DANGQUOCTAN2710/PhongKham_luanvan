@extends('doctor.layouts.app')

@section('content')
<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Thông Tin Bệnh Nhân & Cận Lâm Sàng</h2>

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        {{-- Thông Tin Bệnh Nhân --}}
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <h4 class="text-dark fw-bold">Thông Tin Bệnh Nhân</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Họ và Tên:</th>
                        <td>{{ $user->medicalRecord->medicalBook->patient->name }}</td>
                    </tr>
                    <tr>
                        <th>Ngày Sinh:</th>
                        <td>{{ $user->medicalRecord->medicalBook->patient->dob }}</td>
                    </tr>
                    <tr>
                        <th>Giới Tính:</th>
                        <td>{{ $user->medicalRecord->medicalBook->patient->gender }}</td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ:</th>
                        <td>{{ $user->medicalRecord->medicalBook->patient->address }}</td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại:</th>
                        <td>{{ $user->medicalRecord->medicalBook->patient->phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Thông Tin Cận Lâm Sàng --}}
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <h4 class="text-dark fw-bold">Danh Sách Xét Nghiệm</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Loại xét nghiệm</th>
                        <th>Tên xét nghiệm</th>
                        <th>Kết quả</th>
                        <th>Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clinicalTestOrder->details as $detail)
                        <tr>
                            <td>
                                @if ($detail->clinicalTest)
                                    {{ $detail->clinicalTest->category }}
                                @elseif ($detail->ultrasound)
                                    {{ 'Siêu âm' }}
                                @elseif ($detail->diagnosticImaging)
                                    {{ 'Chẩn đoán hình ảnh' }}
                                @else
                                    Không có thông tin
                                @endif
                            </td>
                            
                            <td>
                                @if ($detail->clinicalTest)
                                    {{ $detail->clinicalTest->name }}
                                @elseif ($detail->ultrasound)
                                    {{ $detail->ultrasound->name }}
                                @elseif ($detail->diagnosticImaging)
                                    {{ $detail->diagnosticImaging->name }}
                                @else
                                    Không có thông tin
                                @endif
                            </td>
                            
                            <td>{{ optional($detail->testResult)->result ?? 'Chưa có kết quả' }}</td>
                            <td>
                                @if ($detail->testResult && $detail->testResult->file)
                                    @php
                                        $filePath = asset('storage/' . $detail->testResult->file);
                                        $isImage = in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp
                            
                                    @if ($isImage)
                                        <a href="{{ $filePath }}" target="_blank">
                                            <img src="{{ $filePath }}" width="100" height="100" class="border rounded">
                                        </a>
                                    @else
                                        <a href="{{ $filePath }}" target="_blank">📄 Xem file</a>
                                    @endif
                                @else
                                    Không có file
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Hướng Điều Trị --}}
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <form action="{{route('doctor.lab.Treatment', $user->medicalRecord->id)}}" method="POST">
                @csrf 
                <!-- Hướng Xử Lý -->
                <div class="card shadow-sm p-4 mb-4 rounded-4">
                    <h4 class="text-dark fw-bold">Hướng Xử Lý</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Xử Trí</label>
                            <select class="form-control @error('treatment') is-invalid @enderror" name="treatment" id="treatment">
                                <option value="">-- Chọn hướng xử lý --</option>
                                <option value="cap_toa" {{ old('treatment') == 'cap_toa' ? 'selected' : '' }}>Cấp Toa</option>
                                <option value="nhap_vien" {{ old('treatment') == 'nhap_vien' ? 'selected' : '' }}>Nhập Viện</option>
                            </select>
                            @error('treatment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
        
                        <!-- Ngày tái khám (ẩn/hiện theo hướng xử lý) -->
                        <div class="col-md-6 mb-3" id="revisit_section" style="display: none;">
                            <label class="form-label">Ngày Tái Khám</label>
                            <input type="date" name="revisit_date_captoa" value="{{ old('revisit_date_captoa') }}" class="form-control @error('revisit_date_captoa') is-invalid @enderror">
                            @error('revisit_date_captoa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <!-- Đơn Thuốc -->
                <div id="medicine_section" class="card shadow-sm p-4 mb-4 rounded-4">
                    <h4 class="text-dark fw-bold">Đơn Thuốc</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Thuốc</th>
                                <th>Liều Dùng</th>
                                <th>Số Lượng</th>
                                <th>Thời Điểm Uống</th>
                                <th><button type="button" id="addMedicine" class="btn btn-success">+</button></th>
                            </tr>
                        </thead>
                        <tbody id="medicineList">
                            <tr>
                                <td>
                                    @isset($medicines)
                                    <select name="medicine[0][medicine_id]" class="form-control @error('medicine.0.medicine_id') is-invalid @enderror">
                                        @foreach ($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('medicine.0.medicine_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @endisset
                                </td>
                                <td>
                                    <input type="text" name="medicine[0][dosage]" class="form-control @error('medicine.0.dosage') is-invalid @enderror" placeholder="VD: 1 viên/lần">
                                    @error('medicine.0.dosage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="medicine[0][quantity]" class="form-control @error('medicine.0.quantity') is-invalid @enderror" min="1" placeholder="Số lượng">
                                    @error('medicine.0.quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][morning]" value="1"> Sáng
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][noon]" value="1"> Trưa
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][evening]" value="1"> Chiều
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][night]" value="1"> Tối
                                        </label>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-danger remove">Xóa</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medicineModal">
                            Xem Đơn Thuốc
                        </button>
                    </div>
                    @include('doctor.pages.exam.review')
                </div>
        
                <!-- Nút Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
                </div>
        
            </form>
        </div>
    </div>
</main> 
<script>
   document.addEventListener("DOMContentLoaded", function () {
    let treatmentSelect = document.getElementById("treatment");
    let medicineSection = document.getElementById("medicine_section");
    let revisitSection = document.getElementById("revisit_section");

    function toggleSections() {
        let treatment = treatmentSelect.value;

        medicineSection.style.display = "none";
        revisitSection.style.display = "none";

        if (treatment === "cap_toa") {
            medicineSection.style.display = "block";
            revisitSection.style.display = "block";
        }
    }

    // Khởi động
    toggleSections();
    treatmentSelect.addEventListener("change", toggleSections);

    

    let medicineIndex = 1;
    document.getElementById("addMedicine").addEventListener("click", function () {
        let medicineList = document.getElementById("medicineList");
        let newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>
                <select name="medicine[${medicineIndex}][medicine_id]" class="form-control">
                    ${document.querySelector("select[name='medicine[0][medicine_id]']").innerHTML}
                </select>
            </td>
            <td>
                <input type="text" name="medicine[${medicineIndex}][dosage]" class="form-control" placeholder="VD: 1 viên/lần">
            </td>
            <td>
                <input type="number" name="medicine[${medicineIndex}][quantity]" class="form-control" min="1" placeholder="Số lượng">
            </td>
            <td>
                <div class="d-flex flex-wrap">
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][morning]" value="1"> Sáng
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][noon]" value="1"> Trưa
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][evening]" value="1"> Chiều
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][night]" value="1"> Tối
                    </label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove">Xóa</button>
            </td>
        `;
        medicineList.prepend(newRow);
        medicineIndex++;
    });

    // Xóa thuốc
    document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove")) {
                event.target.closest("tr").remove(); // Xóa hàng chứa nút "Xóa"
            }
    });
});
</script>
@endsection
