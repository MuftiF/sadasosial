<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Keputusan Resmi - {{ $perizinan->nomor_izin }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Times+New+Roman&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
        }

        .no-print-bar {
            background-color: #0f172a;
            color: white;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 12px;
            margin-bottom: 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-print {
            background-color: #10b981;
            color: #0f172a;
            border: none;
            padding: 8px 16px;
            font-weight: bold;
            font-size: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-print:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .document-card {
            background-color: white;
            border: 1px solid #e2e8f0;
            padding: 40px 50px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            box-sizing: border-box;
            position: relative;
        }

        /* Kop Surat (Letterhead) */
        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 4px double #000;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        .kop-logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px; /* Mock logo emblem */
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .kop-text h1 {
            margin: 2px 0 0 0;
            font-size: 22px;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .kop-text p {
            margin: 4px 0 0 0;
            font-size: 11px;
            font-style: italic;
        }

        /* Letter Body */
        .title-block {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-block h3 {
            margin: 0;
            font-size: 18px;
            text-decoration: underline;
            text-transform: uppercase;
            font-weight: bold;
        }

        .title-block p {
            margin: 4px 0 0 0;
            font-size: 14px;
            font-weight: bold;
        }

        .letter-content {
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        .data-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 6px 12px;
            vertical-align: top;
            font-size: 14px;
        }

        .data-table td.label-col {
            width: 35%;
            font-weight: bold;
        }

        .data-table td.colon-col {
            width: 2%;
        }

        /* Signatures (TTE & QR) */
        .footer-signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .qr-verifikasi-box {
            width: 45%;
            border: 1px dashed #cbd5e1;
            padding: 12px;
            border-radius: 8px;
            background-color: #f8fafc;
            text-align: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }

        .qr-mock-code {
            width: 90px;
            height: 90px;
            margin: 0 auto 10px auto;
            border: 4px solid #fff;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
        }

        .qr-verifikasi-box p {
            margin: 0;
            font-size: 9px;
            color: #64748b;
            line-height: 1.4;
        }

        .qr-verifikasi-box a {
            color: #10b981;
            text-decoration: none;
            font-weight: bold;
            font-size: 9px;
            word-break: break-all;
            display: block;
            margin-top: 4px;
        }

        .signature-officer {
            width: 45%;
            text-align: center;
            font-size: 14px;
        }

        .signature-officer p {
            margin: 0;
        }

        .tte-badge {
            border: 1px solid #10b981;
            background-color: #f0fdf4;
            color: #15803d;
            border-radius: 8px;
            padding: 8px 12px;
            margin: 15px auto;
            width: 80%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 9px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.05);
            text-align: center;
        }

        /* Printable Media Settings */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .no-print-bar {
                display: none;
            }
            .document-card {
                border: none;
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Printable Header Bar -->
    <div class="no-print-bar">
        <span>Dokumen ini diterbitkan secara sah dan terekam di sistem digital.</span>
        <button onclick="window.print()" class="btn-print"><x-heroicon-o-printer class="w-4 h-4 inline-block mr-1" /> Cetak Dokumen</button>
    </div>

    <!-- Official Certificate / Document Sheet -->
    <div class="document-card">
        
        <!-- Kop Surat -->
        <div class="kop-surat">
            <div class="kop-logo">
                <x-heroicon-o-shield-check class="w-5 h-5 inline-block mr-1" />
            </div>
            <div class="kop-text">
                <h2>Pemerintah Provinsi Sumatera Utara</h2>
                <h1>Dinas Sosial</h1>
                <p>Jalan Sampul No. 138, Kota Medan, Kode Pos 20118 | Telp: (061) 4511234</p>
            </div>
        </div>

        <!-- Title of Letter -->
        <div class="title-block">
            <h3>Surat Keputusan Rekomendasi Izin Sosial</h3>
            <p>Nomor: {{ $perizinan->nomor_izin }}</p>
        </div>

        <!-- Body -->
        <div class="letter-content">
            <p>
                Berdasarkan Peraturan Menteri Sosial Republik Indonesia dan Peraturan Daerah Provinsi Sumatera Utara mengenai penyelenggaraan perizinan dan pengawasan sosial terpadu, Kepala Dinas Sosial Provinsi Sumatera Utara dengan ini menerbitkan surat rekomendasi/izin resmi kepada:
            </p>

            <table class="data-table">
                <tr>
                    <td class="label-col">Nama Pemohon / Lembaga</td>
                    <td class="colon-col">:</td>
                    <td>{{ $perizinan->pemohon->name }} @if($perizinan->pemohon->nama_lembaga) ({{ $perizinan->pemohon->nama_lembaga }}) @endif</td>
                </tr>
                <tr>
                    <td class="label-col">Jenis Pelayanan / Izin</td>
                    <td class="colon-col">:</td>
                    <td>{{ $jenisLabels[$perizinan->jenis_layanan] }}</td>
                </tr>
                
                @php
                    $data = $perizinan->data_tambahan ?? [];
                @endphp

                @if($perizinan->jenis_layanan === 'ugb')
                    <tr>
                        <td class="label-col">Nama Undian / Program</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['nama_undian'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Total Nilai Hadiah</td>
                        <td class="colon-col">:</td>
                        <td>Rp {{ number_format($data['total_hadiah'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Waktu Pelaksanaan</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['waktu_pelaksanaan'] ?? '-' }}</td>
                    </tr>
                @elseif($perizinan->jenis_layanan === 'pub')
                    <tr>
                        <td class="label-col">Tujuan Pengumpulan</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['tujuan_pengumpulan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Target Nominal</td>
                        <td class="colon-col">:</td>
                        <td>Rp {{ number_format($data['target_dana'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Jangka Waktu</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['waktu_pelaksanaan'] ?? '-' }}</td>
                    </tr>
                @elseif($perizinan->jenis_layanan === 'lks')
                    <tr>
                        <td class="label-col">Fokus Rehabilitasi LKS</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['jenis_pelayanan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Jumlah Warga Binaan LKS</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['jumlah_binaan'] ?? 0 }} Jiwa</td>
                    </tr>
                    <tr>
                        <td class="label-col">Alamat LKS</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['alamat_lks'] ?? '-' }}</td>
                    </tr>
                @elseif($perizinan->jenis_layanan === 'adopsi')
                    <tr>
                        <td class="label-col">Orang Tua Angkat (COTA)</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['nama_ayah'] ?? '-' }} & {{ $data['nama_ibu'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Nama Anak Yang Diangkat</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['nama_anak'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Lama Pernikahan</td>
                        <td class="colon-col">:</td>
                        <td>{{ $data['lama_menikah'] ?? '-' }}</td>
                    </tr>
                @endif
                
                <tr>
                    <td class="label-col">Tanggal Diterbitkan</td>
                    <td class="colon-col">:</td>
                    <td>{{ $perizinan->tanggal_terbit->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Masa Berlaku Akhir</td>
                    <td class="colon-col">:</td>
                    <td>
                        @if($perizinan->jenis_layanan === 'adopsi')
                            Permanen (Selamanya)
                        @else
                            {{ $perizinan->tanggal_kadaluarsa->format('d F Y') }}
                        @endif
                    </td>
                </tr>
            </table>

            <p>
                Dokumen ini menyatakan bahwa pemohon yang bersangkutan telah memenuhi seluruh persyaratan legalitas administratif, survei kelayakan lapangan, dan substansi teknis dinas sosial. Keputusan ini mutlak dan wajib dilaksanakan sesuai dengan peraturan perundang-undangan yang berlaku.
            </p>
        </div>

        <!-- Footer Signatures -->
        <div class="footer-signatures">
            
            <!-- QR code verify box -->
            <div class="qr-verifikasi-box">
                <div class="qr-mock-code">
                    📲
                </div>
                <p>Dokumen ini tervalidasi secara online di portal Sada Sosial.</p>
                <p>Verifikasi keaslian dokumen via URL di bawah:</p>
                <a href="{{ route('perizinan.verify_public', $perizinan->qr_code_token) }}" target="_blank">
                    {{ route('perizinan.verify_public', $perizinan->qr_code_token) }}
                </a>
            </div>

            <!-- Kepala Dinas Signature -->
            <div class="signature-officer">
                <p>Medan, {{ $perizinan->tanggal_terbit->format('d F Y') }}</p>
                <p style="font-weight: bold; margin-top: 4px;">Kepala Dinas Sosial Provinsi Sumatera Utara</p>
                
                <!-- TTE Signature -->
                <div class="tte-badge">
                    🔒 DITANDATANGANI SECARA ELEKTRONIK (TTE)
                </div>
                
                <p style="font-weight: bold; text-decoration: underline; margin-top: 10px;">Drs. H. Alwi Mujahit, M.Kes</p>
                <p style="font-size: 11px; color: #475569;">NIP. 19680312 199303 1 002</p>
            </div>

        </div>

    </div>

</body>
</html>
