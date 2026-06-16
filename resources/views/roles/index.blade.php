@extends('layouts.app')

@section('title', 'الصلاحيات')

@section('content')

<div class="page-header">
    <div>
        <h4 class="page-title">الصلاحيات</h4>
        <p class="page-subtitle">إدارة أدوار وصلاحيات النظام</p>
    </div>
    <a href="{{ route('roles.create') }}" class="btn-modern-primary">
        <i class="bi bi-plus-lg"></i> إضافة دور
    </a>
</div>

<div class="card border-0">
    <div class="table-responsive">
        <table class="table table-premium align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الدور</th>
                    <th>الصلاحيات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                <tr>
                    <td class="text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-user-cell">
                            <div class="table-user-icon" style="background: rgba(139,92,246,0.1); color: #8b5cf6;">
                                <i class="bi bi-shield"></i>
                            </div>
                            <span class="fw-bold">{{ $role->name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            @forelse($role->permissions as $permission)
                                <span class="perm-badge">{{ $permission->name }}</span>
                            @empty
                                <span class="text-muted">لا يوجد صلاحيات</span>
                            @endforelse
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="action-btn action-btn-edit" title="تعديل">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-shield-lock"></i>
                            <p>لا يوجد أدوار مسجلة بعد</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection