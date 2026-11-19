@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="mx-auto max-w-6xl">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Pesan Masuk (Messages)</h1>
            <p class="mt-1 text-sm text-slate-600">Daftar pesan yang dikirim pengunjung melalui halaman kontak.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left font-semibold text-slate-700">
                <tr>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Pengirim</th>
                    <th class="px-4 py-3">Subjek</th>
                    <th class="px-4 py-3">Waktu Kirim</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($contacts as $contact)
                    <tr class="{{ $contact->is_read ? 'bg-white' : 'bg-blue-50/40 font-medium' }}">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if ($contact->is_read)
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">
                                    Sudah dibaca
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800">
                                    Belum dibaca
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-slate-900">{{ $contact->name }}</div>
                            <div class="text-xs text-slate-500">{{ $contact->email }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-700">
                            {{ $contact->subject ?: '(Tanpa Subjek)' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-slate-500">
                            {{ $contact->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('contacts.show', $contact) }}"
                               class="font-semibold text-blue-600 hover:underline">
                                Baca Pesan
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
</div>
@endsection