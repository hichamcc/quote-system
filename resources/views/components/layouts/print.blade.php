<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Print Document')</title>
    
    <!-- Custom print styles that work reliably -->
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
            line-height: 1.3;
            color: #333;
            background: white;
            width: 100%;
            margin: 0 auto;
        }
        
        /* Layout */
        .container {
            width: 100%;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .company-info {
            max-width: 50%;
        }
        
        .document-title {
            text-align: right;
            max-width: 50%;
        }
        
        .quote-info {
            background-color: #f3f4f6;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        
        .quote-info-left, .quote-info-right {
            width: 48%;
        }
        
        .quote-info-right {
            text-align: right;
        }
        
        .area-section {
            margin-bottom: 25px;
        }
        
        .area-header {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .line-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .subtotal {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            margin-top: 10px;
        }
        
        .grand-total {
            border-top: 2px solid #666;
            padding-top: 15px;
            margin-top: 30px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 8px;
        }
        
        .balance-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 8px;
        }
        
        .deposit-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .terms {
            margin-top: 30px;
            font-size: 10pt;
        }
        
        .terms p {
            margin-bottom: 10px;
        }
        
        .terms ul {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        
        .terms li {
            margin-bottom: 5px;
        }
        
        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .page-number {
            text-align: right;
            margin-top: 40px;
            font-size: 9pt;
        }
        
        /* Print specific styles */
        @media print {
            @page {
                size: letter;
                margin: 0.5in;
            }
            
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .no-print {
                display: none !important;
            }
            
            .page-break {
                page-break-before: always;
            }
        }
        
        /* Screen only styles */
        @media screen {
            body {
                background: #f0f0f0;
                padding: 20px;
            }
            
            .container {
                max-width: 8.5in;
                margin: 0 auto;
                background: white;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                padding: 0.5in;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="padding: 10px; background: #333; color: white; text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="background: #4CAF50; color: white; border: none; padding: 8px 16px; cursor: pointer; border-radius: 4px;">
            Print Document
        </button>
        <button onclick="window.close()" style="background: #f44336; color: white; border: none; padding: 8px 16px; cursor: pointer; border-radius: 4px; margin-left: 10px;">
            Close
        </button>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>