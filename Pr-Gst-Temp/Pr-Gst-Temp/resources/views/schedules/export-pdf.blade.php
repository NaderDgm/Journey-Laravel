<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Emploi du temps</title>
    <style>
        * { margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        .container { width: 100%; max-width: 1000px; margin: 0 auto; }
        
        /* Header */
        .header {
            border: 3px solid #333;
            margin-bottom: 10px;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9f9f9;
            gap: 15px;
        }
        .header-left { 
            width: 15%; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header-left img {
            max-width: 100%;
            height: auto;
        }
        .header-center { 
            width: 70%; 
            text-align: center; 
        }
        .header-right { 
            width: 15%; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header-right img {
            max-width: 100%;
            height: auto;
        }
        .header-center h2 { font-size: 14px; font-weight: bold; margin-bottom: 5px; }
        .header-center p { font-size: 10px; }
        
        /* Title */
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #0066cc;
            margin: 10px 0;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 8px;
        }
        
        /* Info Section */
        .info-section {
            display: flex;
            gap: 30px;
            margin-bottom: 15px;
            font-size: 11px;
        }
        .info-column { width: 50%; }
        .info-row { margin-bottom: 6px; }
        .info-label { font-weight: bold; display: inline-block; width: 100px; }
        .info-value { display: inline-block; border-bottom: 1px solid #333; padding: 2px 4px; }
        
        /* Main Table */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #333;
            margin-top: 10px;
        }
        
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background: #d9e8f5;
            font-weight: bold;
            text-align: center;
        }
        
        /* First column styling */
        td:first-child {
            font-weight: bold;
            background: #e8e8e8;
            width: 12%;
            text-align: center;
        }
        
        /* Cell content */
        .cell-content {
            font-size: 10px;
            line-height: 1.4;
        }
        
        .cell-course {
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .cell-detail {
            font-size: 9px;
            color: #555;
        }
        
        /* Footer */
        .footer {
            margin-top: 15px;
            font-size: 10px;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
        
        .footer-note {
            margin-bottom: 10px;
            font-style: italic;
            color: #666;
        }
        
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .signature-box {
            width: 30%;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <!-- Logo 1 -->
            </div>
            <div class="header-center">
                <h2>Emploi du temps du groupe</h2>
                <p>Institut de formation professionnelle</p>
            </div>
            <div class="header-right">
                <!-- Logo 2 -->
            </div>
        </div>

        <!-- Title -->
        <div class="title">Emplois du Temps du Groupe</div>

        <!-- Info Section -->
        @php
            $groupName = '';
            $poleName = '';
            
            // Get group and pole info from the first schedule
            if ($schedules->isNotEmpty()) {
                $firstSchedule = $schedules->first();
                if ($firstSchedule->group) {
                    $groupName = $firstSchedule->group->code;
                    $poleName = $firstSchedule->group->filiere->name ?? 'Pôle';
                }
            }
            
            $times = $schedules->pluck('start_time')->unique()->sort()->values();
            $totalCourses = $schedules->count();
            $totalHours = $times->count() * 2.5;
        @endphp

        <div class="info-section">
            <div class="info-column">
                <div class="info-row">
                    <span class="info-label">PÔLE:</span>
                    <span class="info-value">{{ $poleName ?: 'Sans affectation' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">GROUPE:</span>
                    <span class="info-value">{{ $groupName ?: 'Sans groupe' }}</span>
                </div>
            </div>
            <div class="info-column">
                <div class="info-row">
                    <span class="info-label">DATE:</span>
                    <span class="info-value">{{ now()->format('d/m/Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">TOTAL HEURES:</span>
                    <span class="info-value">{{ $totalHours }} heures</span>
                </div>
            </div>
        </div>

        <!-- Main Timetable -->
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">JOURS / HEURES</th>
                    @foreach ($times as $time)
                        <th>
                            {{ \Illuminate\Support\Str::substr($time, 0, 5) }} — 
                            {{ \Illuminate\Support\Str::substr($schedules->where('start_time', $time)->first()->end_time ?? '11:00', 0, 5) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $allDays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                    $grouped = $schedules->groupBy('day');
                @endphp
                
                @foreach ($allDays as $day)
                    <tr>
                        <td>{{ strtoupper($day) }}</td>
                        @foreach ($times as $time)
                            <td>
                                @php
                                    $schedule = $grouped->get($day)?->where('start_time', $time)->first();
                                @endphp
                                @if ($schedule)
                                    <div class="cell-content">
                                        <div class="cell-course">{{ $schedule->title }}</div>
                                        <div class="cell-detail">FORMATEUR: {{ $schedule->teacher_name ?? '-' }}</div>
                                        <div class="cell-detail">SALLE: {{ $schedule->room_name ?? '-' }}</div>
                                    </div>
                                @else
                                    <div class="cell-content" style="color: #ccc;">-</div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">N.B. / Le présent emploi du temps peut subir un changement, si nécessaire par la direction de l'établissement.</div>
            
            <div class="signature-area">
                <div class="signature-box">
                    <strong>La Direction:</strong><br>
                    Fait à ________<br>
                    Le: {{ now()->format('d/m/Y') }}
                </div>
                <div class="signature-box">
                    Signature:<br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
