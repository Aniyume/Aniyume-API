# API Test Script
$baseUrl = "http://localhost:8000/api/v1"
$token = "3|vWUOWe2DhVNMqcFLANNguxNuPCWVJJkYMa3Jog9s9c61ba6f"

$headers = @{
    "Content-Type" = "application/json"
    "Authorization" = "Bearer $token"
}

Write-Host "`n=== Testing AniYume API ===" -ForegroundColor Cyan

# 1. Watch History - Add
Write-Host "`n[1/8] Testing Watch History - Add..." -ForegroundColor Yellow
$body = @{
    anime_id = 1
    episode_id = 78
    progress = 500
    completed = $false
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/watch-history" -Method Post -Headers $headers -Body $body
    Write-Host "✓ Success: Watch history added" -ForegroundColor Green
    $response | ConvertTo-Json -Depth 3
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 2. Watch History - Get
Write-Host "`n[2/8] Testing Watch History - Get..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/watch-history" -Method Get -Headers $headers
    Write-Host "✓ Success: Got watch history (Total: $($response.data.Count))" -ForegroundColor Green
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 3. Favorites - Add
Write-Host "`n[3/8] Testing Favorites - Add..." -ForegroundColor Yellow
$body = @{
    anime_id = 1
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/favorites" -Method Post -Headers $headers -Body $body
    Write-Host "✓ Success: Added to favorites" -ForegroundColor Green
    $response | ConvertTo-Json -Depth 3
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 4. Favorites - Get
Write-Host "`n[4/8] Testing Favorites - Get..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/favorites" -Method Get -Headers $headers
    Write-Host "✓ Success: Got favorites (Total: $($response.data.Count))" -ForegroundColor Green
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 5. Ratings - Add
Write-Host "`n[5/8] Testing Ratings - Add..." -ForegroundColor Yellow
$body = @{
    anime_id = 1
    rating = 8.5
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/ratings" -Method Post -Headers $headers -Body $body
    Write-Host "✓ Success: Rating added" -ForegroundColor Green
    $response | ConvertTo-Json -Depth 3
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 6. Ratings - Get
Write-Host "`n[6/8] Testing Ratings - Get..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/ratings" -Method Get -Headers $headers
    Write-Host "✓ Success: Got ratings (Total: $($response.data.Count))" -ForegroundColor Green
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

# 7. Comments - Add
Write-Host "`n[7/8] Testing Comments - Add..." -ForegroundColor Yellow
$body = @{
    anime_id = 1
    comment = "Great anime! Highly recommend to everyone."
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/comments" -Method Post -Headers $headers -Body $body
    Write-Host "✓ Success: Comment added" -ForegroundColor Green
    $response | ConvertTo-Json -Depth 3
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}


# 8. Comments - Get (public)
Write-Host "`n[8/8] Testing Comments - Get (Public)..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/anime/cowboy-bebop/comments" -Method Get
    Write-Host "✓ Success: Got comments (Total: $($response.data.Count))" -ForegroundColor Green
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`n=== Testing Complete ===" -ForegroundColor Cyan
Write-Host "`nCheck anime ID 1 in database to see updated counters!" -ForegroundColor Magenta
