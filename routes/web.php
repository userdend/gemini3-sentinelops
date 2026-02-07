<?php

use App\Http\Controllers\EscalatedIncidentController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\IncidentAgentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MitigationPlanController;
use App\Http\Controllers\MyAppController;
use App\Http\Controllers\ResolvedIncidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/myapp');
});

Route::prefix('myapp')->group(function () {
    Route::get('/', [MyAppController::class, 'show'])->name('myapp.show');
    Route::post('/dispatch', [MyAppController::class, 'dispatch'])->name('myapp.dispatch');
});

Route::prefix('job')->group(function () {
    Route::get('/active', [JobController::class, 'activeJobsCount'])->name('job.active-count');
    Route::get('/failed', [JobController::class, 'failedJobsCount'])->name('job.failed-count');
    Route::get('/logs', [JobController::class, 'failureLogs'])->name('job.failure-logs');
    Route::get('/incident', [JobController::class, 'incidentLogs'])->name('job.incident-logs');
    Route::post('/resolve-manually', [JobController::class, 'resolveManually'])->name('job.resolve-manually');
    Route::get('/resolved-incident', [JobController::class, 'resolvedIncidentLogs'])->name('job.resolved-incident-logs');
});

Route::prefix('incident-agent')->group(function () {
    Route::get('/', [IncidentAgentController::class, 'list'])->name('ia.list');
});

Route::prefix('resolved-incident')->group(function () {
    Route::get('/', [ResolvedIncidentController::class, 'list'])->name('ri.list');
});

Route::prefix('gemini')->group(function () {
    Route::post('/scan', [GeminiController::class, 'scan'])->name('gemini.scan');
});

Route::prefix('mitigation-plan')->group(function () {
    Route::get('/', [MitigationPlanController::class, 'list'])->name('mp.list');
    Route::get('/resolved/{id}', [MitigationPlanController::class, 'resolved'])->name('mp.resolved');
    Route::get('/escalated/{id}', [MitigationPlanController::class, 'escalated'])->name('mp.escalated');
});

Route::prefix('escalated-incident')->group(function () {
    Route::get('/', [EscalatedIncidentController::class, 'list'])->name('ei.list');
});