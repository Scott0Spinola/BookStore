Add-Type -AssemblyName System.Drawing

function Create-PlaceholderImage {
    param(
        [string]$OutputPath,
        [string]$Title,
        [int]$Width = 400,
        [int]$Height = 600
    )
    
    # Create bitmap
    $bitmap = New-Object System.Drawing.Bitmap($Width, $Height)
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    
    # Fill with random color
    $r = Get-Random -Minimum 80 -Maximum 180
    $g = Get-Random -Minimum 80 -Maximum 180
    $b = Get-Random -Minimum 80 -Maximum 180
    $bgBrush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb($r, $g, $b))
    $graphics.FillRectangle($bgBrush, 0, 0, $Width, $Height)
    
    # Add text
    $font = New-Object System.Drawing.Font("Arial", 24, [System.Drawing.FontStyle]::Bold)
    $textBrush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::White)
    $graphics.DrawString($Title, $font, $textBrush, 20, 250)
    
    # Save image
    $bitmap.Save($OutputPath, [System.Drawing.Imaging.ImageFormat]::Jpeg)
    
    # Cleanup
    $graphics.Dispose()
    $bitmap.Dispose()
    $font.Dispose()
    $textBrush.Dispose()
    $bgBrush.Dispose()
}

# Create missing images
$images = @(
    @{Path=".\storage\app\public\images\pride.jpg"; Title="Pride and Prejudice"},
    @{Path=".\storage\app\public\images\sandman.jpg"; Title="The Sandman"},
    @{Path=".\storage\app\public\images\uZ6ROcNLPKFCJnNmw1giATHwMAT9lkDg1YGWKUTE.png"; Title="John Doe"},
    @{Path=".\storage\app\public\images\IqOaCggKIKM5oQcFTKi85M08dWTul0u98cSOx79R.png"; Title="Book"}
)

foreach ($img in $images) {
    if (-not (Test-Path $img.Path)) {
        Write-Host "Creating placeholder for: $($img.Title)"
        Create-PlaceholderImage -OutputPath $img.Path -Title $img.Title
    } else {
        Write-Host "Image already exists: $($img.Path)"
    }
}

Write-Host "Done!"
