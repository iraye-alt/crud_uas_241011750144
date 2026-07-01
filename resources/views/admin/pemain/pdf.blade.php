<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Atlet Profesional</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 3px solid #10b981;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 800;
            color: #1e1b4b;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 11px;
            color: #64748b;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 10px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead th {
            background-color: #10b981;
            color: #ffffff;
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        thead th:first-child {
            border-radius: 6px 0 0 0;
        }

        thead th:last-child {
            border-radius: 0 6px 0 0;
        }

        tbody td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tbody tr:hover {
            background-color: #ecfdf5;
        }

        .player-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .no-img {
            width: 40px;
            height: 40px;
            background-color: #f1f5f9;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 9px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            background-color: #ecfdf5;
            color: #047857;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }

        .footer {
            margin-top: 30px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }

        .total-info {
            margin-bottom: 16px;
            padding: 10px 14px;
            background-color: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #10b981;
        }

        .total-info span {
            font-weight: 700;
            color: #047857;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Data Atlet Profesional</h1>
        <p>Sistem Informasi ChampVault — UAS Rekayasa Web</p>
    </div>

    {{-- Meta Info --}}
    <div class="meta">
        <div>Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</div>
        <div>Total Data: {{ $pemains->count() }} atlet</div>
    </div>

    {{-- Summary --}}
    <div class="total-info">
        Total <span>{{ $pemains->count() }}</span> atlet dari
        <span>{{ $pemains->unique('cabang_olahraga')->count() }}</span> cabang olahraga dan
        <span>{{ $pemains->unique('klub')->count() }}</span> klub terdaftar.
    </div>

    {{-- Data Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 35px;">No</th>
                <th style="width: 55px;">Gambar</th>
                <th>Nama Atlet</th>
                <th>Cabang Olahraga</th>
                <th>Klub / Tim</th>
                <th style="width: 50px;">Usia</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemains as $index => $pemain)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        @if($pemain->gambar && file_exists(public_path('storage/' . $pemain->gambar)))
                            <img src="{{ public_path('storage/' . $pemain->gambar) }}" class="player-img" alt="{{ $pemain->nama_pemain }}">
                        @else
                            <div class="no-img">No Img</div>
                        @endif
                    </td>
                    <td><strong>{{ $pemain->nama_pemain }}</strong></td>
                    <td><span class="badge">{{ $pemain->cabang_olahraga }}</span></td>
                    <td>{{ $pemain->klub }}</td>
                    <td style="text-align: center;">{{ $pemain->usia }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">
                        Tidak ada data pemain yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        &copy; {{ date('Y') }} — Laporan Data Atlet Profesional | UAS Rekayasa Web — NIM 241011750144
    </div>

</body>
</html>
