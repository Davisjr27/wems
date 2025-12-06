<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.5; font-size: 13px; }
        .page-break { page-break-after: always; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 22px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 14px; color: #555; }

        .box { border: 1px solid #333; padding: 15px; margin-bottom: 20px; }

        .passport {
            width: 130px;
            height: 150px;
            border: 1px solid #333;
            object-fit: cover;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table td { padding: 8px; border: 1px solid #333; }

        .stamp {
            width: 170px;
            height: 170px;
            object-fit: contain;
            margin-top: 10px;
        }

        .signature {
            width: 180px;
            height: 80px;
            object-fit: contain;
            margin-top: 10px;
        }
    </style>
</head>
<body>

{{-- FIRST PAGE --}}
<div class="header">
    <div class="title">SIWES LOGBOOK</div>
    <div class="subtitle">Student Industrial Work Experience Scheme</div>
</div>

<div class="box">
    <h3>Student Information</h3>

    <table>
        <tr>
            <td><strong>Name:</strong> {{ $student->name }}</td>
            <td rowspan="4" style="text-align:center;">
                @if($student->passport)
                    <img src="{{ public_path('storage/passports/' . $student->passport) }}" class="passport">
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Email:</strong> {{ $student->email }}</td>
        </tr>
        <tr>
            <td><strong>Department:</strong> {{ $student->department ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Institution:</strong> {{ $student->institution ?? 'N/A' }}</td>
        </tr>
    </table>

    <div style="margin-top:20px;">
        <strong>First Page Stamp:</strong><br>
        @if($student->first_page_stamp)
            <img src="{{ public_path('storage/stamps/' . $student->first_page_stamp) }}" class="stamp">
        @endif
    </div>
</div>

<div class="page-break"></div>


{{-- WEEKLY ENTRIES --}}
@foreach($entries as $entry)
<div class="box">
    <h3>Week {{ $entry->week_number }}</h3>

    <p>{{ $entry->summary }}</p>

    <strong>Company Stamp/Signature (Uploaded):</strong><br>
    @if($entry->stamp_file)
        <img src="{{ public_path('storage/logbook_stamps/' . $entry->stamp_file) }}"
             style="width: 200px; height:auto; margin-top:15px;">
    @endif
</div>

<div class="page-break"></div>
@endforeach


{{-- FINAL APPROVAL PAGE --}}
<h2 style="text-align:center; margin-bottom:20px;">Final Approval</h2>

<div class="box">
    <strong>SIWES Officer Stamp:</strong><br>
    @if($student->final_stamp)
        <img src="{{ public_path('storage/officer_stamps/' . $student->final_stamp) }}" class="stamp">
    @endif

    <br><br>

    <strong>SIWES Officer Signature:</strong><br>
    @if($student->officer_signature)
        <img src="{{ public_path('storage/officer_signatures/' . $student->officer_signature) }}" class="signature">
    @endif

    <p style="margin-top:20px;">
        <strong>Approval Date:</strong> {{ now()->format('d M, Y') }}
    </p>
</div>

</body>
</html>
