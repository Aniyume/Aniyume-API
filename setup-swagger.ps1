# ========================================
# AniYume Swagger Documentation Setup
# PowerShell версия для Windows
# ========================================

Write-Host "`n🚀 Starting Swagger Documentation Setup...`n" -ForegroundColor Cyan

# Шаг 1: Проверка установки пакета
Write-Host "📦 Step 1: Checking l5-swagger package..." -ForegroundColor Yellow
$composerShow = composer show darkaonline/l5-swagger 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ l5-swagger is installed`n" -ForegroundColor Green
} else {
    Write-Host "⚠️  Installing l5-swagger..." -ForegroundColor Yellow
    composer require "darkaonline/l5-swagger"
    Write-Host ""
}

# Шаг 2: Публикация конфигурации
Write-Host "📝 Step 2: Publishing config..." -ForegroundColor Yellow
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider" --force
Write-Host "✅ Config published`n" -ForegroundColor Green

# Шаг 3: Очистка кэша
Write-Host "🧹 Step 3: Clearing cache..." -ForegroundColor Yellow
php artisan config:clear
php artisan cache:clear
Write-Host "✅ Cache cleared`n" -ForegroundColor Green

# Шаг 4: Генерация документации
Write-Host "📚 Step 4: Generating Swagger documentation..." -ForegroundColor Yellow
php artisan l5-swagger:generate
Write-Host "✅ Documentation generated`n" -ForegroundColor Green

# Шаг 5: Проверка маршрутов
Write-Host "🔍 Step 5: Checking routes..." -ForegroundColor Yellow
php artisan route:list | Select-String -Pattern "(documentation|swagger)"
Write-Host ""

# Информация о доступе
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "✨ Setup Complete!" -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "📖 Access Swagger UI:" -ForegroundColor Green
Write-Host "   Local:  http://localhost:8000/api/documentation" -ForegroundColor White
Write-Host "   Ngrok:  https://leanna-superurgent-unfearfully.ngrok-free.dev/api/documentation" -ForegroundColor White
Write-Host ""
Write-Host "📄 Swagger JSON:" -ForegroundColor Green
Write-Host "   http://localhost:8000/docs/api-docs.json" -ForegroundColor White
Write-Host ""
Write-Host "🔐 To test protected endpoints:" -ForegroundColor Green
Write-Host "   1. Register: POST /api/v1/register" -ForegroundColor White
Write-Host "   2. Copy the 'token' from response" -ForegroundColor White
Write-Host "   3. Click 'Authorize' button in Swagger UI" -ForegroundColor White
Write-Host "   4. Enter: Bearer {your-token}" -ForegroundColor White
Write-Host ""
Write-Host "⚠️  For Ngrok requests add header:" -ForegroundColor Yellow
Write-Host "   'ngrok-skip-browser-warning': 'true'" -ForegroundColor White
Write-Host ""
Write-Host "==========================================" -ForegroundColor Cyan

# Опциональная проверка доступности
Write-Host ""
$test = Read-Host "🧪 Test local Swagger UI? (y/n)"
if ($test -eq "y" -or $test -eq "Y") {
    Write-Host "Testing http://localhost:8000/api/documentation..." -ForegroundColor Yellow
    try {
        $response = Invoke-WebRequest -Uri "http://localhost:8000/api/documentation" -UseBasicParsing -TimeoutSec 5
        if ($response.StatusCode -eq 200) {
            Write-Host "✅ Swagger UI is accessible (HTTP $($response.StatusCode))" -ForegroundColor Green
            Write-Host "🌐 Opening in browser..." -ForegroundColor Cyan
            Start-Process "http://localhost:8000/api/documentation"
        }
    } catch {
        Write-Host "⚠️  Could not reach Swagger UI" -ForegroundColor Yellow
        Write-Host "   Make sure Laravel server is running:" -ForegroundColor White
        Write-Host "   php artisan serve" -ForegroundColor Gray
    }
}

Write-Host "`n🎉 All done! Happy API testing!`n" -ForegroundColor Cyan


# ========================================
# ТЕСТИРОВАНИЕ API (PowerShell примеры)
# ========================================

Write-Host "📝 Want to test the API now? Here are some examples:`n" -ForegroundColor Yellow

Write-Host "1️⃣  Get anime list:" -ForegroundColor Cyan
Write-Host @"
`$response = Invoke-RestMethod -Uri "http://localhost:8000/api/v1/anime" -Method Get
`$response.data
"@ -ForegroundColor Gray

Write-Host "`n2️⃣  Register a user:" -ForegroundColor Cyan
Write-Host @"
`$body = @{
    name = "Test User"
    email = "test@example.com"
    password = "password123"
    password_confirmation = "password123"
} | ConvertTo-Json

`$response = Invoke-RestMethod -Uri "http://localhost:8000/api/v1/register" ``
    -Method Post ``
    -Body `$body ``
    -ContentType "application/json"

`$token = `$response.token
Write-Host "Token: `$token"
"@ -ForegroundColor Gray

Write-Host "`n3️⃣  Add to favorites (with token):" -ForegroundColor Cyan
Write-Host @"
`$headers = @{
    "Authorization" = "Bearer `$token"
    "Content-Type" = "application/json"
}

`$body = @{ anime_id = 1 } | ConvertTo-Json

`$response = Invoke-RestMethod -Uri "http://localhost:8000/api/v1/favorites" ``
    -Method Post ``
    -Headers `$headers ``
    -Body `$body

`$response
"@ -ForegroundColor Gray

Write-Host "`n4️⃣  Rate anime:" -ForegroundColor Cyan
Write-Host @"
`$body = @{
    anime_id = 1
    rating = 8.5
} | ConvertTo-Json

`$response = Invoke-RestMethod -Uri "http://localhost:8000/api/v1/ratings" ``
    -Method Post ``
    -Headers `$headers ``
    -Body `$body

`$response
"@ -ForegroundColor Gray

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "💡 Tips:" -ForegroundColor Yellow
Write-Host "   - Use Swagger UI for interactive testing" -ForegroundColor White
Write-Host "   - Check API_DOCS.md for endpoint details" -ForegroundColor White
Write-Host "   - All endpoints are documented with examples" -ForegroundColor White
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Дополнительные команды
Write-Host "🔧 Useful commands:" -ForegroundColor Yellow
Write-Host "   Regenerate docs:    php artisan l5-swagger:generate" -ForegroundColor Gray
Write-Host "   View API routes:    php artisan route:list | Select-String 'api/v1'" -ForegroundColor Gray
Write-Host "   Clear all cache:    php artisan optimize:clear" -ForegroundColor Gray
Write-Host ""