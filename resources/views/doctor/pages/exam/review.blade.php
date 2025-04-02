<div class="modal fade" id="medicineModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center w-100 d-block">
                <h5 class="modal-title fw-bold text-uppercase text-center" style="font-size: 24px">🩺 ĐƠN THUỐC</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="fw-bold">🏥 BỆNH VIỆN XYZ</h4>
                <p>Địa chỉ: 123 Đường ABC, Quận X, TP.HCM</p>
                <p>Hotline: 0123 456 789</p>
                <hr>

                <div class="row text-start mx-auto" style="max-width: 700px;">
                    <div class="col-md-6">
                        <p><strong>Mã bệnh nhân: </strong>BN<span id="modal_patient_id"></span></p>
                        <p><strong>Họ tên:</strong> <span id="modal_patient_name"></span></p>
                        <p><strong>Tuổi:</strong> <span id="modal_patient_age"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Giới tính:</strong> <span id="modal_patient_gender"></span></p>
                        <p><strong>Ngày khám:</strong> <span id="modal_exam_date"></span></p>
                        <p><strong>Chẩn đoán:</strong> <span id="modal_diagnosis"></span></p>
                    </div>
                </div>
                <hr>

                <div class="table-responsive data">
                    <table class="table table-bordered mx-auto" style="max-width: 700px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Tên Thuốc</th>
                                <th>Liều Dùng</th>
                                <th>Số Lượng</th>
                                <th>Cách Dùng</th>
                            </tr>
                        </thead>
                        <tbody id="medicineListDisplay"></tbody>
                    </table>
                </div>

                <hr>

                <div class="text-start mx-auto fw-bold text-danger" style="max-width: 500px;">
                    <p>📆 Ngày tái khám: <span id="modal_re_exam_date" class="text-dark"></span></p>
                </div>

                <div class="text-start mx-auto" style="max-width: 500px;">
                    <strong>📌 Ghi chú:</strong>
                    <ul>
                        <li>Uống đủ nước, nghỉ ngơi nhiều.</li>
                        <li>Tái khám nếu triệu chứng không giảm sau 5 ngày.</li>
                    </ul>
                </div>

                <hr>

                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="printPrescription()">🖨 In Đơn Thuốc</button>
                </div>
            </div>
        </div>
    </div>
</div>
