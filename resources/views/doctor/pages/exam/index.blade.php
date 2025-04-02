@extends('doctor.layouts.app')
@section('content')
<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Khám Lâm Sàng</h2>

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        <form id="examForm" action="{{ isset($exam) ? route('exam.update', $exam->id) : route('exam.store') }}" method="POST">
            @csrf
            @method('PUT')
            @if(session('error'))
                <div class="alert alert-success">{{ session('error') }}</div>
            @endif

            <!-- Thông Tin Bệnh Nhân -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Thông Tin Bệnh Nhân</h4>
                <div class="row">
                    <input type="text" class="form-control" name="patient_id" value="{{ $exam->medicalBook->patient->id ?? '' }}" hidden>
                    <input type="text" class="form-control" name="patient_examDate" value="{{ $exam->exam_date ?? '' }}" hidden>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" name="patient_name" value="{{ $exam->medicalBook->patient->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tuổi</label>
                        <input type="text" class="form-control" name="patient_age" value="{{ $exam->medicalBook->patient->age ?? '0' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">CCCD</label>
                        <input type="text" class="form-control" name="patient_idUser" value="{{ $exam->medicalBook->patient->idUser ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Giới tính</label>
                        <input type="text" class="form-control" name="patient_gender" value="{{ $exam->medicalBook->patient->gender ?? '' }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tiền sử bệnh lý</label>
                        <input type="text" name="patient_medicalHistory" class="form-control" value="{{ $exam->medicalBook->medical_history ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Dị ứng</label>
                        <input type="text" name="patient_allergies" class="form-control" value="{{ $exam->medicalBook->allergies ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tiền sử gia đình</label>
                        <input type="text" name="patient_familyHistory" class="form-control" value="{{ $exam->medicalBook->family_history ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Chỉ Số Sinh Hiệu -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Chỉ Số Sinh Hiệu</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cân Nặng (kg)</label>
                        <input type="number" name="weight" class="form-control" value="{{ $exam->weight ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chiều Cao (cm)</label>
                        <input type="number" name="height" class="form-control" value="{{ $exam->height ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">BMI</label>
                        <input type="text" class="form-control" value="{{ $exam->bmi ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nhiệt Độ (°C)</label>
                        <input type="number" name="temperature" class="form-control" value="{{ $exam->temperature ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mạch (lần/phút)</label>
                        <input type="number" name="pulse" class="form-control" value="{{ $exam->pulse ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SpO2 (%)</label>
                        <input type="number" name="spo2" class="form-control" value="{{ $exam->spo2 ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Chẩn Đoán -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Chẩn Đoán</h4>
                <div class="mb-3">
                    <label class="form-label">Lý Do Khám</label>
                    <textarea class="form-control" rows="2" disabled>{{ $exam->reason ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chẩn đoán</label>
                    <input type="text" name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" value="{{ old('diagnosis', $exam->diagnosis ?? '') }}">
                    @error('diagnosis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Bệnh Chính</label>
                    <input type="text" name="main_disease" class="form-control @error('main_disease') is-invalid @enderror" value="{{ old('main_disease', $exam->main_disease ?? '') }}">
                    @error('main_disease')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Bệnh Phụ</label>
                    <input type="text" name="sub_disease" class="form-control @error('sub_disease') is-invalid @enderror" value="{{ old('sub_disease', $exam->sub_disease ?? '') }}">
                    @error('sub_disease')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Hướng Xử Lý -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Hướng Xử Lý</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Xử Trí</label>
                        <select class="form-control @error('treatment') is-invalid @enderror" name="treatment" id="treatment">
                            <option value="">-- Chọn hướng xử lý --</option>
                            <option value="cap_toa">Cấp Toa</option>
                            <option value="can_lam_sang">Yêu Cầu Cận Lâm Sàng</option>
                        </select>
                        @error('treatment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3" id="revisit_section" style="display: none;">
                        <label class="form-label">Ngày Tái Khám</label>
                        <input type="date" name="re_exam_date" class="form-control @error('re_exam_date') is-invalid @enderror">
                        @error('re_exam_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Giao diện chọn thuốc -->
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
                    <button type="button" class="btn btn-primary" onclick="openMedicineModal()">
                        Xem Đơn Thuốc
                    </button>
                </div>
                @include('doctor.pages.exam.review')
            </div>

            <!-- Giao diện chọn dịch vụ cận lâm sàng -->
            <div id="lab_section" class="card shadow-sm p-4 mb-4 rounded-4" style="display: none;">
                <h4 class="text-dark fw-bold text-center mb-3">Chỉ Định Cận Lâm Sàng</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="fw-bold">Loại cận lâm sàng</h5>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <!-- Xét nghiệm -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="clinical_test_id" value="1" id="service_type_clinical">
                                    <label class="form-check-label fw-bold" for="service_type_clinical">Xét nghiệm</label>
                                </div>
                                <!-- Siêu âm -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="ultrasound_id" value="1" id="service_type_ultrasound">
                                    <label class="form-check-label fw-bold" for="service_type_ultrasound">Siêu âm</label>
                                </div>
                                <!-- Chẩn đoán hình ảnh -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="imaging_id" value="1" id="service_type_imaging">
                                    <label class="form-check-label fw-bold" for="service_type_imaging">Chẩn đoán hình ảnh</label>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Danh sách dịch vụ theo loại -->
                    <div class="row mt-4" id="testOptions" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
                        <!-- Xét nghiệm -->
                        @isset($clinicalTestsByCategory)
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="clinical_test" style="display: none;flex: 1; min-width: 250px;flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Xét nghiệm</h6>
                                @foreach ($clinicalTestsByCategory as $category => $tests)
                                    <div class="fw-bold mt-2">{{ $category }}</div> <!-- Hiển thị tên loại xét nghiệm -->
                                    <div class="d-flex flex-column align-items-start">
                                        @foreach ($tests as $test)
                                            <div class="form-check">
                                                <input class="form-check-input clinical-test" type="checkbox" name="clinical_test_id[]" value="{{ $test->id }}" id="clinical_test_{{ $test->id }}">
                                                <label class="form-check-label" for="clinical_test_{{ $test->id }}">{{ $test->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endisset
            
                        <!-- Siêu âm -->
                        @isset($ultrasounds)
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="ultrasound" style="display: none; flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Siêu âm</h6>
                                <div class="d-flex flex-column align-items-start">
                                    @foreach ($ultrasounds as $ultrasound)
                                        <div class="form-check">
                                            <input class="form-check-input ultrasound-test" type="checkbox" name="ultrasound_id[]" value="{{ $ultrasound->id }}" id="ultrasound_{{ $ultrasound->id }}">
                                            <label class="form-check-label" for="ultrasound_{{ $ultrasound->id }}">{{ $ultrasound->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endisset
            
                        <!-- Chẩn đoán hình ảnh -->
                        @isset($diagnosticImagings)
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="imaging" style="display: none; flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Chẩn đoán hình ảnh</h6>
                                <div class="d-flex flex-column align-items-start">
                                    @foreach ($diagnosticImagings as $imaging)
                                        <div class="form-check">
                                            <input class="form-check-input imaging-test" type="checkbox" name="imaging_id[]" value="{{ $imaging->id }}" id="imaging_{{ $imaging->id }}">
                                            <label class="form-check-label" for="imaging_{{ $imaging->id }}">{{ $imaging->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-danger" id="removeSelection">Xóa tất cả</button>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">Lưu</button>
                <button class="btn btn-primary px-4 py-2 shadow-sm">Kết Thúc Khám</button>
                <button class="btn btn-danger px-4 py-2 shadow-sm">Hủy Khám</button>
            </div>
        </form>
    </div>
</main>
<script>
    // Hiển thị
    document.addEventListener("DOMContentLoaded", function() {
        let treatmentSelect = document.getElementById("treatment");
        let medicineSection = document.getElementById("medicine_section");
        let labSection = document.getElementById("lab_section");
        let revisitSection = document.getElementById("revisit_section");

        function toggleSections() {
            let treatment = treatmentSelect.value;

            // Ẩn cả hai trước khi hiển thị phần được chọn
            medicineSection.style.display = "none";
            labSection.style.display = "none";
            revisitSection.style.display = "none";

            if (treatment === "cap_toa") {
                medicineSection.style.display = "block";
                revisitSection.style.display = "block"; // Hiển thị ngày tái khám
            } else if (treatment === "can_lam_sang") {
                labSection.style.display = "block";
            }
        }

    // Gọi khi trang load để thiết lập đúng trạng thái ban đầu
        toggleSections();
        
        // Gọi mỗi khi người dùng thay đổi chọn lựa
        treatmentSelect.addEventListener("change", toggleSections);
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Thêm thuốc mới
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

    // Cập nhật danh sách xét nghiệm khi thay đổi loại cận lâm sàng
        document.addEventListener("change", function (event) {
            if (event.target.classList.contains("test-type")) {
                let selectedType = event.target.value;
                let clinicalTestSelect = event.target.closest("tr").querySelector(".clinical-test");

                // Xóa các tùy chọn cũ
                clinicalTestSelect.innerHTML = '<option value="">-- Chọn xét nghiệm --</option>';

                if (selectedType) {
                    let allOptions = document.querySelectorAll("#allClinicalTests option");

                    allOptions.forEach(option => {
                        if (option.getAttribute("data-type") === selectedType) {
                            clinicalTestSelect.appendChild(option.cloneNode(true));
                        }
                    });
                }
            }
        });
    });

document.addEventListener("DOMContentLoaded", function () {
    let serviceTypeCheckboxes = document.querySelectorAll(".test-type");
    let testGroups = document.querySelectorAll(".test-group");
    let removeSelectionBtn = document.getElementById("removeSelection");

    const typeMap = {
        "service_type_clinical": "clinical_test",
        "service_type_ultrasound": "ultrasound",
        "service_type_imaging": "imaging"
    };
    // Xử lý khi chọn loại dịch vụ
    serviceTypeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let type = typeMap[this.id]; // Đảm bảo lấy đúng giá trị data-type
            let relatedGroup = document.querySelector(`.test-group[data-type="${type}"]`);

            if (relatedGroup) {
                if (this.checked) {
                    relatedGroup.style.display = "block";
                } else {
                    relatedGroup.style.display = "none";
                    let inputs = relatedGroup.querySelectorAll("input[type='checkbox']");
                    inputs.forEach(input => input.checked = false);
                }
            }
        });
    });

    // Nút xóa tất cả lựa chọn
    removeSelectionBtn.addEventListener("click", function () {
        serviceTypeCheckboxes.forEach(cb => cb.checked = false);
        testGroups.forEach(group => {
            group.style.display = "none";
            let inputs = group.querySelectorAll("input[type='checkbox']");
            inputs.forEach(input => input.checked = false);
        });
    });
});

function populateMedicineModal(patientData) {
    document.getElementById("modal_patient_id").textContent = patientData.id || "";
    document.getElementById("modal_patient_name").textContent = patientData.name || "";
    document.getElementById("modal_patient_age").textContent = patientData.age || "";
    document.getElementById("modal_patient_gender").textContent = patientData.gender || "";
    document.getElementById("modal_exam_date").textContent = patientData.examDate || "";
    document.getElementById("modal_re_exam_date").textContent = patientData.reExamDate || "";
    document.getElementById("modal_diagnosis").textContent = patientData.diagnosis || "";
    
    let medicineListDisplay = document.getElementById("medicineListDisplay");
    medicineListDisplay.innerHTML = ""; // Xóa dữ liệu cũ

    if (patientData.medicines && patientData.medicines.length > 0) {
        patientData.medicines.forEach((medicine, index) => {
            let row = `<tr>
                <td class='text-center'>${index + 1}</td>
                <td>${medicine.name}</td>
                <td>${medicine.dosage}</td>
                <td class='text-center'>${medicine.quantity}</td>
                <td>${medicine.usage}</td>
            </tr>`;
            medicineListDisplay.innerHTML += row;
        });
    } else {
        medicineListDisplay.innerHTML = "<tr><td colspan='5' class='text-center text-muted'>Không có dữ liệu thuốc</td></tr>";
    }
}

// Hàm gọi khi mở modal
function openMedicineModal() {
    let medicines = [];
    document.querySelectorAll("#medicineList tr").forEach((row, index) => {
        let selectElement = row.querySelector("select");
        let dosageInput = row.querySelector("input[name*='dosage']");
        let quantityInput = row.querySelector("input[name*='quantity']");

        if (selectElement && dosageInput && quantityInput) {
            let medicine = {
                name: selectElement.selectedOptions[0].text,
                dosage: dosageInput.value,
                quantity: quantityInput.value,
                usage: Array.from(row.querySelectorAll("input[type='checkbox']:checked"))
                        .map(cb => cb.nextSibling.textContent.trim()).join(", ") || "Không xác định"
            };
            medicines.push(medicine);
        }
    });

    function getValue(selector, defaultValue = "N/A") {
        let element = document.querySelector(selector);
        return element ? element.value : defaultValue;
    }

    let patientData = {
        id: getValue("input[name='patient_id']"),
        name: getValue("input[name='patient_name']", "Chưa xác định"),
        idUser: getValue("input[name='patient_idUser']"),
        age: getValue("input[name='patient_age']"),
        gender: getValue("input[name='patient_gender']"),
        examDate: getValue("input[name='patient_examDate']"),
        reExamDate: getValue("input[name='re_exam_date']"),
        diagnosis: getValue("textarea[name='diagnosis']", "Chưa có"),
        medicines: medicines,
    };

    // Debug giá trị
    console.log("Patient Data:", patientData);

    populateMedicineModal(patientData);
    let medicineModal = new bootstrap.Modal(document.getElementById('medicineModal'));
    medicineModal.show();
}

$(document).ready(function() {
    // Lắng nghe sự kiện submit của form examForm
    $('#examForm').submit(function(event) {
        event.preventDefault(); // Ngăn chặn submit form mặc định

        $.ajax({
            url: $(this).attr('action'), // Lấy URL từ thuộc tính action của form
            type: 'PUT', // Hoặc GET, tùy thuộc vào route của bạn
            data: $(this).serialize(), // Gửi dữ liệu form
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Dữ liệu đã được lưu thành công, cập nhật modal và hiển thị

                    // Cập nhật nội dung modal với dữ liệu từ phản hồi JSON
                    $('#modal_patient_id').text(data.patient.id);
                    $('#modal_patient_name').text(data.patient.name);
                    $('#modal_patient_age').text(data.patient.age);
                    $('#modal_patient_gender').text(data.patient.gender);
                    $('#modal_exam_date').text(data.patient.exam_date);
                    $('#modal_diagnosis').text(data.patient.diagnosis);
                    $('#modal_re_exam_date').text(data.patient.re_exam);

                    // Cập nhật danh sách thuốc
                    var medicineList = '';
                    $.each(data.prescription.details, function(index, medicine) {
                        medicineList += '<tr>';
                        medicineList += '<td>' + (index + 1) + '</td>';
                        medicineList += '<td>' + medicine.medicine_id + '</td>'; // Hoặc tên thuốc nếu bạn có
                        medicineList += '<td>' + medicine.dosage + '</td>';
                        medicineList += '<td>' + medicine.quantity + '</td>';
                        medicineList += '<td>';
                        if (medicine.morning) medicineList += 'Sáng ';
                        if (medicine.noon) medicineList += 'Trưa ';
                        if (medicine.evening) medicineList += 'Chiều ';
                        if (medicine.night) medicineList += 'Tối';
                        medicineList += '</td>';
                        medicineList += '</tr>';
                    });
                    $('#medicineListDisplay').html(medicineList);

                    // Hiển thị modal
                    $('#medicineModal').modal('show');
                } else {
                    // Hiển thị thông báo lỗi nếu lưu không thành công
                    alert(data.message);
                }
            },
            error: function(error) {
                console.error('Lỗi AJAX:', error);
                alert('Có lỗi xảy ra khi lưu đơn thuốc.');
            }
        });
    });
});

function printPrescription() {
    // Lấy dữ liệu từ modal
    const patientId = document.getElementById("modal_patient_id").innerText;
    const patientName = document.getElementById("modal_patient_name").innerText;
    const patientAge = document.getElementById("modal_patient_age").innerText;
    const patientGender = document.getElementById("modal_patient_gender").innerText;
    const examDate = document.getElementById("modal_exam_date").innerText;
    const diagnosis = document.getElementById("modal_diagnosis").innerText;
    const reExamDate = document.getElementById("modal_re_exam_date").innerText;

    // Lấy nội dung modal
    const modalContent = document.querySelector("#medicineModal .data").innerHTML;

    // Tạo cửa sổ in mới
    const printWindow = window.open("", "", "width=900,height=700");

    // Chèn nội dung modal vào cửa sổ in
    printWindow.document.write(`
    <html>
    <head>
        <title>Đơn Thuốc</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 700px; margin: auto; }
            .header, .footer { text-align: center; }
            .info-row { display: flex; justify-content: space-between; }
            .info-col { width: 48%; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid black; padding: 8px; text-align: center; }
            .table thead { background-color: #f8f9fa; }
            hr { border: 1px solid #ccc; }
            @media print {
                .btn { display: none; } /* Ẩn nút khi in */
            }
        </style>
    </head>
    <body onload="window.print(); window.close();">
        <div class="container">
            <h5 class="fw-bold text-uppercase text-center" style="font-size: 24px">🩺 ĐƠN THUỐC</h5>
            <hr>
            <div class="header">
                <h4 class="fw-bold">🏥 BỆNH VIỆN XYZ</h4>
                <p>Địa chỉ: 123 Đường ABC, Quận X, TP.HCM</p>
                <p>Hotline: 0123 456 789</p>
                <hr>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <p><strong>Mã bệnh nhân: </strong>BN${patientId}</p>
                    <p><strong>Họ tên:</strong> ${patientName}</p>
                    <p><strong>Tuổi:</strong> ${patientAge}</p>
                </div>
                <div class="info-col">
                    <p><strong>Giới tính:</strong> ${patientGender}</p>
                    <p><strong>Ngày khám:</strong> ${examDate}</p>
                    <p><strong>Chẩn đoán:</strong> ${diagnosis}</p>
                </div>
            </div>
            <hr>

            ${modalContent}
            <hr>
            <div class="text-start mx-auto fw-bold text-danger" style="max-width: 500px;">
                <p>📆 Ngày tái khám: <span class="text-dark">${reExamDate}</span></p>
            </div>

            <div class="text-start mx-auto" style="max-width: 500px;">
                <strong>📌 Ghi chú:</strong>
                <ul>
                    <li>Uống đủ nước, nghỉ ngơi nhiều.</li>
                    <li>Tái khám nếu triệu chứng không giảm sau 5 ngày.</li>
                </ul>
            </div>

            <hr>
        </div>
    </body>
    </html>`);

    // Đóng tài liệu để tải nội dung
    printWindow.document.close();
}



</script>
    
@endsection
