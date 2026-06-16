@extends('layouts.admin')
@section('title','Nuevo Slider')
@section('page-title','🖼️ Nuevo Slider')
@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.sliders.index') }}"
       class="text-gray-400 hover:text-teal-500 font-semibold text-sm mb-6 inline-block">← Volver</a>

    <div class="card-admin p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>

        <form method="POST" action="{{ route('admin.sliders.store') }}" class="space-y-5">
            @csrf

            {{-- Upload Firebase --}}
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Imagen del Slider *</label>
                <div class="border-2 border-dashed rounded-xl p-6 text-center cursor-pointer hover:border-teal-400 transition"
                     style="border-color:#b2f0e0; background:#f8fffd;"
                     onclick="document.getElementById('file-input').click()">
                    <div id="preview-container" class="hidden mb-3">
                        <img id="image-preview" src="" alt="Preview"
                             class="w-full h-48 object-cover rounded-xl">
                    </div>
                    <div id="upload-placeholder">
                        <p class="text-4xl mb-2">📷</p>
                        <p class="font-bold text-gray-600 text-sm">Haz clic para subir una imagen</p>
                        <p class="text-gray-400 text-xs mt-1">JPG, PNG, WebP · Máx 5MB</p>
                    </div>
                    <div id="upload-progress" class="hidden">
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div id="progress-bar" class="h-2 rounded-full transition-all"
                                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8); width:0%"></div>
                        </div>
                        <p id="progress-text" class="text-xs text-gray-500">Subiendo...</p>
                    </div>
                </div>
                <input type="file" id="file-input" accept="image/*" class="hidden">
                <input type="hidden" name="image" id="image-url" required>
                @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Título</label>
                <input name="title" type="text" value="{{ old('title') }}"
                       placeholder="Ej: Radio Paraíso TV Digital" class="input-admin">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Subtítulo</label>
                <input name="subtitle" type="text" value="{{ old('subtitle') }}"
                       placeholder="Ej: Los Grandes Clásicos de la Música" class="input-admin">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Texto del botón</label>
                    <input name="button_text" type="text" value="{{ old('button_text') }}"
                           placeholder="Ej: Ver Programación" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">URL del botón</label>
                    <input name="button_url" type="url" value="{{ old('button_url') }}"
                           placeholder="https://..." class="input-admin">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Orden</label>
                    <input name="order" type="number" value="{{ old('order', 0) }}"
                           min="0" class="input-admin">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-2">
                        <input name="active" type="checkbox" id="active" value="1"
                               class="accent-teal-400 w-4 h-4" checked>
                        <label for="active" class="text-sm font-semibold text-gray-600">Slider activo</label>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" id="submit-btn" class="btn-admin" disabled
                        style="opacity:0.5; cursor:not-allowed;">
                    Crear Slider
                </button>
                <a href="{{ route('admin.sliders.index') }}"
                   class="px-5 py-2.5 rounded-lg font-bold text-gray-500 border hover:bg-gray-50 transition text-sm"
                   style="border-color:#e0faf5;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
import { getStorage, ref, uploadBytesResumable, getDownloadURL }
    from "https://www.gstatic.com/firebasejs/10.7.0/firebase-storage.js";

const firebaseConfig = {
    apiKey:            "{{ env('FIREBASE_API_KEY') }}",
    authDomain:        "{{ env('FIREBASE_AUTH_DOMAIN') }}",
    projectId:         "{{ env('FIREBASE_PROJECT_ID') }}",
    storageBucket:     "{{ env('FIREBASE_STORAGE_BUCKET') }}",
    messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
    appId:             "{{ env('FIREBASE_APP_ID') }}"
};

const app     = initializeApp(firebaseConfig);
const storage = getStorage(app);

document.getElementById('file-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validar tamaño
    if (file.size > 5 * 1024 * 1024) {
        alert('La imagen no puede superar 5MB');
        return;
    }

    // Mostrar progreso
    document.getElementById('upload-placeholder').classList.add('hidden');
    document.getElementById('upload-progress').classList.remove('hidden');

    // Subir a Firebase Storage
    const storageRef = ref(storage, `sliders/${Date.now()}_${file.name}`);
    const uploadTask = uploadBytesResumable(storageRef, file);

    uploadTask.on('state_changed',
        (snapshot) => {
            const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('progress-text').textContent = `Subiendo... ${Math.round(progress)}%`;
        },
        (error) => {
            console.error('Error:', error);
            alert('Error al subir la imagen. Intenta de nuevo.');
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('upload-progress').classList.add('hidden');
        },
        async () => {
            const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);

            // Guardar URL en el campo hidden
            document.getElementById('image-url').value = downloadURL;

            // Mostrar preview
            document.getElementById('image-preview').src = downloadURL;
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('upload-progress').classList.add('hidden');

            // Habilitar botón
            const btn = document.getElementById('submit-btn');
            btn.removeAttribute('disabled');
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';

            document.getElementById('progress-text').textContent = '✅ Imagen subida correctamente';
        }
    );
});
</script>
@endpush