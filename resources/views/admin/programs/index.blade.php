@extends('layouts.admin')
@section('title','Programación')
@section('page-title','📅 Gestionar Programación')
@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $programs->total() }} programas en total</p>
    <a href="{{ route('admin.programs.create') }}" class="btn-admin">+ Nuevo Programa</a>
</div>

<div class="card-admin overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background:linear-gradient(90deg,#f0fffc,#fffbf0);">
            <tr>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase">Programa</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Horario</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Días</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Estado</th>
                <th class="text-right px-5 py-3 text-gray-500 font-bold text-xs uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y" style="border-color:#f0f0f0;">
            @forelse($programs as $program)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-10 rounded-full flex-shrink-0" style="background:{{ $program->color }};"></div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $program->name }}</p>
                            @if($program->host)
                            <p class="text-xs text-gray-400">🎙 {{ $program->host }}</p>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 hidden md:table-cell text-gray-600 font-semibold text-xs">
                    {{ substr($program->start_time,0,5) }} — {{ substr($program->end_time,0,5) }}
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <span class="text-xs font-bold text-white px-2 py-1 rounded-full"
                          style="background:{{ $program->color }};">{{ $program->day_label }}</span>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <span class="text-xs font-bold px-2 py-1 rounded-full"
                          style="{{ $program->active ? 'background:#e0fff8; color:#00a896;' : 'background:#f5f5f5; color:#999;' }}">
                        {{ $program->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.programs.edit', $program) }}"
                           class="text-xs px-3 py-1.5 rounded-lg font-bold border hover:shadow transition"
                           style="border-color:#b2f0e0; color:#00a896;">Editar</a>
                        <form method="POST" action="{{ route('admin.programs.destroy', $program) }}"
                              onsubmit="return confirm('¿Eliminar este programa?')">
                            @csrf @method('DELETE')
                            <button class="text-xs px-3 py-1.5 rounded-lg font-bold border border-red-200 text-red-400 hover:bg-red-50 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-16 text-gray-400">
                    <p class="text-4xl mb-3">📅</p>
                    <p class="font-semibold">No hay programas aún.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $programs->links() }}</div>
@endsection