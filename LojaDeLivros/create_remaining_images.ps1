$basePath = "C:\Users\spino\Documents\GitHub\BookStore\LojaDeLivros\storage\app\public\images"
Add-Type -AssemblyName System.Drawing

$books = @(
    @{file="sandman.jpg"; title="The Sandman"; color=@(138, 43, 226)},
    @{file="uZ6ROcNLPKFCJnNmw1giATHwMAT9lkDg1YGWKUTE.png"; title="John Doe"; color=@(220, 20, 60)},
    @{file="IqOaCggKIKM5oQcFTKi85M08dWTul0u98cSOx79R.png"; title="Book Title"; color=@(34, 139, 34)}
)

foreach ($book in $books) {
    $filepath = Join-Path $basePath $book.file
    
    if (Test-Path $filepath) {
        Write-Host "Already exists: $($book.file)"
        continue
    }
    
    $bitmap = New-Object System.Drawing.Bitmap(400, 600)
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    
    $bgBrush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::FromArgb($book.color[0], $book.color[1], $book.color[2]))
    $graphics.FillRectangle($bgBrush, 0, 0, 400, 600)
    
    $font = New-Object System.Drawing.Font("Arial", 20, [System.Drawing.FontStyle]::Bold)
    $textBrush = New-Object System.Drawing.SolidBrush([System.Drawing.Color]::White)
    $graphics.DrawString($book.title, $font, $textBrush, 50, 250)
    
    if ($book.file -like "*.png") {
        $bitmap.Save($filepath, [System.Drawing.Imaging.ImageFormat]::Png)
    } else {
        $bitmap.Save($filepath, [System.Drawing.Imaging.ImageFormat]::Jpeg)
    }
    
    $graphics.Dispose()
    $bitmap.Dispose()
    $font.Dispose()
    $textBrush.Dispose()
    $bgBrush.Dispose()
    
    Write-Host "Created: $($book.file)"
}

Write-Host "`nAll placeholders created!"
