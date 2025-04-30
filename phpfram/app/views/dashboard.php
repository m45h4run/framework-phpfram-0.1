<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di PHP FRAM Framework</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .title {
            font-size: 2.25rem;
            font-weight: 600;
            color: #4f46e5;
            margin-bottom: 1rem;
        }

        .description {
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .features {
            margin-bottom: 1.5rem;
        }

        .features-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.75rem;
        }

        .features-list {
            list-style-type: disc;
            margin-left: 2rem;
            color: #6b7280;
            text-align: left;
        }

        .features-list li {
             margin-bottom: 0.25rem;
        }

        .getting-started-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.75rem;
        }

        .getting-started-text {
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        .project-button {
            background-color: #6b7280;
            color: #ffffff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease-in-out;
            text-decoration: none;
            margin-top: 1rem;
        }

        .project-button:hover {
            background-color: #374151;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="container">
        <img src="<?php echo site_url('assets/qr.png') ?>" style="height: 400px;">
        <br> <?php echo base_url().'assets/qr.png'; ?>
        <h1 class="title">Selamat Datang di Framework <br>PHP FRAM</h1>
        <p class="description">
            Framework PHP yang ringan dan cepat untuk pengembangan web modern.
        </p>
        <div class="features">
            <h2 class="features-title">Fitur Utama</h2>
            <ul class="features-list">
                <li>Arsitektur MVC (Model-View-Controller)</li>
                <li>Routing yang sederhana dan fleksibel</li>
                <li>ORM (Object-Relational Mapping) yang mudah digunakan</li>
                <li>Templating engine yang ringan</li>
                <li>Keamanan yang kuat dengan pencegahan XSS dan CSRF</li>
                <li>Performa tinggi dan optimasi cache</li>
            </ul>
        </div>
        <div class="getting-started">
            <h2 class="getting-started-title">Memulai</h2>
             <p class="getting-started-text">
                Untuk memulai pengembangan dengan PHP FRAM Framework, silahkan modifikasi CRUD berikut.
            </p>
        </div>
        <a href="<?php echo site_url('test') ?>" class="project-button">Test CRUD Sederhana</a>
        <p>Silahkan di kembangkan dan jangan lupa kabarin saya di <a href="https://www.tiktok.com/@m45h4run" target="_blank">Tiktok</a></p>
    </div>
</body>
</html>
