<?php include "conexion.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UNLOCKSERVERPRO</title>
    <title>IMEI&SN/RENTAS/ACTIVACIONES</title>

    <style>
      body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
      }

      .select-servicio {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            background-color: #f9f9f9;
            transition: 0.3s ease;
            cursor: pointer;
      }

      .select-servicio:hover {
            border-color: #007BFF;
            background-color: #eef6ff;
      }

      .select-servicio:focus {
            outline: none;
            border-color: #0056b3;
            background-color: #e1efff;
            box-shadow: 0 0 5px rgba(0,123,255,0.4);
      }

      .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            width: 400px;
            text-align: center;
      }

      h2 {
            color: #333;
            margin-bottom: 30px;
      }

      label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            text-align: left;
      }

      input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
      }

      .form-group {
            margin-bottom: 20px;
      }

      button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
      }

      button:hover {
            background-color: #0056b3;
      }

      a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background-color: #17a2b8;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
      }

      a:hover {
            background-color: #117a8b;
      }
    </style>

</head>
<body>

<div class="container">
    <h2>UNLOCKSERVERPRO</h2>
    <h2>IMEI&SN/RENTAS/ACTIVACIONES</h2>

    <!-- FORMULARIO COMPLETO Y ARREGLADO -->
    <form action="guardar.php" method="POST">

    <label>Activ / Renov / Rent ingresar Orden sin agregar IMEI </label>

        <div class="form-group" style="display: flex; align-items: center;">
            <label for="imei" style="margin-right: 10px;">IMEI/SN:</label>
            <input type="text" id="imei" name="imei_sn" required maxlength="15" pattern="\d{15}" title="El IMEI debe tener 15 dígitos">

            <div style="margin-left: 10px;">
                <input type="checkbox" id="autoCeros">
            </div>
        </div>

        <div class="form-group">
            <label>Modelo / Activacion / Renovacion:</label>
            <input type="text" name="modelo" required>
        </div>

        <div class="form-group">
            <label>Servicio:</label>
            <select name="servicio" class="select-servicio" required>
                <option disabled selected>Seleccione un servicio...</option>

                <optgroup label="Server Services">

<option value="Apple Check Service - Carrier + Sim Lock ✅ {IMEI or SN} (Instant 20 Seconds) (8 USDT)">⚡ Apple Check Service - Carrier + Sim Lock ✅ {IMEI or SN} (Instant 20 Seconds) ⚡ (8 USDT)</option>
<option value="Limpieza (8 USDT)">⚡ F4 + FIX YAPE (8 USDT) ⚡</option>
<option value="UnlockTool 03 Months NEW / RENEW License (28 USDT)">⚡ UnlockTool 03 Months NEW / RENEW License (28 USDT) ⚡</option>
<option value="UnlockTool 06 Months NEW / RENEW License (36 USDT)">⚡ UnlockTool 06 Months NEW / RENEW License (36 USDT) ⚡</option>
<option value="UnlockTool 12 Months NEW / RENEW License (52 USDT)">⚡ UnlockTool 12 Months NEW / RENEW License (52 USDT) ⚡</option>
<option value="TSM-TOOL Pro 1 Year (28.8 USDT)">⚡ TSM-TOOL Pro 1 Year (28.8 USDT) ⚡</option>
<option value="TSM-TOOL Pro 1 Year (37.8 USDT)">⚡ TSM-TOOL Pro 1 Year (37.8 USDT) ⚡</option>
<option value="TSM-TOOL Pro 6 Months (20.8 USDT)">⚡ TSM-TOOL Pro 6 Months (20.8 USDT) ⚡</option>
<option value="Phoenix Service Tool Credit Instant (For Nokia Flash Frp Password) (1.8 USDT)">⚡ Phoenix Service Tool Credit Instant (For Nokia Flash Frp Password) (1.8 USDT) ⚡</option>
<option value="Adam Tool Credit For Xiaomi/OnePlus/Realme [Existing User] (10.66 USDT)">⚡ Adam Tool Credit For Xiaomi/OnePlus/Realme [Existing User] (10.66 USDT) ⚡</option>

<option value="AMT Android Multi Tool - 1 Year (37.9 USDT)">⚡ AMT Android Multi Tool - 1 Year (37.9 USDT) ⚡</option>
<option value="AMT Android Multi Tool - 3 Month (19.9 USDT)">⚡ AMT Android Multi Tool - 3 Month (19.9 USDT) ⚡</option>
<option value="AMT Android Multi Tool - 6 Month (26.9 USDT)">⚡ AMT Android Multi Tool - 6 Month (26.9 USDT) ⚡</option>
<option value="AMT Android Multi Tool - Credits (10.93 USDT)">⚡ AMT Android Multi Tool - Credits (10.93 USDT) ⚡</option>

<option value="AnonySHU Activation [12 Months - 1 Pc] (65 USDT)">⚡ AnonySHU Activation [12 Months - 1 Pc] (65 USDT) ⚡</option>
<option value="AnonySHU Activation [6 Months - 1 Pc] (50 USDT)">⚡ AnonySHU Activation [6 Months - 1 Pc] (50 USDT) ⚡</option>

<option value="AndroidWinTool 1 Month License for Existing Users (27.45 USDT)">⚡ AndroidWinTool 1 Month License for Existing Users (27.45 USDT) ⚡</option>
<option value="AndroidWinTool 3 Months License for Existing Users (38 USDT)">⚡ AndroidWinTool 3 Months License for Existing Users (38 USDT) ⚡</option>
<option value="AndroidWinTool 1 Year License for Existing Users (46 USDT)">⚡ AndroidWinTool 1 Year License for Existing Users (46 USDT) ⚡</option>
<option value="AndroidWinTool Credits for Existing User (10.94 USDT)">⚡ AndroidWinTool Credits for Existing User (10.94 USDT) ⚡</option>

<option value="Borneo Schematics Hardware Tool Activation Code [1 Year - 1 PC] (46.4 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [1 Year - 1 PC] (46.4 USDT) ⚡</option>
<option value="Borneo Schematics Hardware Tool Activation Code [1 Year - 2 PC] (61.4 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [1 Year - 2 PC] (61.4 USDT) ⚡</option>
<option value="Borneo Schematics Hardware Tool Activation Code [3 Months - 1 PC] (23.5 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [3 Months - 1 PC] (23.5 USDT) ⚡</option>
<option value="Borneo Schematics Hardware Tool Activation Code [3 Months - 2 PC] (31.5 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [3 Months - 2 PC] (31.5 USDT) ⚡</option>
<option value="Borneo Schematics Hardware Tool Activation Code [6 Months - 1 PC] (31.5 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [6 Months - 1 PC] (31.5 USDT) ⚡</option>
<option value="Borneo Schematics Hardware Tool Activation Code [6 Months - 2 PC] (46.5 USDT)">⚡ Borneo Schematics Hardware Tool Activation Code [6 Months - 2 PC] (46.5 USDT) ⚡</option>

<option value="Cheetah Tool - LG Module Activation (23.9 USDT)">⚡ Cheetah Tool - LG Module Activation (23.9 USDT) ⚡</option>
<option value="Cheetah Tool Pro 1 Year Activation (56 USDT)">⚡ Cheetah Tool Pro 1 Year Activation (56 USDT) ⚡</option>
<option value="Cheetah Tool Pro 3 Months Activation (34 USDT)">⚡ Cheetah Tool Pro 3 Months Activation (34 USDT) ⚡</option>
<option value="Cheetah Tool Pro 6 Months Activation (44 USDT)">⚡ Cheetah Tool Pro 6 Months Activation (44 USDT) ⚡</option>

<option value="Create Any Account New - Apple ID Without 2FA (12.932 USDT)">⚡ Create Any Account New - Apple ID Without 2FA (12.932 USDT) ⚡</option>

<option value="Demir Auth Credit - Flash/EFS/Mi Cloud/FRP (10.43 USDT)">⚡ Demir Auth Credit - Flash/EFS/Mi Cloud/FRP (10.43 USDT) ⚡</option>
<option value="Demir CPID credits (Existing User) (11.015 USDT)">⚡ Demir CPID credits (Existing User) (11.015 USDT) ⚡</option>

<option value="DFT Pro 1 Year Activation New User (82 USDT)">⚡ DFT Pro 1 Year Activation New User (82 USDT) ⚡</option>
<option value="DFT Pro 1 Year Activation Renew Old User (82 USDT)">⚡ DFT Pro 1 Year Activation Renew Old User (82 USDT) ⚡</option>

<option value="E-GSM Tool Activation NEW - RENEW (63.2 USDT)">⚡ E-GSM Tool Activation NEW - RENEW (63.2 USDT) ⚡</option>
<option value="E-GSM Tool Credits (11.1 USDT)">⚡ E-GSM Tool Credits (11.1 USDT) ⚡</option>

<option value="Frp Boss Tool Recharge User (10.845 USDT)">⚡ Frp Boss Tool Recharge User (10.845 USDT) ⚡</option>
<option value="GLOBAL AUTH TOOL MTK/QUALCOMM Flash/EFS/Mi Cloud Credit (10.73 USDT)">⚡ GLOBAL AUTH TOOL MTK/QUALCOMM Flash/EFS/Mi Cloud Credit (10.73 USDT) ⚡</option>

<option value="HW-Key Tool Credits (Existing User) (10.9 USDT)">⚡ HW-Key Tool Credits (Existing User) (10.9 USDT) ⚡</option>
<option value="MI Fix Pro Tool (Existing User) (10.77 USDT)">⚡ MI Fix Pro Tool (Existing User) (10.77 USDT) ⚡</option>
<option value="MI Fix Pro Tool (New User) (10.77 USDT)">⚡ MI Fix Pro Tool (New User) (10.77 USDT) ⚡</option>
<option value="MAT AUTH TOOL AUTO API EXISTING USER (10.22 USDT)">⚡ MAT AUTH TOOL AUTO API EXISTING USER (10.22 USDT) ⚡</option>

<option value="Microsoft Office 2016 Professional Plus - 1 PC (17 USDT)">⚡ Microsoft Office 2016 Professional Plus - 1 PC (17 USDT) ⚡</option>
<option value="Microsoft Office 2019 Home and Business for 1 Mac (36 USDT)">⚡ Microsoft Office 2019 Home and Business for 1 Mac (36 USDT) ⚡</option>
<option value="Microsoft Office 2019 Professional Plus - 1 PC (20.5 USDT)">⚡ Microsoft Office 2019 Professional Plus - 1 PC (20.5 USDT) ⚡</option>
<option value="Microsoft Office 2021 Home and Business for 1 Mac (62.5 USDT)">⚡ Microsoft Office 2021 Home and Business for 1 Mac (62.5 USDT) ⚡</option>
<option value="Microsoft Office 2021 Professional Plus - 1 PC (38 USDT)">⚡ Microsoft Office 2021 Professional Plus - 1 PC (38 USDT) ⚡</option>
<option value="Microsoft Office 365 Professional Plus Genuine Account (16 USDT)">⚡ Microsoft Office 365 Professional Plus Genuine Account (16 USDT) ⚡</option>

<option value="Microsoft Windows 7 Professional Genuine License Key – 1 PC (16 USDT)">⚡ Microsoft Windows 7 Professional Genuine License Key – 1 PC (16 USDT) ⚡</option>
<option value="Microsoft Windows 8 Pro Professional Genuine License Key – 1 PC (16 USDT)">⚡ Microsoft Windows 8 Pro Professional Genuine License Key – 1 PC (16 USDT) ⚡</option>
<option value="Microsoft Windows 10 Professional Genuine License Key – 1 PC (16 USDT)">⚡ Microsoft Windows 10 Professional Genuine License Key – 1 PC (16 USDT) ⚡</option>
<option value="Microsoft Windows 11 Professional Genuine License Key – 1 PC (16 USDT)">⚡ Microsoft Windows 11 Professional Genuine License Key – 1 PC (16 USDT) ⚡</option>

<option value="MultiUnlockMDM 4 Month License (41 USDT)">⚡ MultiUnlockMDM 4 Month License (41 USDT) ⚡</option>
<option value="MultiUnlockMDM 6 Month License (49 USDT)">⚡ MultiUnlockMDM 6 Month License (49 USDT) ⚡</option>

<option value="Octoplus Box - Credits For Exiting Users (10.108 USDT)">⚡ Octoplus Box - Credits For Exiting Users (10.108 USDT) ⚡</option>
<option value="Octoplus Box - Credits For New Users (10.108 USDT)">⚡ Octoplus Box - Credits For New Users (10.108 USDT) ⚡</option>

<option value="Lista Blanca (38.74 USDT)">⚡ LISTA BLANCA PERU DIRECT SOURCE (38.74 USDT) ⚡</option>
<option value="Reparacion Pantalla (23.84 USDT)">⚡ CAMBIO DE MODULO/PANTALLA (23.84 USDT) ⚡</option>
<option value="FRP (5 USDT)">⚡ FRP - CUENTA GOOGLE (5 USDT) ⚡</option>
<option value="FRP SAMSUNG VIA IMEI (29 USDT)">⚡ FRP VIA IMEI ANDROID 14 (29 USDT) ⚡</option>

<option value="UnlockTool (15 USDT)">🛠 UNLOCKTOOL (15 USDT)</option>
<option value="MDM Fix Tool (8 USDT)">🛠 MDM FIX TOOL (8 USDT)</option>
<option value="Pandora Digital 2 Months (42.09 USDT)">🛠 PANDORA DIGITAL 2 MONTH (42.09 USDT)</option>
<option value="Cheetah Tool (10 USDT)">🛠 CHEETAH TOOL (10 USDT)</option>
<option value="RTC Tool (6 USDT)">🛠 RTC TOOL (6 USDT)</option>
<option value="Griffin Unlocker (9 USDT)">🛠 GRIFFIN-UNLOCKER (9 USDT)</option>
<option value="TSM Tool (8 USDT)">🛠 TSM TOOL (8 USDT)</option>
<option value="Android Multitool (6 USDT)">🛠 ANDROID MULTITOOL (6 USDT)</option>
<option value="DFT Pro Tool (10 USDT)">🛠 DFT PRO TOOL (10 USDT)</option>
<option value="Android WinTool (6 USDT)">🛠 ANDROIDWINTOOL (6 USDT)</option>

<option value="TR Tools (8 USDT)">🛠 TR TOOLS (8 USDT)</option>
<option value="Anonyshu (7 USDT)">🛠 ANONYSHU (7 USDT)</option>
<option value="KG Killer (10 USDT)">🛠 KG KILLER (10 USDT)</option>
<option value="MST Tool (6 USDT)">🛠 MST TOOL (6 USDT)</option>
<option value="Octoplus Samsung Box (8 USDT)">🛠 OCTOPLUS SAMSUNG BOX (8 USDT)</option>
<option value="CF Tools (6 USDT)">🛠 CF TOOLS (6 USDT)</option>
<option value="EME Tool (6 USDT)">🛠 EME TOOL (6 USDT)</option>
<option value="Scorpion Tool (7 USDT)">🛠 SCORPION TOOL (7 USDT)</option>

<option value="Bypass Pasccode iPhone 6/6plus (10 USDT)">🛠 Bypass Pasccode iPhone 6/6 Plus (10 USDT)</option>
<option value="Bypass Pasccode iPhone 6s (10 USDT)">🛠 Bypass Pasccode iPhone 6s (10 USDT)</option>
<option value="Bypass Pasccode iPhone 7 (10 USDT)">🛠 Bypass Pasccode iPhone 7 (10 USDT)</option>
<option value="Bypass Pasccode iPhone 8 (10 USDT)">🛠 Bypass Pasccode iPhone 8 (10 USDT)</option>
<option value="Bypass Pasccode iPhone X (10 USDT)">🛠 Bypass Pasccode iPhone X (10 USDT)</option>

</optgroup>

               <optgroup label="IMEI Service">

<option value="Nothing A12 bypass iphone/ipad - All Model - Windows Tool (16.85 USDT)">⚡ Nothing A12 bypass iphone/ipad - All Model - Windows Tool (16.85 USDT) ⚡</option>

<option value="Remover Bloqueo Movistar Mexico - KG / MDM / Pagos Movistar (25.5 USDT)">⚡ Remover Bloqueo Movistar Mexico - KG / MDM / Pagos Movistar (25.5 USDT) ⚡</option>

<option value="VERIFY & WARRANTY Movistar Lock Removal (10 USDT)">⚡ VERIFY & WARRANTY Movistar Lock Removal (10 USDT) ⚡</option>

<option value="Desbloqueo No Registro Movil Éxito Colombia (17 USDT)">⚡ Desbloqueo No Registro Movil Éxito Colombia (17 USDT) ⚡</option>

<option value="Desbloqueo No Registro 2 Operadores Colombia (29 USDT)">⚡ Desbloqueo No Registro 2 Operadores Colombia (29 USDT) ⚡</option>

<option value="Desbloqueo No Registro 3 Operadores Colombia (29 USDT)">⚡ Desbloqueo No Registro 3 Operadores Colombia (29 USDT) ⚡</option>

<option value="Desbloqueo No Registro Avantel Colombia (25 USDT)">⚡ Desbloqueo No Registro Avantel Colombia (25 USDT) ⚡</option>

<option value="Desbloqueo No Registro Tigo Colombia (17.5 USDT)">⚡ Desbloqueo No Registro Tigo Colombia (17.5 USDT) ⚡</option>

<option value="Desbloqueo No Registro Virgin Colombia (18 USDT)">⚡ Desbloqueo No Registro Virgin Colombia (18 USDT) ⚡</option>

<option value="Desbloqueo No Registro Virgin Fast Colombia (16.5 USDT)">⚡ Desbloqueo No Registro Virgin Fast Colombia (16.5 USDT) ⚡</option>

<option value="Desbloqueo No Registro WOM Colombia (17.2 USDT)">⚡ Desbloqueo No Registro WOM Colombia (17.2 USDT) ⚡</option>

<option value="No Registro Claro Premium Colombia (15 USDT)">⚡ No Registro Claro Premium Colombia (15 USDT) ⚡</option>

<option value="Quitar No Registro Movistar 24H Colombia (13 USDT)">⚡ Quitar No Registro Movistar 24H Colombia (13 USDT) ⚡</option>

<option value="Quitar No Registro Movistar Sin Info 24H Colombia (14.5 USDT)">⚡ Quitar No Registro Movistar Sin Info 24H Colombia (14.5 USDT) ⚡</option>

<option value="Registro Claro Blacklist GSMA Colombia (18 USDT)">⚡ Registro Claro Blacklist GSMA Colombia (18 USDT) ⚡</option>

<option value="HFZ Activator A12+ Premium Bypass No Signal (21 USDT)">⚡ HFZ Activator A12+ Premium Bypass No Signal (21 USDT) ⚡</option>

<option value="Recuperado Claro — Solo Sustraídos (74.8 USDT)">⚡ Recuperado Claro — Solo Sustraídos (74.8 USDT) ⚡</option>

<option value="Huawei Worldwide Unlock Code NCK Only (44 USDT)">⚡ Huawei Worldwide Unlock Code NCK Only (44 USDT) ⚡</option>

<option value="LU‑WIFI A12+ XR‑16PM iPads iOS 18‑26 (12.9 USDT)">⚡ LU‑WIFI A12+ XR‑16PM iPads iOS 18‑26 (12.9 USDT) ⚡</option>

<option value="GSMA Blacklist — Agregar Reporte Global (14.8 USDT)">⚡ GSMA Blacklist — Agregar Reporte Global (14.8 USDT) ⚡</option>

<option value="Claro All Country iPhone 4S–XS Max Premium (21.5 USDT)">⚡ Claro All Country iPhone 4S–XS Max Premium (21.5 USDT) ⚡</option>

<option value="Claro Unlock iPhone 11 Series (32.5 USDT)">⚡ Claro Unlock iPhone 11 Series (32.5 USDT) ⚡</option>

<option value="Claro Unlock iPhone 15 Series (74 USDT)">⚡ Claro Unlock iPhone 15 Series (74 USDT) ⚡</option>

<option value="Claro Unlock iPhone 12 Series (37 USDT)">⚡ Claro Unlock iPhone 12 Series (37 USDT) ⚡</option>

<option value="Claro Unlock iPhone 13 Series (44.5 USDT)">⚡ Claro Unlock iPhone 13 Series (44.5 USDT) ⚡</option>

<option value="Claro Unlock iPhone 14 Series (54.5 USDT)">⚡ Claro Unlock iPhone 14 Series (54.5 USDT) ⚡</option>

<option value="Claro Unlock iPhone 16 Series (104 USDT)">⚡ Claro Unlock iPhone 16 Series (104 USDT) ⚡</option>

<option value="T‑Mobile/Sprint/Metro iPhone 15 Series (110.5 USDT)">⚡ T‑Mobile/Sprint/Metro iPhone 15 Series (110.5 USDT) ⚡</option>

<option value="T‑Mobile/Sprint/Metro iPhone 16 Series (112.5 USDT)">⚡ T‑Mobile/Sprint/Metro iPhone 16 Series (112.5 USDT) ⚡</option>

<option value="T‑Mobile/Sprint/Metro iPhone 17 Series (115.5 USDT)">⚡ T‑Mobile/Sprint/Metro iPhone 17 Series (115.5 USDT) ⚡</option>

<option value="T‑Mobile/Sprint/Metro iPhone X–14 Series (95 USDT)">⚡ T‑Mobile/Sprint/Metro iPhone X–14 Series (95 USDT) ⚡</option>

<option value="Xiaomi Perú — Clean Account Auto API (21.2 USDT)">⚡ Xiaomi Perú — Clean Account Auto API (21.2 USDT) ⚡</option>

<option value="AREPATOOL Activator A12+ Official (11.4 USDT)">⚡ AREPATOOL Activator A12+ Official (11.4 USDT) ⚡</option>

<option value="iRemoval Pro A12+ Bypass No Signal (17.6 USDT)">⚡ iRemoval Pro A12+ Bypass No Signal (17.6 USDT) ⚡</option>

<option value="FRPFILE Activator A12+ Premium (14.8 USDT)">⚡ FRPFILE Activator A12+ Premium (14.8 USDT) ⚡</option>

<option value="Levantar Señal Movistar/Bitel/Entel (53.8 USDT)">⚡ Levantar Señal Movistar/Bitel/Entel (53.8 USDT) ⚡</option>

<option value="Homologación IMEI Chile — Lista Blanca (14.2 USDT)">⚡ Homologación IMEI Chile — Lista Blanca (14.2 USDT) ⚡</option>

<option value="Renta Cheetah Tool 4 Hrs (12.3 USDT)">⚡ Renta Cheetah Tool 4 Hrs (12.3 USDT) ⚡</option>
<option value="Renta DFT Pro 24 Hrs (12.3 USDT)">⚡ Renta DFT Pro 24 Hrs (12.3 USDT) ⚡</option>
<option value="Renta Hydra Tool 24 Hrs (12.3 USDT)">⚡ Renta Hydra Tool 24 Hrs (12.3 USDT) ⚡</option>
<option value="Renta MDMFIX 6 Hrs (12.3 USDT)">⚡ Renta MDMFIX 6 Hrs (12.3 USDT) ⚡</option>
<option value="Renta RTC Tool 12 Hrs (12.3 USDT)">⚡ Renta RTC Tool 12 Hrs (12.3 USDT) ⚡</option>
<option value="Renta TSM Tool 6 Hrs (12.3 USDT)">⚡ Renta TSM Tool 6 Hrs (12.3 USDT) ⚡</option>

<option value="#1 Honor FRP Key Auto API (37 USDT)">⚡ #1 Honor FRP Key Auto API (37 USDT) ⚡</option>

<option value="Lista Blanca Perú — Equipos Bloqueados (42.4 USDT)">⚡ Lista Blanca Perú — Equipos Bloqueados (53.57 USDT) ⚡</option>
<option value="Lista Blanca Perú — No Bloqueados (21.7 USDT)">⚡ Lista Blanca Perú — No Bloqueados (21.7 USDT) ⚡</option>

<option value="TECNO/INFINIX/ITEL — ICLOUD Official Server (19.5 USDT)">⚡ TECNO/INFINIX/ITEL — ICLOUD Official Server (19.5 USDT) ⚡</option>
<option value="TECNO/INFINIX/ITEL — MDM Unlock (23 USDT)">⚡ TECNO/INFINIX/ITEL — MDM Unlock (23 USDT) ⚡</option>
<option value="TECNO/INFINIX/ITEL — MDM Unlock Premium (19 USDT)">⚡ TECNO/INFINIX/ITEL — MDM Unlock Premium (19 USDT) ⚡</option>

<option value="ESIM QR Activar SIM2 iPhone (12 USDT)">⚡ ESIM QR Activar SIM2 iPhone (12 USDT) ⚡</option>

<option value="Xiaomi Check Device & Country (10.073 USDT)">⚡ Xiaomi Check Device & Country (10.073 USDT) ⚡</option>
<option value="Xiaomi Region Activation Check (10.75 USDT)">⚡ Xiaomi Region Activation Check (10.75 USDT) ⚡</option>
<option value="Xiaomi Mi Account Remove Turkey Clean (27.5 USDT)">⚡ Xiaomi Mi Account Remove Turkey Clean (27.5 USDT) ⚡</option>

<option value="Mi Account Remove — Worldwide Clean (36.2 USDT)">⚡ Mi Account Remove — Worldwide Clean (36.2 USDT) ⚡</option>
<option value="Mi Account Remove — Costa Rica (17.8 USDT)">⚡ Mi Account Remove — Costa Rica (17.8 USDT) ⚡</option>
<option value="Mi Account Remove — Argentina (30.5 USDT)">⚡ Mi Account Remove — Argentina (30.5 USDT) ⚡</option>
<option value="Mi Account Remove — Pakistan (14 USDT)">⚡ Mi Account Remove — Pakistan (14 USDT) ⚡</option>
<option value="Mi Account Remove — KSA (21.2 USDT)">⚡ Mi Account Remove — KSA (21.2 USDT) ⚡</option>
<option value="Mi Account Remove — México (15.7 USDT)">⚡ Mi Account Remove — México (15.7 USDT) ⚡</option>
<option value="Mi Account Remove — Uruguay (22.3 USDT)">⚡ Mi Account Remove — Uruguay (22.3 USDT) ⚡</option>
<option value="Mi Account Remove — Honduras (26.8 USDT)">⚡ Mi Account Remove — Honduras (26.8 USDT) ⚡</option>
<option value="Mi Account Remove — Colombia (22.5 USDT)">⚡ Mi Account Remove — Colombia (22.5 USDT) ⚡</option>
<option value="Mi Account Remove — Egypt (14.3 USDT)">⚡ Mi Account Remove — Egypt (14.3 USDT) ⚡</option>
<option value="Mi Account Remove — UAE (22.7 USDT)">⚡ Mi Account Remove — UAE (22.7 USDT) ⚡</option>
<option value="Mi Account Remove — México 24H (15 USDT)">⚡ Mi Account Remove — México 24H (15 USDT) ⚡</option>
<option value="Mi Account Remove Panama Auto API (17 USDT)">⚡ Mi Account Remove Panama Auto API (17 USDT) ⚡</option>
<option value="Xiaomi Reactivation Lock Europe Only (17.1 USDT)">⚡ Xiaomi Reactivation Lock Europe Only (17.1 USDT) ⚡</option>

<option value="Minacriss iPads iOS 15‑18 With Signal (29 USDT)">⚡ Minacriss iPads iOS 15‑18 With Signal (29 USDT) ⚡</option>
<option value="Minacriss iPhone 6S iOS 15‑18 With Signal (26 USDT)">⚡ Minacriss iPhone 6S iOS 15‑18 With Signal (26 USDT) ⚡</option>
<option value="Minacriss iPhone 7/7+ iOS 15‑18 With Signal (32 USDT)">⚡ Minacriss iPhone 7/7+ iOS 15‑18 With Signal (32 USDT) ⚡</option>
<option value="Minacriss iPhone 8/8+ iOS 15‑18 With Signal (35 USDT)">⚡ Minacriss iPhone 8/8+ iOS 15‑18 With Signal (35 USDT) ⚡</option>
<option value="Minacriss iPhone X iOS 15‑18 With Signal (35 USDT)">⚡ Minacriss iPhone X iOS 15‑18 With Signal (35 USDT) ⚡</option>

</optgroup>

<optgroup label="IMEI Service">

<!-- ===================== REMOTE SERVICES ===================== -->
<option value="DFT Pro Tool Rent (30 Days) - $17.4">⚡ DFT Pro Tool Rent (30 Days) - $17.4 ⚡</option>
<option value="DFT Pro Tool Rent (45 Hours) - $5.3">⚡ DFT Pro Tool Rent (45 Hours) - $5.3 ⚡</option>
<option value="DFT Pro Tool Rent (45 Hours) Server 2 - $5.3">⚡ DFT Pro Tool Rent (45 Hours) Server 2 - $5.3 ⚡</option>
<option value="DFT Pro Tool Rent (7 Days) - $9">⚡ DFT Pro Tool Rent (7 Days) - $9 ⚡</option>

<option value="DT Pro Tool Digital Rent (2-4 Days) - $7">⚡ DT Pro Tool Digital Rent (2-4 Days) - $7 ⚡</option>
<option value="Nooox Tool Rent (3 Hours) - $5.1">⚡ Nooox Tool Rent (3 Hours) - $5.1 ⚡</option>
<option value="Pandora Digital Rent (48 Hours) - $13">⚡ Pandora Digital Rent (48 Hours) - $13 ⚡</option>
<option value="Pandora Digital Rent (2 Months) - $25">⚡ Pandora Digital Rent (2 Months) - $25 ⚡</option>

<option value="Borneo Schematics Rent - $4.45">⚡ Borneo Schematics Rent - $4.45 ⚡</option>

<option value="UnlockTool Rent (6 Hours) Server 1 - $4.2">⚡ UnlockTool Rent (6 Hours) Server 1 - $4.2 ⚡</option>
<option value="UnlockTool Rent (6 Hours) Server 2 - $4.2">⚡ UnlockTool Rent (6 Hours) Server 2 - $4.2 ⚡</option>
<option value="UnlockTool Rent (6 Hours) Server 3 - $4.2">⚡ UnlockTool Rent (6 Hours) Server 3 - $4.2 ⚡</option>

<option value="AWT Android Win Tool (48 Hours) Server 1 - $5.2">⚡ AWT Android Win Tool (48 Hours) Server 1 - $5.2 ⚡</option>
<option value="AWT Android Win Tool (48 Hours) Server 2 - $5.2">⚡ AWT Android Win Tool (48 Hours) Server 2 - $5.2 ⚡</option>

<option value="TFM Tool Rent (6 Hours) Source 2 - $4.3">⚡ TFM Tool Rent (6 Hours) Source 2 - $4.3 ⚡</option>

<option value="AMT Android Multi Tool (2 Hours) Server 1 - $4">⚡ AMT Android Multi Tool (2 Hours) Server 1 - $4 ⚡</option>
<option value="AMT Android Multi Tool (2 Hours) Server 2 - $4">⚡ AMT Android Multi Tool (2 Hours) Server 2 - $4 ⚡</option>

<option value="Cheetah Tool (4 Hours) Server 1 - $4.35">⚡ Cheetah Tool (4 Hours) Server 1 - $4.35 ⚡</option>
<option value="Cheetah Tool (4 Hours) Server 2 - $4.35">⚡ Cheetah Tool (4 Hours) Server 2 - $4.35 ⚡</option>

<option value="RTC (12 Hours) Server 1 - $4.7">⚡ RTC (12 Hours) Server 1 - $4.7 ⚡</option>
<option value="RTC (6 Hours) Server 2 - $4.3">⚡ RTC (6 Hours) Server 2 - $4.3 ⚡</option>

<option value="TSM Rent (10 Hours) Server 2 - $4.5">⚡ TSM Rent (10 Hours) Server 2 - $4.5 ⚡</option>
<option value="TSM Rent (12 Hours) Server 1 - $4.5">⚡ TSM Rent (12 Hours) Server 1 - $4.5 ⚡</option>

<option value="Moto Server FRP SPD (All models) - $8.5">⚡ Moto Server FRP SPD (All models) - $8.5 ⚡</option>
<option value="Moto Server G23 / G13 - $8.5">⚡ Moto Server G23 / G13 - $8.5 ⚡</option>
<option value="Moto Server MTK OLD - $5.5">⚡ Moto Server MTK OLD - $5.5 ⚡</option>
<option value="Moto Server Repair G15/G05/E15/G24/G24 Power - $15">⚡ Moto Server Repair G15/G05/E15/G24/G24 Power - $15 ⚡</option>
<option value="Moto Server Repair SPD NEW - $10.5">⚡ Moto Server Repair SPD NEW - $10.5 ⚡</option>
<option value="Moto Server SPD OLD - $5.5">⚡ Moto Server SPD OLD - $5.5 ⚡</option>

<option value="Android Multitool Rent Source 3 (2 Hours) - $4.7">⚡ Android Multitool Rent Source 3 (2 Hours) - $4.7 ⚡</option>
<option value="AWT Rent Source 3 (12 Hours) - $6">⚡ AWT Rent Source 3 (12 Hours) - $6 ⚡</option>
<option value="DFT Pro Tool Rent Source 3 (48 Hours) - $6.1">⚡ DFT Pro Tool Rent Source 3 (48 Hours) - $6.1 ⚡</option>
<option value="TSM Tools Rent Source 3 (6 Hours) - $4.8">⚡ TSM Tools Rent Source 3 (6 Hours) - $4.8 ⚡</option>
<!-- ================= END REMOTE SERVICES ===================== -->

</optgroup>


            </select>
        </div>

        <button type="submit">Registrar Dispositivo / Rentas / Activaciones</button>

    </form> <!-- ✔ CIERRE CORRECTO -->

    <a href="listaactualizada.php">Verificar Lista de Ordenes</a>
</div>

<script>
// Rellenar IMEI con ceros
document.getElementById("autoCeros").addEventListener("change", function () {
    let campo = document.getElementById("imei");
    campo.value = this.checked ? "000000000000000" : "";
});
</script>

</body>
</html>
