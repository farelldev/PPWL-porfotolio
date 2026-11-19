@extends('layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-4">
        <a href="{{ route('contacts.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
            &larr; Kembali ke daftar pesan
        </a>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <div class="border-b border-slate-200 pb-4">
            <h1 class="text-xl font-bold text-slate-900">
                {{ $contact->subject ?: '(Tanpa Subjek)' }}
            </h1>
            <div class="mt-2 flex flex-wrap items-center justify-between gap-2 text-sm text-slate-600">
                <div>
                    Dari: <span class="font-semibold text-slate-900">{{ $contact->name }}</span>
                    (&lt;{{ $contact->email }}&gt;)
                </div>
                <div class="text-xs text-slate-500">
                    {{ $contact->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>

        <div class="mt-5 whitespace-pre-line text-sm leading-relaxed text-slate-800">
            {{ $contact->message }}
        </div>
    </div>
</div>
@endsection