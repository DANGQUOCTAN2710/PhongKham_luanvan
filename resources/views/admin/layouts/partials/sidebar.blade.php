<div class="bg-primary border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-white fw-bold text-center py-3">Quản Lý</div>
    <div class="list-group list-group-flush">

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-chart-line sidebar-icon"></i> <span class="sidebar-text">Dashboard</span>
        </a>

        <!-- QUẢN LÝ PHÒNG KHÁM -->
        <div class="sidebar-section text-white fw-bold px-3 py-2">Quản Lý Phòng Khám</div>
        <a href="{{ route('clinics.index') }}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-hospital sidebar-icon"></i> <span class="sidebar-text">Phòng Khám</span>
        </a>
        <a href="{{ route('doctors.index') }}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-user-md sidebar-icon"></i> <span class="sidebar-text">Bác Sĩ</span>
        </a>
        <a href="{{ route('staffs.index') }}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-user-nurse sidebar-icon"></i> <span class="sidebar-text">Nhân Viên</span>
        </a>
        <a href="{{ route('patients.index')}}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-hospital-user sidebar-icon"></i> <span class="sidebar-text">Bệnh Nhân</span>
        </a>
        <a href="{{ route('medicines.index') }}" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-pills sidebar-icon"></i> <span class="sidebar-text">Thuốc</span>
        </a>

        <!-- DUYỆT ĐƠN -->
        <div class="sidebar-section text-white fw-bold px-3 py-2">Duyệt</div>
        <a href="" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-check-circle sidebar-icon"></i> <span class="sidebar-text">Duyệt Phòng Khám</span>
        </a>
        <a href="" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-user-check sidebar-icon"></i> <span class="sidebar-text">Duyệt Bác Sĩ</span>
        </a>
        <a href="" class="list-group-item list-group-item-action sidebar-item">
            <i class="fas fa-file-medical sidebar-icon"></i> <span class="sidebar-text">Duyệt Đơn Thuốc</span>
        </a>

    </div>
</div>
`