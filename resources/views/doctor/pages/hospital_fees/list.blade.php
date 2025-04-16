@extends('doctor.layouts.app')

@section('content')
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Viện Phí</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên, CCCD, SĐT..." value="{{ request()->search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách viện phí -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã BN</th>
                    <th>Họ và Tên</th>
                    <th>CCCD</th>
                    <th>Số Điện Thoại</th>
                    <th>Phí Khám</th>
                    <th>Phí Thuốc</th>
                    <th>Phí Cận Lâm Sàng</th>
                    <th>Tổng Viện Phí</th>
                    <th>Đã Thanh Toán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fee_list as $fee)
                    <tr>
                        <td>{{ $fee->id }}</td>
                        <td>{{ optional($fee->medicalRecord->medicalBook->patient)->name }}</td>
                        <td>{{ optional($fee->medicalRecord->medicalBook->patient)->idUser }}</td>
                        <td>{{ optional($fee->medicalRecord->medicalBook->patient)->phone }}</td>
                        <td>{{ number_format($fee->examination_fee, 0, ',', '.') }} đ</td>
                        <td>{{ number_format($fee->medicine_fee, 0, ',', '.') }} đ</td>
                        <td>{{ number_format($fee->clinical_fee, 0, ',', '.') }} đ</td>
                        <td class="fw-bold">{{ number_format($fee->total_fee, 0, ',', '.') }} đ</td>
                        <td>
                            @if($fee->status == 'Đã thanh toán')
                                <span class="text-success">Đã thanh toán</span>
                            @else
                                <span class="text-warning">Chưa thanh toán</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Nút Xem chi tiết -->
                                <a href="javascript:void(0)" 
                                class="btn btn-info btn-lg d-flex align-items-center justify-content-center"
                                onclick="openHospitalFeeModal({{ $fee->id }})">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('payment.approve', $fee->id  ) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Hoặc POST tùy vào cách bạn muốn xử lý -->
                                    <button type="submit" class="btn btn-success btn-lg d-flex align-items-center justify-content-center">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </div>
                            @include('doctor.pages.hospital_fees.review')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
<script>

function openHospitalFeeModal(feeId) {
    fetch(`/doctor/fee/${feeId}`)
        .then(response => response.json())
        .then(data => {
            // Cập nhật thông tin bệnh nhân
            document.getElementById('modal_patient_id').textContent = data.patientId;
            document.getElementById('modal_patient_name').textContent = data.patient_name;
            document.getElementById('modal_patient_age').textContent = data.patient_age;
            document.getElementById('modal_patient_idUser').textContent = data.idUser;
            document.getElementById('modal_patient_gender').textContent = data.patient_gender;
            document.getElementById('modal_patient_reason').textContent = data.reason;
            console.log(data);  // Kiểm tra dữ liệu
            if(data.prescription_details.length > 0){
                document.getElementById('hospitalMedicineSection').style.display = 'block';
                if (data.prescription_details) {
                    let medicineListHtml = '';
                    data.prescription_details.forEach((medicine, index) => {
                        medicineListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${medicine.name}</td>
                                <td>${medicine.quantity}</td>
                                <td>${medicine.unit_price}</td>
                                <td>${medicine.total_price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeMedicineList').innerHTML = medicineListHtml;
                }
            }
            else{
                document.getElementById('hospitalMedicineSection').style.display = 'none';   
            }
            
            if(data.clinical_tests.length > 0 || data.ultrasounds.length > 0 || data.diagnostic_imaging.length > 0){
                document.getElementById('hospitalFeeTestSection').style.display = 'block';
                if (data.clinical_tests) {
                let clinicalTestListHtml = '';
                data.clinical_tests.forEach((test, index) => {
                    clinicalTestListHtml += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${test.name}</td>
                            <td>${test.unit_price}</td>
                            <td>${test.total_price}</td>
                        </tr>
                    `;
                });
                document.getElementById('hospitalFeeClinicalTestsList').innerHTML = clinicalTestListHtml;
                document.getElementById('modal_total_test').parentElement.style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeClinicalTestsSection').style.display = 'none';
                }

                // Kiểm tra nếu có Siêu âm
                if (data.ultrasounds) {
                    let ultrasoundListHtml = '';
                    data.ultrasounds.forEach((ultrasound, index) => {
                        ultrasoundListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${ultrasound.name}</td>
                                <td>${ultrasound.unit_price}</td>
                                <td>${ultrasound.total_price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeUltrasoundList').innerHTML = ultrasoundListHtml;
                    document.getElementById('hospitalFeeUltrasoundSection').style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeUltrasoundSection').style.display = 'none';
                }

                // Kiểm tra nếu có X-quang
                if (data.imaging) {
                    let imagingListHtml = '';
                    data.imaging.forEach((imaging, index) => {
                        imagingListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${imaging.name}</td>
                                <td>${imaging.unit_price}</td>
                                <td>${imaging.total_price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeImagingList').innerHTML = imagingListHtml;
                    document.getElementById('hospitalFeeImagingSection').style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeImagingSection').style.display = 'none';
                }    
            }
            else{
                document.getElementById('hospitalFeeTestSection').style.display = 'none';
            }
            
            // Cập nhật tổng viện phí
            document.getElementById('modal_total_medicine').textContent = data.total_medicine_fee;
            if(data.total_clinical_fee != 0 && data.total_ultrasound_fee != 0  && data.total_diagnostic_imaging_fee != 0){
                document.getElementById('modal_total_test').textContent = data.total_clinical_fee + data.total_ultrasound_fee + data.total_diagnostic_imaging_fee;
            }
            document.getElementById('modal_total_fee').textContent = data.total_fee;
            // Mở modal
            const hospitalFeeModal = new bootstrap.Modal(document.getElementById('hospitalFeeModal'));
            hospitalFeeModal.show();
        })
        .catch(error => console.error('Error fetching patient data:', error));
}

function printHospitalFee() {
    // Lấy nội dung modal viện phí
    const modalContent = document.getElementById('hospitalFeeModal');

    // Mở cửa sổ mới để in
    const printWindow = window.open('', '', 'width=800,height=600');
    
    // Ghi nội dung vào cửa sổ in
    printWindow.document.write('<html><head><title>In Viện Phí</title><style>');
    // Bạn có thể thêm CSS tại đây để tùy chỉnh giao diện in
    printWindow.document.write('body { font-family: Arial, sans-serif; }');
    printWindow.document.write('.modal-content { width: 100%; padding: 20px; }');
    printWindow.document.write('</style></head><body>');
    printWindow.document.write(modalContent.innerHTML); // Thêm nội dung modal vào cửa sổ in
    printWindow.document.write('</body></html>');

    // Đóng tài liệu để chuẩn bị in
    printWindow.document.close();

    // Mở hộp thoại in của trình duyệt
    printWindow.print();
}

</script>
@endsection
