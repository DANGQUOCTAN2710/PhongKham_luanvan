
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}" 
                    href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Tổng quan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.patient') ? 'active' : '' }}" 
                    href="{{ route('doctor.patient') }}">
                        <i class="fas fa-users"></i> Danh sách bệnh nhân
                    </a>
                </li>
                @if(Auth::user()->role === 'staff' && Auth::user()->staff->position == 'Tiếp đón')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('receive.index') ? 'active' : '' }}" 
                        href="{{ route('receive.index') }}">
                            <i class="fas fa-users"></i> Tiếp nhận bệnh nhân
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role === 'doctor')
                    @if(Auth::user()->doctor && Auth::user()->doctor->type == 'Điều trị')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#examMenu1" role="button">
                                <i class="fas fa-stethoscope"></i> Khám bệnh <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <div class="collapse {{ request()->routeIs('doctor.exam_waiting', 'doctor.exam', 'doctor.lab') ? 'show' : '' }}" id="examMenu1">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('doctor.exam_waiting') ? 'active' : '' }}" href="{{route('doctor.exam_waiting')}}">
                                            <i class="fas fa-list"></i> Danh sách khám
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('doctor.exam') ? 'active' : '' }}" href="{{route('doctor.exam')}}">
                                            <i class="fas fa-notes-medical"></i> Lâm sàng
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('doctor.lab') ? 'active' : '' }}" href="{{route('doctor.lab')}}">
                                            <i class="fas fa-notes-medical"></i> Cận lâm sàng
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if(Auth::user()->doctor && Auth::user()->doctor->type == 'Cận lâm sàng')
                        <li class="nav-item">
                            
                            <a class="nav-link {{ request()->routeIs('doctor.lab_waiting') ? 'active' : '' }}" 
                                href="{{ route('doctor.lab_waiting') }}">
                                    <i class="fas fa-users"></i> Yêu cầu xét nghiệm
                            </a>
                        </li>
                     @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#labMenu" role="button">
                        <i class="fas fa-calendar-alt"></i> Lịch hẹn <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="labMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="{{ route('doctor.schedule') }}"><i class="fas fa-calendar-check"></i> Lịch hẹn khám</a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-sync-alt"></i> Hẹn tái khám</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctor.fee') }}">
                        <i class="fas fa-money-bill-wave"></i> Viện phí
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-prescription"></i> Đơn thuốc
                    </a>
                </li>
            </ul>
        </div>
    </nav>