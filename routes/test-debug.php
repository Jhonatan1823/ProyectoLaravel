<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-kernel', function() {
    echo "<h1>Test Kernel.php</h1>";
    
    // Verificar si Kernel.php existe
    $kernelPath = app_path('Http/Kernel.php');
    if (file_exists($kernelPath)) {
        echo "✅ Kernel.php existe<br>";
    } else {
        echo "❌ Kernel.php NO existe<br>";
        return;
    }
    
    // Verificar si CheckRole existe
    $checkRolePath = app_path('Http/Middleware/CheckRole.php');
    if (file_exists($checkRolePath)) {
        echo "✅ CheckRole.php existe<br>";
    } else {
        echo "❌ CheckRole.php NO existe<br>";
        return;
    }
    
    // Verificar middleware registrado
    $kernel = app(\App\Http\Kernel::class);
    echo "<h3>Middleware Aliases:</h3>";
    echo "<pre>";
    print_r($kernel->middlewareAliases);
    echo "</pre>";
    
    if (isset($kernel->middlewareAliases['role'])) {
        echo "✅ Middleware 'role' está registrado<br>";
    } else {
        echo "❌ Middleware 'role' NO está registrado<br>";
    }
});