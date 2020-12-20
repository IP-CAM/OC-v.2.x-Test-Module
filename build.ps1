$new = Read-Host "Please enter new name"
Get-ChildItem  -Filter .\*.php -Recurse | where {-not $_.psiscontainer} | Foreach-Object {       
$a = ($_ | Get-Content)        
If ($a | Select-String -Pattern ‘mymodule’) {
    $a = $a -creplace ‘mymodule’, $new
    $a = $a -creplace ‘Mymodule’, $new
    [IO.File]::WriteAllText((($_.FullName) -creplace ‘mymodule’,’neworder’), ($a -join “`r`n”)) 
    Remove-Item $_.FullName}
}