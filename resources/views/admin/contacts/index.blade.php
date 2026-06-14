@extends('layouts.admin')
@section('title','Mensajes')
@section('page-title','📬 Mensajes de Contacto')
@section('content')

<div class="card-admin overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background:linear-gradient(90deg,#f0fffc,#fffbf0);">
            <tr>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase">Remitente</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Asunto</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Fecha</th>
                <th class="text-left px-5 py-3 text-gray-500 font-bold text-xs uppercase">Estado</th>
                <th class="text-right px-5 py-3 text-gray-500 font-bold text-xs uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y" style="border-color:#f0f0f0;">
            @forelse($contacts as $contact)
            <tr class="hover:bg-gray-50 transition {{ !$contact->read ? 'bg-teal-50/30' : '' }}">
                <td class="px-5 py-4">
                    <p class="font-bold text-gray-800 text-sm">{{ $contact->name }}</p>
                    <p class="text-gray-400 text-xs">{{ $contact->email }}</p>
                </td>
                <td class="px-5 py-4 hidden md:table-cell text-gray-600 text-xs font-semibold">{{ $contact->subject }}</td>
                <td class="px-5 py-4 hidden md:table-cell text-gray-400 text-xs">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-5 py-4">
                    @if(!$contact->read)
                    <span class="text-xs font-bold text-white px-2 py-1 rounded-full"
                          style="background:#f8961e;">Nuevo</span>
                    @else
                    <span class="text-xs font-bold text-gray-400 px-2 py-1 rounded-full bg-gray-100">Leído</span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.contacts.show', $contact) }}"
                           class="text-xs px-3 py-1.5 rounded-lg font-bold border hover:shadow transition"
                           style="border-color:#b2f0e0; color:#00a896;">Ver</a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                              onsubmit="return confirm('¿Eliminar este mensaje?')">
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
                    <p class="text-4xl mb-3">📬</p>
                    <p class="font-semibold">No hay mensajes aún.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $contacts->links() }}</div>
@endsection