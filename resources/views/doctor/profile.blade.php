@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Hồ sơ cá nhân</h2>

    <form method="POST" action="{{ route('doctor.profile.update') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="specialization" class="form-label">Chuyên môn</label>
            <input type="text" name="specialization" class="form-control" value="{{ Auth::user()->specialization }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
