<?php

use App\Http\Controllers\AidePagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/about', [AidePagesController::class, 'about']);
Route::get('/politique_conf', [AidePagesController::class, 'politiqueConf']);
Route::get('/politique_cookies', [AidePagesController::class, 'politiqueCookies']);
Route::get('/contact', [AidePagesController::class, 'contact']);
Route::get('/aide/retour', [AidePagesController::class, 'aideRetour']);
Route::get('/aide/livraison', [AidePagesController::class, 'aideLivraison']);
Route::get('/aide/paiement', [AidePagesController::class, 'aidePaiement']);



Route::middleware('auth')->group(function () {
    Route::get('/favoris', [FavorisController::class, 'index']);
    Route::post('/favori/remove/{product}', [FavorisController::class, 'remove']);
    Route::post('/favori/toggle/{product}', [FavorisController::class, 'toggle']);
});


Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/incrementer/{id}', [PanierController::class, 'incrementer'])->name('panier.incrementer');
Route::post('/panier/decrementer/{id}', [PanierController::class, 'decrementer'])->name('panier.decrementer');
Route::post('panier/commande', [PanierController::class, 'commande'])->name('panier.commande');

Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');

Route::get('/produit/{colorId}/{productId}/sizes',[ProduitsController::class,'getSizesByColor']);

Route::get('/produits/{id?}', [ProduitsController::class, 'index'])->name('produits.categorie');
Route::get('/produit_details/{id}', [ProduitsController::class, 'show'])->name('produit.details');

Route::post('/formulaire', [MessageController::class, 'store'])->name('form.store');

Route::get('/loginpage', [AuthManager::class, 'login'])->name('login');
Route::post('/', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/signin', [AuthManager::class, 'signinPost'])->name('signin.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/show_orders', [OrderController::class, 'showOrders'])->name('commandes.index');
    Route::post('/compte', [AuthManager::class, 'compte'])->name('mon.compte');
    Route::get('/compte', [AuthManager::class, 'showCompte'])->name('compte');
    Route::post('/commandes/facture/{id}', [AdminController::class, 'genererFacturePDF'])->name('factureClient.pdf');

    Route::get('/payment', [PaymentController::class, 'checkout']);
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Groupe de routes protégées par le middleware d'admin (à adapter selon ton auth)
Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/admin', [AdminController::class, 'admin'])->name('index');

    /** Utilisateurs */
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    /** Produits */
    Route::get('/produits', [AdminController::class, 'produits'])->name('produits.index');
    Route::get('/produits/create', [AdminController::class, 'createProduit'])->name('produits.ajout');
    Route::post('/produits/store', [AdminController::class, 'storeProduit'])->name('produits.store');
    Route::get('/produits/{id}/edit', [AdminController::class, 'editProduit'])->name('produits.edit');
    Route::put('/produits/{id}/update', [AdminController::class, 'updateProduit'])->name('produits.update');
    Route::delete('/produits/{id}/delete', [AdminController::class, 'deleteProduit'])->name('produits.delete');

    /** Catégories */
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');

    Route::post('/categories/store', [AdminController::class, 'storeCategorie'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategorie'])->name('categories.edit');
    Route::put('/categories/{id}/update', [AdminController::class, 'updateCategorie'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [AdminController::class, 'deleteCategorie'])->name('categories.delete');


    Route::get('/commandes', [AdminController::class, 'showCommandes'])->name('commandes.index');
    Route::get('/commandes/Historique', [AdminController::class, 'showHistoriqueCommandes'])->name('commandes.historique');
    Route::put('/commandes/{id}/livraison', [AdminController::class, 'marquerCommeLivree'])->name('commandes.livraison');
    Route::put('/commandes/{id}/annuler', [AdminController::class, 'marquerCommeAnnuler'])->name('commandes.annuler');
    Route::post('/commandes/pdf', [AdminController::class, 'genererPDF'])->name('commandes.pdf');
    Route::post('/commandes/facturepdf/{id}', [AdminController::class, 'genererFacturePDF'])->name('facture.pdf');


    Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
    Route::put('/messages/{id}/visibility', [MessageController::class, 'updateVisibility'])->name('messages.updateVisibility');
});



Route::get('/test-email', function () {
    Mail::raw('Ceci est un test envoyé depuis Laravel 🎉', function ($message) {
        $message->to('zkrjaouhari07@gmail.com') // ← remplace avec ton adresse
            ->subject('Email de test Laravel');
    });

    return 'Email envoyé avec succès !';
});
