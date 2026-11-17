<?php
// Inisialisasi variabel
$tinggi = 5;
$error = '';
$tampilkan = false;

// Fungsi untuk menghasilkan pola segitiga berdasarkan arah
function buat_pola($tinggi, $arah) {
    $pola = "";

    switch ($arah) {
        case 'atas':
            for ($i = 1; $i <= $tinggi; $i++) {
                $pola .= str_repeat(" ", $tinggi - $i) . str_repeat("*", 2 * $i - 1) . "\n";
            }
            break;

        case 'bawah':
            for ($i = $tinggi; $i >= 1; $i--) {
                $pola .= str_repeat(" ", $tinggi - $i) . str_repeat("*", 2 * $i - 1) . "\n";
            }
            break;

        case 'kanan':
            for ($i = 1; $i <= $tinggi; $i++) {
                $pola .= str_repeat("*", $i) . "\n";
            }
            for ($i = $tinggi - 1; $i >= 1; $i--) {
                $pola .= str_repeat("*", $i) . "\n";
            }
            break;

        case 'kiri':
            for ($i = 1; $i <= $tinggi; $i++) {
                $pola .= str_repeat(" ", $tinggi - $i) . str_repeat("*", $i) . "\n";
            }
            for ($i = $tinggi - 1; $i >= 1; $i--) {
                $pola .= str_repeat(" ", $tinggi - $i) . str_repeat("*", $i) . "\n";
            }
            break;
    }

    return $pola;
}

// Proses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_tinggi = $_POST['tinggi'] ?? '';

    // Validasi bilangan bulat 1 sampai 20
    if (filter_var($input_tinggi, FILTER_VALIDATE_INT) !== false && (int)$input_tinggi >= 1 && (int)$input_tinggi <= 20) {
        $tinggi = (int)$input_tinggi;
        $tampilkan = true;
    } else {
        $error = "Masukan tidak valid! Harap masukkan bilangan bulat antara 1 sampai 20.";
    }
} else {
    // Tampilkan default saat pertama kali diakses
    $tampilkan = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Generator Segitiga Bintang PHP</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #4b5563;
            --border: #d1d5db;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 30px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: var(--text-main);
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        button {
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        .error {
            color: #b91c1c;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        /* Tata letak grid untuk menampilkan 4 kotak pola sekaligus */
        .grid-pola {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card-pola {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 8px;
        }

        .card-pola h4 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: var(--text-muted);
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
        }

        pre {
            background-color: #0f172a;
            color: #38bdf8;
            padding: 15px;
            border-radius: 6px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            line-height: 1.3;
            overflow-x: auto;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Semua Generator Segitiga Bintang (4 Arah)</h2>
    
    <form method="POST" action="">
        <input type="text" name="tinggi" placeholder="Tinggi (1 - 20)" value="<?= htmlspecialchars((string)$tinggi) ?>" required>
        <button type="submit">Tampilkan Semua</button>
    </form>

    <?php if ($error !== ''): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($tampilkan && $error === ''): ?>
        <div class="grid-pola">
            
            <!-- 1. Menghadap ke Atas -->
            <div class="card-pola">
                <h4>1. Menghadap ke Atas</h4>
                <pre><?= htmlspecialchars(buat_pola($tinggi, 'atas')) ?></pre>
            </div>

            <!-- 2. Menghadap ke Bawah -->
            <div class="card-pola">
                <h4>2. Menghadap ke Bawah</h4>
                <pre><?= htmlspecialchars(buat_pola($tinggi, 'bawah')) ?></pre>
            </div>

            <!-- 3. Menghadap ke Kanan -->
            <div class="card-pola">
                <h4>3. Menghadap ke Kanan</h4>
                <pre><?= htmlspecialchars(buat_pola($tinggi, 'kanan')) ?></pre>
            </div>

            <!-- 4. Menghadap ke Kiri -->
            <div class="card-pola">
                <h4>4. Menghadap ke Kiri</h4>
                <pre><?= htmlspecialchars(buat_pola($tinggi, 'kiri')) ?></pre>
            </div>

        </div>
    <?php endif; ?>
</div>

</body>
</html>