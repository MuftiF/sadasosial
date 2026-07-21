<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Izin / Rekomendasi - {{ $perizinan->nomor_izin }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat h1 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
        }
        .kop-surat h2 {
            font-size: 14pt;
            margin: 0;
        }
        .kop-surat p {
            font-size: 10pt;
            margin: 0;
        }
        .judul-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .judul-surat h3 {
            text-decoration: underline;
            margin: 0;
            font-size: 14pt;
        }
        .isi-surat {
            text-align: justify;
        }
        .table-info {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .table-info td {
            vertical-align: top;
            padding: 3px 0;
        }
        .table-info td:first-child {
            width: 30%;
        }
        .table-info td:nth-child(2) {
            width: 2%;
        }
        .ttd-box {
            width: 300px;
            float: right;
            text-align: left;
            margin-top: 30px;
        }
        .ttd-box p {
            margin: 0;
        }
        .ttd-space {
            height: 80px;
        }
        .barcode {
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            display: inline-block;
            font-size: 8pt;
            color: #555;
            text-align: center;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>PEMERINTAH PROVINSI SUMATERA UTARA</h1>
        <h2>DINAS SOSIAL</h2>
        <p>Jl. Sampul No. 118, Sei Putih Bar., Kec. Medan Petisah, Kota Medan, Sumatera Utara 20118</p>
        <p>Website: dinsos.sumutprov.go.id | Email: dinsos@sumutprov.go.id</p>
    </div>

    <div class="judul-surat">
        @if(in_array($perizinan->jenis_layanan, ['ugb', 'pub', 'lks']))
            <h3>SURAT IZIN {{ strtoupper($perizinan->jenis_layanan) }}</h3>
        @else
            <h3>SURAT REKOMENDASI ADOPSI ANAK</h3>
        @endif
        <p>Nomor: {{ $perizinan->nomor_izin }}</p>
    </div>

    <div class="isi-surat">
        <p>Berdasarkan Peraturan Menteri Sosial Republik Indonesia dan hasil verifikasi tim Dinas Sosial Provinsi Sumatera Utara, dengan ini memberikan izin / rekomendasi kepada:</p>

        <table class="table-info">
            <tr>
                <td>Nama Pemohon / Instansi</td>
                <td>:</td>
                <td><strong>{{ $perizinan->pemohon->name }}</strong></td>
            </tr>
            @if($perizinan->jenis_layanan === 'ugb')
                <tr>
                    <td>Penyelenggara UGB</td>
                    <td>:</td>
                    <td>{{ $perizinan->nama_penyelenggara }}</td>
                </tr>
                <tr>
                    <td>Nama Undian</td>
                    <td>:</td>
                    <td>{{ $perizinan->data_tambahan['nama_undian'] ?? '-' }}</td>
                </tr>
            @elseif($perizinan->jenis_layanan === 'pub')
                <tr>
                    <td>Tujuan Pengumpulan</td>
                    <td>:</td>
                    <td>{{ $perizinan->data_tambahan['tujuan_pengumpulan'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Wilayah</td>
                    <td>:</td>
                    <td>{{ $perizinan->data_tambahan['wilayah_pengumpulan'] ?? '-' }}</td>
                </tr>
            @endif
            <tr>
                <td>Jenis Layanan</td>
                <td>:</td>
                <td>{{ $jenisLabels[$perizinan->jenis_layanan] ?? strtoupper($perizinan->jenis_layanan) }}</td>
            </tr>
            <tr>
                <td>Masa Berlaku</td>
                <td>:</td>
                <td>
                    {{ $perizinan->tanggal_terbit ? \Carbon\Carbon::parse($perizinan->tanggal_terbit)->isoFormat('D MMMM YYYY') : '-' }} 
                    s/d 
                    @if($perizinan->jenis_layanan === 'adopsi')
                        Permanen
                    @else
                        {{ $perizinan->tanggal_kadaluarsa ? \Carbon\Carbon::parse($perizinan->tanggal_kadaluarsa)->isoFormat('D MMMM YYYY') : '-' }}
                    @endif
                </td>
            </tr>
        </table>

        <p>Ketentuan yang harus ditaati:</p>
        <ol>
            <li>Melaksanakan kegiatan sesuai dengan proposal yang telah disetujui.</li>
            <li>Mematuhi peraturan perundang-undangan yang berlaku.</li>
            <li>Melaporkan hasil pelaksanaan kegiatan kepada Dinas Sosial Provinsi Sumatera Utara selambat-lambatnya 30 (tiga puluh) hari setelah masa berlaku izin berakhir.</li>
            <li>Izin ini dapat dicabut atau dibatalkan apabila penyelenggara melanggar ketentuan yang berlaku.</li>
        </ol>

        <p>Demikian surat izin / rekomendasi ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd-box">
        <p>Medan, {{ $perizinan->tanggal_terbit ? \Carbon\Carbon::parse($perizinan->tanggal_terbit)->isoFormat('D MMMM YYYY') : date('d F Y') }}</p>
        <p><strong>Kepala Dinas Sosial Provinsi Sumatera Utara</strong></p>
        <div class="ttd-space">
            <!-- Space for signature/QR -->
            @if($perizinan->qr_code_token)
                <div class="barcode">
                    Dokumen ini telah ditandatangani secara elektronik.<br>
                    ID: {{ $perizinan->qr_code_token }}<br>
                    Waktu: {{ \Carbon\Carbon::parse($perizinan->tanggal_terbit)->format('d-m-Y H:i:s') }}
                </div>
            @endif
        </div>
        <p><strong><u>Dr. H. Asren Nasution, MA</u></strong></p>
        <p>NIP. 19651023 199203 1 002</p>
    </div>
    
    <div class="clear"></div>

</body>
</html>
