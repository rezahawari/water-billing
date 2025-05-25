<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Sticker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .sticker-container {
            width: 500px;
            margin: auto;
            border: 2px dashed #333;
            background-color: #fff;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .logo {
            width: 100px; /* Sesuaikan dengan ukuran logo Anda */
            margin-right: 15px;
        }
        .company-info {
            flex-grow: 1;
        }
        .company-info h2 {
            margin: 0;
            color: #333;
        }
        .company-info p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        .content {
            display: flex;
            align-items: center;
        }
        .barcode-section {
            margin-right: 20px;
        }
        .barcode-section img {
            width: 150px;
            height: 150px;
        }
        .customer-info {
            font-size: 14px;
            line-height: 1.5;
        }
        .customer-info strong {
            font-size: 16px;
        }
        .print-btn {
            text-align: center;
            margin-top: 20px;
        }
        .print-btn button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .print-btn button:hover {
            background-color: #0056b3;
        }
        @media print {
            .print-btn {
                display: none;
            }
            body {
                background-color: #fff;
            }
        }
    </style>
</head>
<body>
    <div class="sticker-container">
        <!-- Header dengan Logo -->
        <div class="header">
            <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo">
            <div class="company-info">
                <h2>Sumber Tirta</h2>
                <p>Alamat Perusahaan Anda</p>
                <p>Telp: (021) 1234567 | Email: info@perusahaan.com</p>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="barcode-section">
                {{-- Menggunakan PNG untuk kompatibilitas cetak yang lebih baik --}}
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(json_encode([
                    'id'    => $customer->id,
                    'nama'  => $customer->nama,
                    'email' => $customer->username,
                ]), 'QRCODE', 3, 3) }}" alt="QR Code">
            </div>
            <div class="customer-info">
                <strong>{{ $customer->nama }}</strong><br>
                ID: {{ $customer->id }}<br>
                Email: {{ $customer->username }}<br>
                Phone: {{ $customer->no_telp }}
            </div>
        </div>
    </div>
    <div class="print-btn">
        <button onclick="window.print()">Cetak Sticker</button>
    </div>
</body>
</html>
