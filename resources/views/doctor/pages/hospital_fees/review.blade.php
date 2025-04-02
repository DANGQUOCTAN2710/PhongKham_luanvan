<div class="modal fade" id="hospitalFeeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center w-100 d-block">
                <h5 class="modal-title fw-bold text-uppercase text-center" style="font-size: 24px">💰 VIỆN PHÍ</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="fw-bold">🏥 BỆNH VIỆN XYZ</h4>
                <p>Địa chỉ: 123 Đường ABC, Quận X, TP.HCM</p>
                <p>Hotline: 0123 456 789</p>
                <hr>

                <div class="row text-start mx-auto" style="max-width: 700px;">
                    <div class="col-md-6">
                        <p><strong>Mã bệnh nhân:</strong> BN<span id="modal_patient_id"></span></p>
                        <p><strong>Họ tên:</strong> <span id="modal_patient_name"></span></p>
                        <p><strong>Tuổi:</strong> <span id="modal_patient_age"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>CCCD:</strong> <span id="modal_patient_idUser"></span></p>
                        <p><strong>Giới tính:</strong> <span id="modal_patient_gender"></span></p>
                        <p><strong>Lý do khám:</strong> <span id="modal_patient_reason"></span></p>
                    </div>
                </div>
                <hr>

                <!-- Đơn thuốc -->
                <div class="table-responsive">
                    <h5 class="text-primary">🔹 Đơn Thuốc</h5>
                    <table class="table table-bordered mx-auto" style="max-width: 700px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Tên Thuốc</th>
                                <th>Số Lượng</th>
                                <th>Đơn Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody id="hospitalFeeMedicineList"></tbody>
                    </table>
                </div>

                <hr>

                <!-- Cận Lâm Sàng -->
                <div class="table-responsive" id="hospitalFeeTestSection" style="display: none;">
                    <h5 class="text-primary">🔹 Cận Lâm Sàng</h5>

                    <!-- Xét nghiệm -->
                    <div id="hospitalFeeClinicalTestsSection" style="display: none;">
                        <h6>Xét nghiệm</h6>
                        <table class="table table-bordered mx-auto" style="max-width: 700px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Dịch Vụ</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody id="hospitalFeeClinicalTestsList"></tbody>
                        </table>
                    </div>

                    <!-- Siêu âm -->
                    <div id="hospitalFeeUltrasoundSection" style="display: none;">
                        <h6>Siêu Âm</h6>
                        <table class="table table-bordered mx-auto" style="max-width: 700px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Dịch Vụ</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody id="hospitalFeeUltrasoundList"></tbody>
                        </table>
                    </div>

                    <!-- X-quang -->
                    <div id="hospitalFeeImagingSection" style="display: none;">
                        <h6>X-quang</h6>
                        <table class="table table-bordered mx-auto" style="max-width: 700px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Dịch Vụ</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody id="hospitalFeeImagingList"></tbody>
                        </table>
                    </div>
                </div>

                <hr>

                <!-- Tổng viện phí -->
                <div class="text-start mx-auto" style="max-width: 500px;">
                    <p><strong>Phí khám: </strong> <span id=""></span>100000</p>
                    <p><strong>Tổng thuốc:</strong> <span id="modal_total_medicine"></span></p>
                    <p style="display:none;"><strong>Tổng cận lâm sàng:</strong> <span id="modal_total_test"></span></p>
                    <p class="fw-bold text-danger"><strong>Tổng viện phí:</strong> <span id="modal_total_fee"></span></p>
                </div>

                
                
                <hr>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="printHospitalFee()">🖨 In Viện Phí</button>
                </div>
            </div>
        </div>
    </div>
</div>
