<?php
// index.php - My Safe Space Mobile Web App

$appName = "My safe space";
$creators = "Bryanna, Juno, Meike & Tala";

// Simpele weergave-check of de gebruiker op 'Starten' heeft geklikt
$showApp = isset($_GET['start']) &&$_GET['start'] === '1';
$activeTab =$_GET['tab'] ?? 'routes';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars($appName) ?></title>
    
    <!-- Favicon (logo in het tabblad) -->
    <link rel="icon" type="image/png" href="img/logo.png">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #121212;
            --card-bg: #1e1e2d;
            --accent-purple: #7b2cbf;
            --accent-light-purple: #9d4edd;
            --text-color: #ffffff;
            --text-secondary: #a0a0b2;
            --border-radius: 16px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: #000;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Mobiele Telefoon Wrapper Container */
        .mobile-container {
            width: 100%;
            max-width: 430px;
            height: 100vh;
            max-height: 932px;
            background-color: var(--bg-color);
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(123, 44, 191, 0.3);
        }

        @media (min-width: 450px) {
            .mobile-container {
                height: 88vh;
                border-radius: 40px;
                border: 8px solid #2a2a3a;
            }
        }

        /* 1. WELKOMSTSCHERM */
        .welcome-screen {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #2d004d 0%, #121212 100%);
        }

        .welcome-logo {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(123, 44, 191, 0.4);
        }

        .welcome-screen h1 {
            font-size: 2.3rem;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #c77dff, #e0aaff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-screen p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .btn-start {
            background: linear-gradient(45deg, var(--accent-purple), var(--accent-light-purple));
            color: white;
            padding: 16px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(157, 78, 221, 0.4);
            transition: transform 0.2s;
        }

        .btn-start:active {
            transform: scale(0.95);
        }

        .credits {
            position: absolute;
            bottom: 25px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* HEADER */
        .app-header {
            padding: 15px 20px;
            background-color: var(--card-bg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #2a2a3d;
        }

        .header-logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .app-header h2 {
            font-size: 1.2rem;
            color: #c77dff;
        }

        /* MAIN CONTENT AREA */
        .app-content {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
        }

        /* KAART / ROUTES TAB */
        .map-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 15px;
        }

        .map-placeholder {
            width: 100%;
            height: 180px;
            background: #252538 url('https://tile.openstreetmap.org/15/16823/10775.png') center/cover;
            border-radius: 12px;
            margin-bottom: 15px;
            position: relative;
        }

        .map-pin {
            position: absolute;
            color: #ff4d6d;
            font-size: 1.5rem;
        }

        .location-list {
            list-style: none;
        }

        .location-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #2a2a3d;
        }

        .location-item:last-child {
            border-bottom: none;
        }

        /* VRIENDEN TAB */
        .friend-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .friend-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: var(--accent-purple);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .btn-share {
            background-color: #2a2a3d;