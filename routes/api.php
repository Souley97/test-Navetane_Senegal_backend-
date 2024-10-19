<?php

use App\Http\Controllers\ClassementController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\MatcheController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\TirageController;
use App\Http\Controllers\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



// Page d'accueil
// Route::get('/', function () {
//     return view('home');
// })->name('home');

// Page "À propos"
Route::get('/about', [UserController::class, 'about'])->name('about');

// // Routes d'authentification
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

// In your routes file (e.g., web.php or api.php)
Route::get('login', [AuthController::class, 'login'])->name('login');  // If you have a GET login view
Route::post('login', [AuthController::class, 'login'])->name('login.action');  // POST request for login action


    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});






// Competition management with role-based access control
// Route::middleware(['auth:api', 'role:Zone'])->group(function () {
    Route::apiResource('competitions', CompetitionController::class);
// });


// Resourceful API routes
Route::apiResource('joueurs', JoueurController::class);
Route::apiResource('equipes', EquipeController::class);

Route::get('matches/venirs', [MatcheController::class, 'matchesAVenir']);

Route::apiResource('matches', MatcheController::class);




Route::apiResource('tirages', TirageController::class);
Route::apiResource('zones',   ZoneController::class);


// Ranking and Points
Route::get('rankings', [PointController::class, 'rankings']);
Route::get('teams/{equipeId}/points', [PointController::class, 'teamPoints']);
Route::get('classement', [ClassementController::class, 'getGlobalRankings']);
Route::get('classement/equipe/{equipeId}', [ClassementController::class, 'getTeamRank']);



// // Special route for launching a draw
// Route::post('tirages/lancer', [TirageController::class, 'lancerTirage']);

// // Reclamation routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('reclamations', [ReclamationController::class, 'store']);
//     Route::patch('reclamations/{id}/status', [ReclamationController::class, 'updateStatus']);
// });

// // Notification routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('notifications', [NotificationController::class, 'index']);
//     Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
//     Route::put('notifications/read-all', [NotificationController::class, 'markAllAsRead']);
// });

// // Result management routes
// Route::prefix('resultats')->group(function () {
//     Route::post('/', [ResultatController::class, 'store']);
//     Route::get('/matche/{matcheId}', [ResultatController::class, 'show']);
//     Route::post('/matche/{matcheId}/winner', [ResultatController::class, 'determineWinner']);
// });


// // Calendrier management routes
// Route::apiResource('calendriers', CalendrierController::class)->except(['show']);
// Route::get('calendriers/match/{matchId}', [CalendrierController::class, 'getByMatch']);

// // Dashboard view and statistics routes
// Route::get('dashboard', [DashboardViewController::class, 'index']);
// Route::get('dashboard/stats', [DashboardController::class, 'getStats']);

// // Statistique management routes
// Route::prefix('statistiques')->group(function () {
//     Route::apiResource('/', StatistiqueController::class)->except('show');
//     Route::get('/joueur/{joueurId}', [StatistiqueController::class, 'showByJoueur']);
// });

// // Test email route
// Route::get('/test-email', function () {
//     Mail::raw('C\'est le mail pour tester l\'ajout.', function ($message) {
//         $message->to('cheikhsane656@example.com')
//                 ->subject('Test Email');
//     });
//     return response()->json(['message' => 'Email envoyé avec succès']);
// });