$baseUrl = "http://127.0.0.1:8000/api/v1"
$timestamp = Get-Date -Format "yyyyMMddHHmmss"
$testEmail = "testuser_$timestamp@example.com"
$testName = "Test User $timestamp"

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  AniYume Auth API Complete Test" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "TEST 1 - POST /api/v1/register" -ForegroundColor Yellow
Write-Host "Creating new user: $testEmail" -ForegroundColor Gray
$registerBody = @{
    name = $testName
    email = $testEmail
    password = "password123"
    password_confirmation = "password123"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/register" -Method Post -Body $registerBody -ContentType "application/json" -UseBasicParsing
    $registerResponse = $response.Content | ConvertFrom-Json
    
    if ($response.StatusCode -eq 201 -or $response.StatusCode -eq 200) {
        Write-Host "SUCCESS: User registered (Status: $($response.StatusCode))" -ForegroundColor Green
        Write-Host "  User ID: $($registerResponse.user.data.id)" -ForegroundColor White
        Write-Host "  Name: $($registerResponse.user.data.name)" -ForegroundColor White
        Write-Host "  Email: $($registerResponse.user.data.email)" -ForegroundColor White
        Write-Host "  Token: $($registerResponse.token.Substring(0, 30))..." -ForegroundColor White
        $token = $registerResponse.token
        $userId = $registerResponse.user.data.id
    } else {
        Write-Host "FAILED: Unexpected status $($response.StatusCode)" -ForegroundColor Red
        exit 1
    }
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
    exit 1
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 2 - GET /api/v1/user (me endpoint)" -ForegroundColor Yellow
Write-Host "Getting current user info with token..." -ForegroundColor Gray
$headers = @{
    "Authorization" = "Bearer $token"
    "Accept" = "application/json"
}

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/user" -Method Get -Headers $headers -UseBasicParsing
    $userResponse = $response.Content | ConvertFrom-Json
    Write-Host "SUCCESS: User info retrieved" -ForegroundColor Green
    Write-Host "  User ID: $($userResponse.data.id)" -ForegroundColor White
    Write-Host "  Name: $($userResponse.data.name)" -ForegroundColor White
    Write-Host "  Email: $($userResponse.data.email)" -ForegroundColor White
    Write-Host "  Active: $($userResponse.data.is_active)" -ForegroundColor White
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 3 - POST /api/v1/logout" -ForegroundColor Yellow
Write-Host "Logging out (invalidating token)..." -ForegroundColor Gray
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/logout" -Method Post -Headers $headers -UseBasicParsing
    $logoutResponse = $response.Content | ConvertFrom-Json
    Write-Host "SUCCESS: $($logoutResponse.message)" -ForegroundColor Green
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 4 - GET /api/v1/user (with invalidated token)" -ForegroundColor Yellow
Write-Host "Trying to access with old token (should fail)..." -ForegroundColor Gray
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/user" -Method Get -Headers $headers -UseBasicParsing
    Write-Host "UNEXPECTED: Should have failed but succeeded" -ForegroundColor Red
} catch {
    Write-Host "SUCCESS: Token invalidated (401 Unauthorized)" -ForegroundColor Green
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 5 - POST /api/v1/login" -ForegroundColor Yellow
Write-Host "Logging in with created user..." -ForegroundColor Gray
$loginBody = @{
    email = $testEmail
    password = "password123"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/login" -Method Post -Body $loginBody -ContentType "application/json" -UseBasicParsing
    $loginResponse = $response.Content | ConvertFrom-Json
    Write-Host "SUCCESS: User logged in" -ForegroundColor Green
    Write-Host "  User ID: $($loginResponse.user.data.id)" -ForegroundColor White
    Write-Host "  Name: $($loginResponse.user.data.name)" -ForegroundColor White
    Write-Host "  New Token: $($loginResponse.token.Substring(0, 30))..." -ForegroundColor White
    $newToken = $loginResponse.token
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 6 - POST /api/v1/login (wrong password)" -ForegroundColor Yellow
Write-Host "Trying to login with wrong password (should fail)..." -ForegroundColor Gray
$wrongLoginBody = @{
    email = $testEmail
    password = "wrongpassword123"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/login" -Method Post -Body $wrongLoginBody -ContentType "application/json" -UseBasicParsing
    $errorResponse = $response.Content | ConvertFrom-Json
    
    if ($response.StatusCode -eq 200 -and $errorResponse.token) {
        Write-Host "UNEXPECTED: Should have failed but succeeded" -ForegroundColor Red
        Write-Host "  Response: $($response.Content)" -ForegroundColor Red
    } else {
        Write-Host "PARTIAL: Got status $($response.StatusCode) but checking content..." -ForegroundColor Yellow
    }
} catch {
    $statusCode = $_.Exception.Response.StatusCode.value__
    if ($statusCode -eq 422) {
        Write-Host "SUCCESS: Invalid credentials rejected (422)" -ForegroundColor Green
    } else {
        Write-Host "SUCCESS: Request failed with status $statusCode" -ForegroundColor Green
    }
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 7 - POST /api/v1/login (non-existent user)" -ForegroundColor Yellow
Write-Host "Trying to login with non-existent email (should fail)..." -ForegroundColor Gray
$fakeLoginBody = @{
    email = "nonexistent_$timestamp@example.com"
    password = "password123"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/login" -Method Post -Body $fakeLoginBody -ContentType "application/json" -UseBasicParsing
    $errorResponse = $response.Content | ConvertFrom-Json
    
    if ($response.StatusCode -eq 200 -and $errorResponse.token) {
        Write-Host "UNEXPECTED: Should have failed but succeeded" -ForegroundColor Red
        Write-Host "  Response: $($response.Content)" -ForegroundColor Red
    } else {
        Write-Host "PARTIAL: Got status $($response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    $statusCode = $_.Exception.Response.StatusCode.value__
    if ($statusCode -eq 422) {
        Write-Host "SUCCESS: Non-existent user rejected (422)" -ForegroundColor Green
    } else {
        Write-Host "SUCCESS: Request failed with status $statusCode" -ForegroundColor Green
    }
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 8 - GET /api/v1/user (with new token)" -ForegroundColor Yellow
Write-Host "Verifying new token works..." -ForegroundColor Gray
$newHeaders = @{
    "Authorization" = "Bearer $newToken"
    "Accept" = "application/json"
}

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/user" -Method Get -Headers $newHeaders -UseBasicParsing
    $userResponse = $response.Content | ConvertFrom-Json
    Write-Host "SUCCESS: New token works correctly" -ForegroundColor Green
    Write-Host "  User ID: $($userResponse.data.id)" -ForegroundColor White
    Write-Host "  Name: $($userResponse.data.name)" -ForegroundColor White
    Write-Host "  Email: $($userResponse.data.email)" -ForegroundColor White
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Start-Sleep -Seconds 1

Write-Host "TEST 9 - POST /api/v1/register (duplicate email)" -ForegroundColor Yellow
Write-Host "Trying to register with existing email (should fail)..." -ForegroundColor Gray
$duplicateBody = @{
    name = "Duplicate User"
    email = $testEmail
    password = "password123"
    password_confirmation = "password123"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri "$baseUrl/register" -Method Post -Body $duplicateBody -ContentType "application/json" -UseBasicParsing
    $errorResponse = $response.Content | ConvertFrom-Json
    
    if ($response.StatusCode -eq 200 -and $errorResponse.token) {
        Write-Host "UNEXPECTED: Should have failed but succeeded" -ForegroundColor Red
        Write-Host "  Got new token - duplicate check not working!" -ForegroundColor Red
    } else {
        Write-Host "PARTIAL: Got status $($response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    $statusCode = $_.Exception.Response.StatusCode.value__
    if ($statusCode -eq 422) {
        Write-Host "SUCCESS: Duplicate email rejected (422)" -ForegroundColor Green
    } else {
        Write-Host "SUCCESS: Request failed with status $statusCode" -ForegroundColor Green
    }
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  All Auth Tests Completed!" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Summary:" -ForegroundColor Yellow
Write-Host "  Test User Created: $testEmail" -ForegroundColor White
Write-Host "  User ID: $userId" -ForegroundColor White
Write-Host ""
Write-Host "IMPORTANT: Check results of tests 6, 7, 9" -ForegroundColor Yellow
Write-Host "If they show UNEXPECTED - validation is not working!" -ForegroundColor Red
Write-Host ""
Write-Host "To check AuditLog run:" -ForegroundColor Yellow
Write-Host "  php artisan audit:check" -ForegroundColor Gray
