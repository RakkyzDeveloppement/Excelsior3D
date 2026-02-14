# Build static assets (copy from src to public)
$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$srcCss = Join-Path $root 'src\assets\css\app.css'
$srcJs = Join-Path $root 'src\assets\js\app.js'
$dstCssDir = Join-Path $root 'public\assets\css'
$dstJsDir = Join-Path $root 'public\assets\js'

New-Item -ItemType Directory -Force -Path $dstCssDir, $dstJsDir | Out-Null
Copy-Item -Force $srcCss (Join-Path $dstCssDir 'app.css')
Copy-Item -Force $srcJs (Join-Path $dstJsDir 'app.js')

Write-Host 'Assets copied to public/assets.'
