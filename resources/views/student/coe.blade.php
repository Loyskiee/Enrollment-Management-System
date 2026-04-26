<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COE - {{ $student->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
    @page {
        margin: 0;
    }

    #print-area, #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none !important;
    }

    body {
        margin: 1.5cm;
        background: white;
    }

    .cert-container { 
        box-shadow: none !important; 
    }
}

.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    font-size: 8rem;
    opacity: 0.05;
    pointer-events: none;
    z-index: 0;
}

    </style>
</head>
<body class="bg-neutral-100 p-4 md:p-10 font-serif">

    {{-- Control Panel --}}
    <div class="max-w-4xl mx-auto mb-6 no-print flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-neutral-200">
        <a href="{{ route('student.dashboard') }}" class="text-sm text-neutral-500 hover:text-blue-600 flex items-center gap-2">
            ← Back to Dashboard
        </a>
        <button onclick="window.print()" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold shadow-lg hover:bg-blue-700 transition">
            Print Certificate
        </button>
    </div>

    {{-- The Certificate Container --}}
    <div class="max-w-4xl mx-auto bg-white p-12 md:p-20 shadow-2xl border-8 border-double border-neutral-200 relative overflow-hidden cert-container">
        
        <div class="watermark uppercase">Official</div>

        {{-- Header --}}
        <div class="text-center mb-10 relative z-10">
            <h1 class="text-3xl font-bold uppercase tracking-widest text-neutral-800">Your Institution Name</h1>
            <p class="text-sm text-neutral-500 italic">Office of the Registrar • Enrollment Management System</p>
            <div class="w-32 h-1 bg-neutral-800 mx-auto mt-4"></div>
        </div>

        {{-- Document Title --}}
        <div class="text-center mb-16 relative z-10">
            <h2 class="text-5xl font-light text-neutral-700 mb-2">Certificate of Enrollment</h2>
            <p class="text-neutral-500">This is to certify the enrollment of the student named below.</p>
        </div>

        {{-- Student Details --}}
        <div class="space-y-8 mb-20 relative z-10">
            <div class="border-b border-neutral-200 pb-2">
                <span class="text-xs uppercase text-neutral-400 block mb-1">Student Name</span>
                <span class="text-2xl font-semibold text-neutral-800">{{ $student->name }}</span>
            </div>

            <div class="grid grid-cols-2 gap-10">
                <div class="border-b border-neutral-200 pb-2">
                    <span class="text-xs uppercase text-neutral-400 block mb-1">Academic Year / Semester</span>
                    <span class="text-lg text-neutral-800 font-medium">{{ $semester->name ?? 'Current Semester' }}</span>
                </div>
                <div class="border-b border-neutral-200 pb-2">
                    <span class="text-xs uppercase text-neutral-400 block mb-1">Date Issued</span>
                    <span class="text-lg text-neutral-800 font-medium">{{ now()->format('F d, Y') }}</span>
                </div>
            </div>

            <div class="border-b border-neutral-200 pb-2">
                <span class="text-xs uppercase text-neutral-400 block mb-1">Email Address</span>
                <span class="text-lg text-neutral-800">{{ $student->email }}</span>
            </div>
        </div>

        {{-- Footer / Signature --}}
        <div class="flex justify-between items-end mt-32 relative z-10">
            <div class="text-xs text-neutral-400 italic max-w-xs">
                This document is electronically generated and serves as official proof of enrollment for the specified academic term.
            </div>
            
            <div class="text-center">
                <div class="w-64 border-b border-neutral-
