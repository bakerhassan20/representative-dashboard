@extends('layouts.app')

@section('title', 'المدن')

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h4 class="page-title">المدن</h4>
        <p class="page-subtitle">إدارة بيانات المدن</p>
    </div>
  
    <a href="{{ route('cities.create') }}" class="btn-modern-primary">
        <i class="bi bi-plus-lg"></i> إضافة مدينة
    </a>
   
</div>



{{-- Search --}}
<div class="card p-4 mb-4 border-0">
    <form method="GET" class="d-flex gap-3 align-items-center">
        <div class="search-input-wrapper flex-grow-1">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="form-control search-input"
                   placeholder="ابحث باسم المدينة ..."
                   value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-modern-primary">
            <i class="bi bi-search"></i> بحث
        </button>
        @if(request('search'))
            <a href="{{ route('cities.index') }}" class="btn-modern-secondary">
                <i class="bi bi-x-lg"></i> مسح
            </a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="card border-0">
    <div class="table-responsive">
        <table class="table table-premium align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المدينة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $city)
                <tr>
                    <td class="text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-user-cell">
                            <div class="table-user-icon">{{ mb_substr($city->name, 0, 1) }}</div>
                            <span class="fw-bold">{{ $city->name }}</span>
                        </div>
                    </td>
                   
                    
                  
                    

                    
                    
                    <td>
                        <div class="d-flex gap-2">
                         
                            <a href="{{ route('cities.edit', $city->id) }}" class="action-btn action-btn-edit" title="تعديل">
                                <i class="bi bi-pencil"></i>
                            </a>
                          
                          
                            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه المدينة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="حذف">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                          
                         
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p>لا يوجد مدن مسجلة بعد</p>
                            <a href="{{ route('cities.create') }}" class="btn-modern-primary mt-2">إضافة أول مدينة</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $cities->links('vendor.pagination.bootstrap-5') }}
</div>


@endsection