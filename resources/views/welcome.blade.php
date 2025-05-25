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
            width: 300px;
            margin: auto;
            border: 2px dashed #333;
            background-color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
        }
        .barcode-section {
            margin-right: 20px;
        }
        .barcode-section svg {
            /* width: 150px; */
            /* height: 150px; */
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
        <div class="barcode-section">
            {{-- Menghasilkan QR Code dengan data pelanggan yang diencode ke JSON --}}
            {!! DNS2D::getBarcodeSVG('1', 'QRCODE', 3, 3) !!}
        </div>
        <div class="customer-info">
            <strong>{{ $customer->nama }}</strong><br>
            ID: {{ $customer->id }}<br>
            Username: {{ $customer->username }}<br>
            Phone: {{ $customer->no_telp }}
        </div>
    </div>
    <div class="print-btn">
        <button onclick="window.print()">Cetak Sticker</button>
    </div>
</body>
</html>
