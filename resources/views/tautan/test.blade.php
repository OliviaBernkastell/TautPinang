<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEBUG - All Tautan Data | Taut Pinang</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .tautan-item {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 30px;
            overflow: hidden;
            background: #fafafa;
        }
        .tautan-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 18px;
        }
        .tautan-body {
            padding: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            padding: 8px 12px;
            background: #f0f0f0;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        .data-content {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            word-break: break-all;
            max-height: 300px;
            overflow-y: auto;
        }
        .json-content {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 11px;
            white-space: pre-wrap;
            max-height: 400px;
            overflow-y: auto;
        }
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 18px;
        }
        .debug-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .qr-status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        .qr-enabled {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .qr-disabled {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .qr-missing {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .links-list {
            list-style: none;
            padding: 0;
        }
        .links-list li {
            background: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            border-left: 3px solid #007bff;
        }
        .links-list a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .links-list a:hover {
            text-decoration: underline;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 DEBUG - All Tautan Data</h1>
            <p>Complete Database Dump for Debugging</p>
        </div>

        <div class="content">
            <!-- Debug Info -->
            <div class="debug-info">
                <strong>🐛 Debug Mode Active</strong><br>
                This page shows all tautan data from database. Check for QR Code settings and styling data.
            </div>

            <!-- Statistics -->
            @if(!empty($tautans) && count($tautans) > 0)
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number">{{ count($tautans) }}</div>
                    <div class="stat-label">Total Tautan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $tautans->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $tautans->where('is_active', false)->count() }}</div>
                    <div class="stat-label">Inactive</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <?php
                        $qrCount = $tautans->filter(function($t) {
                            return !empty($t->styles['qrcode']['enabled']) && $t->styles['qrcode']['enabled'];
                        })->count();
                        echo $qrCount;
                        ?>
                    </div>
                    <div class="stat-label">QR Enabled</div>
                </div>
            </div>
            @endif

            <!-- All Tautans -->
            @if(!empty($tautans) && count($tautans) > 0)
                @foreach($tautans as $index => $tautan)
                    <div class="tautan-item">
                        <div class="tautan-header">
                            #{{ $index + 1 }} - {{ $tautan->title ?? 'Untitled' }} ({{ $tautan->slug }})
                            <span style="float: right;">
                                @if($tautan->is_active)
                                    <span style="background: #d4edda; color: #155724; padding: 2px 8px; border-radius: 4px; font-size: 12px;">ACTIVE</span>
                                @else
                                    <span style="background: #f8d7da; color: #721c24; padding: 2px 8px; border-radius: 4px; font-size: 12px;">INACTIVE</span>
                                @endif
                            </span>
                        </div>

                        <div class="tautan-body">
                            <!-- Basic Info -->
                            <div class="section">
                                <div class="section-title">📋 Basic Information</div>
                                <div class="data-content">
                                    <strong>ID:</strong> {{ $tautan->id }}<br>
                                    <strong>User ID:</strong> {{ $tautan->user_id }}<br>
                                    <strong>Title:</strong> {{ $tautan->title ?? 'NULL' }}<br>
                                    <strong>Slug:</strong> {{ $tautan->slug }}<br>
                                    <strong>Description:</strong> {{ $tautan->description ?? 'NULL' }}<br>
                                    <strong>Logo URL:</strong> {{ $tautan->logo_url ?? 'NULL' }}<br>
                                    <strong>Footer Text 1:</strong> {{ $tautan->footer_text_1 ?? 'NULL' }}<br>
                                    <strong>Footer Text 2:</strong> {{ $tautan->footer_text_2 ?? 'NULL' }}<br>
                                    <strong>Is Active:</strong> {{ $tautan->is_active ? 'TRUE' : 'FALSE' }}<br>
                                    <strong>Created:</strong> {{ $tautan->created_at ?? 'NULL' }}<br>
                                    <strong>Updated:</strong> {{ $tautan->updated_at ?? 'NULL' }}
                                </div>
                            </div>

                            <!-- QR Code Status -->
                            <div class="section">
                                <div class="section-title">📱 QR Code Status</div>
                                <div class="data-content">
                                    @if(!empty($tautan->styles) && isset($tautan->styles['qrcode']))
                                        @if(!empty($tautan->styles['qrcode']['enabled']) && $tautan->styles['qrcode']['enabled'])
                                            <span class="qr-status qr-enabled">✅ QR ENABLED</span><br>
                                            <strong>Position:</strong> {{ $tautan->styles['qrcode']['position'] ?? 'N/A' }}<br>
                                            <strong>Size:</strong> {{ $tautan->styles['qrcode']['size'] ?? 'N/A' }}px<br>
                                            <strong>Border Color:</strong> {{ $tautan->styles['qrcode']['borderColor'] ?? 'N/A' }}<br>
                                            <strong>Dark Color:</strong> {{ $tautan->styles['qrcode']['darkColor'] ?? 'N/A' }}<br>
                                            <strong>Show on Mobile:</strong> {{ $tautan->styles['qrcode']['showOnMobile'] ? 'YES' : 'NO' }}<br>
                                            <strong>Tooltip:</strong> {{ $tautan->styles['qrcode']['tooltipText'] ?? 'N/A' }}
                                        @else
                                            <span class="qr-status qr-disabled">❌ QR DISABLED</span><br>
                                            <em>QR Code settings exist but is disabled</em>
                                        @endif
                                    @else
                                        <span class="qr-status qr-missing">⚠️ QR MISSING</span><br>
                                        <em>No QR Code settings found in styles</em>
                                    @endif
                                </div>
                            </div>

                            <!-- Links -->
                            <div class="section">
                                <div class="section-title">🔗 Links ({{ count($tautan->links ?? []) }} items)</div>
                                @if(!empty($tautan->links) && count($tautan->links) > 0)
                                    <ul class="links-list">
                                        @foreach($tautan->links as $link)
                                            <li>
                                                <strong>{{ $link['judul'] ?? 'No Title' }}</strong><br>
                                                <a href="{{ $link['url'] }}" target="_blank">{{ $link['url'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="data-content">
                                        <em>No links found</em>
                                    </div>
                                @endif
                            </div>

                            <!-- Raw Database JSON (bypass accessor) -->
                            <div class="section">
                                <div class="section-title">🗄️ Raw Database JSON (Actual Data)</div>
                                <div class="json-content">{{ json_encode($tautan->getRawOriginal('styles'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
                            </div>

                            <!-- Complete Styles JSON (with accessor) -->
                            <div class="section">
                                <div class="section-title">🎨 Accessor JSON (Modified Data)</div>
                                <div class="json-content">{{ json_encode($tautan->styles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
                            </div>

                            <!-- Public URL -->
                            <div class="section">
                                <div class="section-title">🌐 Public URL</div>
                                <div class="data-content">
                                    <a href="{{ route('tautan.show', $tautan->slug) }}" target="_blank" style="font-size: 16px; font-weight: bold; color: #007bff;">
                                        {{ route('tautan.show', $tautan->slug) }}
                                    </a>
                                    <br><br>
                                    <a href="{{ route('tautan.show', $tautan->slug) }}" target="_blank" class="btn" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                                        🔗 Open Live Page
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-message">
                    <h2>📭 No Tautan Found</h2>
                    <p>There are no tautan records in the database.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-refresh every 30 seconds
        setTimeout(() => {
            location.reload();
        }, 30000);

        // Add click-to-copy for JSON sections
        document.querySelectorAll('.json-content').forEach(element => {
            element.style.cursor = 'pointer';
            element.title = 'Click to copy JSON';
            element.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent).then(() => {
                    const originalBg = this.style.backgroundColor;
                    this.style.backgroundColor = '#48bb78';
                    this.style.color = 'white';
                    setTimeout(() => {
                        this.style.backgroundColor = originalBg;
                        this.style.color = '#e2e8f0';
                    }, 500);
                });
            });
        });
    </script>
</body>
</html>