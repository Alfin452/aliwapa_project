<x-app-layout>
    {{--
        PERBAIKAN LOGIKA ALPINE JS:
        Sekarang kita mengecek old('form_type').
        - Jika form_type == 'create', maka openCreate = true.
        - Jika form_type == 'update', maka openEdit = true.
    --}}
    <div x-data="{ 
            openCreate: {{ $errors->any() && old('form_type') == 'create' ? 'true' : 'false' }},
            openEdit: {{ $errors->any() && old('form_type') == 'update' ? 'true' : 'false' }},
            editData: { id: '', name: '', email: '', role: '', action: '' },

            openEditModal(id, name, email, role, url) {
                this.editData.id = id;
                this.editData.name = name;
                this.editData.email = email;
                this.editData.role = role;
                this.editData.action = url;
                this.openEdit = true;
            }
        }"
        class="bg-slate-50 min-h-screen pb-20">

        {{-- HEADER (Tema Indigo) --}}
        <div class="bg-white border-b border-gray-200 pt-8 pb-6 px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">

                {{-- Judul --}}
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-600 p-2.5 rounded-xl text-white shadow-lg shadow-indigo-600/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen User</h2>
                        <p class="text-sm text-gray-500">Kelola Akun Karyawan & Admin</p>
                    </div>
                </div>

                {{-- Tombol Tambah --}}
                <div class="flex gap-3 w-full md:w-auto">
                    <button @click="openCreate = true" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span>Tambah User</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- CONTENT TABLE --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

            {{-- Alert --}}
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Alert Error Global --}}
            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-indigo-50/50 border-b border-indigo-100 text-xs uppercase text-indigo-900 font-semibold tracking-wider">
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4 text-center">Role / Jabatan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'admin')
                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold border border-indigo-200">
                                    Admin
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                    Karyawan
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        @click="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ route('users.update', $user->id) }}')"
                                        class="p-2 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data user lain.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        {{-- ============================== --}}
        {{-- MODAL 1: CREATE USER BARU      --}}
        {{-- ============================== --}}
        <div x-show="openCreate" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openCreate = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative z-10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Tambah User Baru</h3>
                        <button @click="openCreate = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        {{-- IDENTITAS FORM: CREATE --}}
                        <input type="hidden" name="form_type" value="create">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Role / Jabatan</label>
                                <select name="role" class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="karyawan">Karyawan (Staff)</option>
                                    <option value="admin">Admin (Full Akses)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <div class="flex gap-3 pt-4 border-t border-gray-100 mt-6">
                                <button type="button" @click="openCreate = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 shadow-lg">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ============================== --}}
        {{-- MODAL 2: EDIT USER             --}}
        {{-- ============================== --}}
        <div x-show="openEdit" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openEdit = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative z-10 border-t-4 border-orange-500">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Edit User</h3>
                            <p class="text-sm text-gray-500">Update data karyawan.</p>
                        </div>
                        <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    {{-- Form Edit --}}
                    <form :action="editData.action" method="POST">
                        @csrf @method('PUT')
                        {{-- IDENTITAS FORM: UPDATE (Kunci Masalahnya Disini) --}}
                        <input type="hidden" name="form_type" value="update">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" x-model="editData.name" class="w-full rounded-xl border-gray-300 focus:ring-orange-500" required>
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" x-model="editData.email" class="w-full rounded-xl border-gray-300 focus:ring-orange-500" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Role / Jabatan</label>
                                <select name="role" x-model="editData.role" class="w-full rounded-xl border-gray-300 focus:ring-orange-500">
                                    <option value="karyawan">Karyawan (Staff)</option>
                                    <option value="admin">Admin (Full Akses)</option>
                                </select>
                            </div>

                            <hr class="border-gray-100 my-4">

                            {{-- Ganti Password (Opsional) --}}
                            {{-- Ganti Password (Opsional) --}}
                            <div class="bg-orange-50 p-4 rounded-xl border border-orange-100">
                                <p class="text-xs font-bold text-orange-600 mb-3 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Ganti Password (Opsional)
                                </p>
                                <div class="space-y-3">
                                    {{-- TAMBAHKAN: autocomplete="new-password" --}}
                                    <input type="password" name="password" autocomplete="new-password" placeholder="Password Baru (Kosongkan jika tidak ganti)" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 text-sm">

                                    <input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Ulangi Password Baru" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 text-sm">

                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>
                            </div>

                            <div class="flex gap-3 pt-4 mt-2">
                                <button type="button" @click="openEdit = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 shadow-lg">Update User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>