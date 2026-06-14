@extends('layouts.admin')
@section('title','Editar Programa')
@section('page-title','✏️ Editar Programa')
@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.programs.index') }}" class="text-gray-400 hover:text-teal-500 font-semibold text-sm mb-6 inline-block">← Volver</a>

    <div class="card-admin p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>

        <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre del programa *</label>
                <input name="name" type="text" required value="{{ old('name',$program->name) }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Locutor / Host</label>
                <input name="host" type="text" value="{{ old('host',$program->host) }}" class="input-admin">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Descripción</label>
                <textarea name="description" rows="3" class="input-admin resize-none">{{ old('description',$program->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Hora inicio *</label>
                    <input name="start_time" type="time" required value="{{ old('start_time', substr($program->start_time,0,5)) }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Hora fin *</label>
                    <input name="end_time" type="time" required value="{{ old('end_time', substr($program->end_time,0,5)) }}" class="input-admin">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Días de transmisión *</label>
                <select name="day_type" required class="select-admin">
                    <option value="lunes_viernes" {{ old('day_type',$program->day_type)=='lunes_viernes' ? 'selected':'' }}>Lunes a Viernes</option>
                    <option value="sabados"       {{ old('day_type',$program->day_type)=='sabados'       ? 'selected':'' }}>Sábados</option>
                    <option value="domingos"      {{ old('day_type',$program->day_type)=='domingos'      ? 'selected':'' }}>Domingos</option>
                    <option value="todos"         {{ old('day_type',$program->day_type)=='todos'         ? 'selected':'' }}>Todos los días</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Color identificador</label>
                <div class="flex items-center gap-3">
                    <input name="color" type="color" value="{{ old('color',$program->color) }}"
                           class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer">
                    <span class="text-xs text-gray-400">Color actual del programa</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <input name="active" type="checkbox" id="active" value="1"
                       class="accent-teal-400 w-4 h-4" {{ old('active',$program->active) ? 'checked':'' }}>
                <label for="active" class="text-sm font-semibold text-gray-600">Programa activo</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-admin">Guardar Cambios</button>
                <a href="{{ route('admin.programs.index') }}"
                   class="px-5 py-2.5 rounded-lg font-bold text-gray-500 border hover:bg-gray-50 transition text-sm"
                   style="border-color:#e0faf5;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection